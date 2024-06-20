<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\FavouriteExport;
use App\Http\Controllers\Controller;
use App\Repositories\Sql\FavouriteRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FavouriteController extends Controller
{
    protected $favRepo , $userRepo , $productRepo;

    public function __construct(FavouriteRepository $favRepo , ProductRepository $productRepo , UserRepository $userRepo)
    {
        $this->middleware('permission:favourites-read')->only(['index']);
        $this->middleware('permission:favourites-create')->only(['create', 'store']);
        $this->middleware('permission:favourites-update')->only(['edit', 'update']);
        $this->middleware('permission:favourites-delete')->only(['destroy']);
        $this->favRepo     = $favRepo ;
        $this->userRepo    = $userRepo ;
        $this->productRepo = $productRepo ;

    }


    public function get_favourites()
    {
        $favourites = $this->favRepo->query();
        return DataTables($favourites)
        ->filterColumn('product', function($query , $keyword) {
            $query->whereRelation('product' , 'id' , $keyword);
        })
        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })
        ->editColumn('product' , function($rate){
            return '<a href="' . route("admin.products.show", $rate->product_id) . '" class="btn btn-sm btn-info edit-item-btn">' . $rate->product->name . '</a>';
        })
        ->editColumn('user' , function($fav){
            return $fav->user->name;
        })
        ->editColumn('created_at' , function($fav){
            return $fav->created_at->format('y-m-d');
        })


        ->rawColumns([ 'product' ])
        ->make(true);

    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        $users = $this->userRepo->getAll();
        return view('dashboard.backend.favourites.index' , compact('products' , 'users'));
    }













    public function destroy($id)
    {
         $fav = $this->favRepo->findOne($id);

        if ($fav->img) {
            Storage::delete($fav->img);
        }

        $fav->delete();

        return \response()->json([
            'message' => __('models.deleted_successfully')
        ]);
    }

    public function export()
    {
        return Excel::download(new FavouriteExport, 'favourites.xlsx');
    }
}
