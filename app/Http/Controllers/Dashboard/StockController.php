<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockRequest;
use App\Models\RoleStock;
use App\Models\Stock;
use App\Repositories\Sql\StockRepository;
use Illuminate\Http\Request;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\UserRepository;
use App\Services\Admin\StockService;

class StockController extends Controller
{
    protected $productRepo , $categoryRepo  , $countryRepo  , $stockRepo , $userRepo , $stockService;

    use GetRoleStocks;

    public function __construct(ProductRepository $productRepo , CategoryRepository $categoryRepo  ,
    CountryRepository $countryRepo , StockRepository $stockRepo , UserRepository $userRepo , StockService $stockService )
    {
        $this->middleware('permission:stocks-read')->only(['index']);
        $this->middleware('permission:stocks-create')->only(['create', 'store']);
        $this->middleware('permission:stocks-update')->only(['edit', 'update']);
        $this->middleware('permission:stocks-delete')->only(['destroy']);
        $this->productRepo  = $productRepo ;
        $this->categoryRepo = $categoryRepo ;
        $this->countryRepo  = $countryRepo ;
        $this->stockRepo    = $stockRepo ;
        $this->userRepo     = $userRepo ;
        $this->stockService = $stockService ;
    }


    public function get_stocks()
    {
        $unique_stocks = $this->getStocks();
        return $this->stockService->get_stocks($unique_stocks);
    }


    public function index()
    {

        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.stocks.index' , compact('countries'));
    }


    public function create()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.stocks.create' , compact('countries'));
    }


    public function store(StockRequest $request)
    {

       $data = $request->all();
       $this->stockService->add_stock($request , $data);

        return redirect(route('admin.stocks.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $countries = $this->countryRepo->getAll();
        $stock  = $this->stockRepo->findOne($id);
        return view('dashboard.backend.stocks.edit' , compact('countries' , 'stock'));

    }


    public function update(Request $request, $id)
    {
         $stock = $this->stockRepo->findOne($id);
         $data = $request->all();
         $this->stockService->update_stock($request , $data , $stock);

        return redirect(route('admin.stocks.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $stock = $this->stockRepo->findOne($id)->delete();
        return redirect(route('admin.stocks.index'))->with('success', __('models.deleted_successfully'));

    }

    public function get_products(Request $request)
    {

        $stock = $request->query('id');
        $products = $this->productRepo->query()->where('stock_id' , $stock);
        return $this->stockService->get_products($products);


    }

    public function products($id){
        $stock = $this->stockRepo->findOne($id);
        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands     = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $users      = $this->userRepo->getWhere(['is_active' => 1]);
        return view('dashboard.backend.stocks.products' , compact('categories' , 'brands' , 'countries' , 'users' ,'stock'));

    }


    public function stocks($country_id){
        return $this->stockService->stocks($country_id);
    }
}
