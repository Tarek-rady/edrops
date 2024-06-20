<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Sql\SallerRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\CountryRepository;
use Illuminate\Http\Request;
use App\Models\SallerProduct;
use App\Models\Product;
use App\Models\Rate;
use App\Repositories\Sql\UserRepository;
use App\Http\Requests\Saller\RateRequest;

class SellerProductController extends Controller
{

    protected $productRepo , $categoryRepo , $userRepo , $countryRepo;

    public function __construct(ProductRepository $productRepo , CategoryRepository $categoryRepo , UserRepository $userRepo , CountryRepository $countryRepo)
    {
        $this->productRepo  = $productRepo ;
        $this->categoryRepo = $categoryRepo ;
        $this->countryRepo  = $countryRepo ;
        $this->userRepo  = $userRepo ;

    }

    public function index()
    {
        return view('dashboard.saller.products.index');
    }

    public function my_products()
    {
        $user = auth('admin')->user()->saller;
        $products = $this->productRepo->query()->whereHas('sallers', function($query) use ($user){
            $query->where('saller_id', $user->id)->where('saller_products.type', 'fav');
        });
        return DataTables($products)

        ->filterColumn('category', function($query , $keyword) {
            $query->whereRelation('category' , 'id' , $keyword);
        })
        ->filterColumn('brand', function($query , $keyword) {
            $query->whereRelation('brand' , 'id' , $keyword);
        })

        ->filterColumn('country', function($query , $keyword) {
            $query->whereRelation('country' , 'id' , $keyword);
        })


        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })

        ->editColumn('category' , function($product){
            return $product->category->name ;
        })

        ->editColumn('brand' , function($product){
            if($product->brand){
                return  $product->brand->name ;
            }else{
                return 'not found' ;

            }
        })

        ->editColumn('country' , function($product){
            return $product->country->name ;
        })

        ->editColumn('user' , function($product){
            if(isset($product->user)){
                return $product->user->name ;
            }else{
                return '-' ;
            }
        })

        ->addColumn('action', 'dashboard.saller.products.actions')
        ->rawColumns(['action'])
        ->make(true);

    }


    public function show($id)
    {
        $product = $this->productRepo->findOne($id);

        return view('dashboard.saller.products.show' , compact('product'));

    }
    public function add_product($id)
    {
        $user = auth('admin')->user()->saller;

        $product = SallerProduct::where('product_id', $id)->where('type' , 'fav')->where('saller_id', $user->id)->first();

        if(!$product){
            SallerProduct::create([
                'product_id' => $id,
                'saller_id' => $user->id ,
                'type'      => 'fav' ,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة المنتج بنجاح'
            ]);

        }else{

            return response()->json([
                'success' => false,
                'message' => 'المنتج موجود بالفعل'
            ]);

        }

    }

    public function rate_product(RateRequest $request){

        $seller = auth('admin')->user()->saller;
        Rate::create([
            'saller_id' => $seller->id,
            'product_id' => $request->product_id,
            'msg' => $request->msg,
            'rate' => $request->rate,
            'type' => "products"
        ]);

        return response()->json([
           'success' => true ,
           'message' => 'تم التقييم بنجاح'
        ]);
    }

    public function delete_product($id){
        $user = auth('admin')->user();
        $product = SallerProduct::where('product_id', $id)->where('type' , 'fav')->delete();

        return redirect(route('saller.products'))->with('success', __('models.deleted_successfully'));

    }
}
