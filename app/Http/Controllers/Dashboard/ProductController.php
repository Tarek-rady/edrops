<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Notification;
use App\Models\Setting;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\SallerRepository;
use App\Repositories\Sql\StockRepository;
use App\Repositories\Sql\UserRepository;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class ProductController extends Controller
{
    protected $productRepo , $categoryRepo  , $countryRepo  , $stockRepo , $sallerRepo , $userRepo , $productService;

    use GetRoleStocks ;

    public function __construct(ProductRepository $productRepo , CategoryRepository $categoryRepo  ,
       CountryRepository $countryRepo , StockRepository $stockRepo , SallerRepository  $sallerRepo ,
        UserRepository $userRepo , ProductService $productService )
    {
        $this->middleware('permission:products-read')->only(['index']);
        $this->middleware('permission:products-create')->only(['create', 'store']);
        $this->middleware('permission:products-update')->only(['edit', 'update']);
        $this->middleware('permission:products-delete')->only(['destroy']);
        $this->productRepo   = $productRepo ;
        $this->categoryRepo  = $categoryRepo ;
        $this->countryRepo   = $countryRepo ;
        $this->stockRepo     = $stockRepo ;
        $this->sallerRepo    = $sallerRepo ;
        $this->userRepo      = $userRepo ;
        $this->productService= $productService ;

    }

    public function get_products()
    {
        return $this->productService->get_products();
    }

    public function get_new_products()
    {
        return $this->productService->get_new_products();
    }

    public function products()
    {
        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands     = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $users      = $this->userRepo->getWhere(['is_active' => 1]);
        $unique_stocks = $this->getStocks();
        $stocks     = $this->stockRepo->getWhere(['id' => $unique_stocks]);
        return view('dashboard.backend.products.products' , compact('categories' , 'brands' , 'countries' , 'users' , 'stocks'));
    }

    public function index()
    {

        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands     = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $users      = $this->userRepo->getWhere(['is_active' => 1]);
        $unique_stocks = $this->getStocks();
        $stocks     = $this->stockRepo->getAll()->whereIn('id', $unique_stocks);
        return view('dashboard.backend.products.index' , compact('categories' , 'brands' , 'countries' , 'users' , 'stocks'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands = $this->categoryRepo->getWhere(['type' => 'brand']);
        $sallers = $this->sallerRepo->getAll();
        $unique_stocks = $this->getStocks();
        $stocks     = $this->stockRepo->getAll()->whereIn('id', $unique_stocks);
        $countries  = $this->countryRepo->getAll();
        $setting = Setting::where('type' , 'setting')->first();
        return view('dashboard.backend.products.create' , compact('categories' , 'brands' , 'countries' , 'sallers' , 'stocks' , 'setting'));
    }

    public function uploadFile(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        return $this->productService->view_file($receiver);


    }

    public function store(ProductRequest $request)
    {
       $data = $request->except('img' , 'type' , 'sallers' , 'video' , 'images' , 'countries' , 'admin_id' , 'sku' , 'profit_app' , 'profit_saller' , 'min_setting' , 'max_setting' , 'size_ar' , 'size_en' , 'color_ar' , 'color_en' , 'code_size' , 'code_color' );
       $this->productService->add_product($request , $data);

       return redirect(route('admin.products.index'))->with('success', __('models.added_successfully'));
    }

    public function show($id)
    {
        $product = $this->productRepo->findOne($id);
        $notify = Notification::where('product_id' , $product->id)->where('type' , 'admins')->where('read' , 0)->first();
        if($notify){
            $notify->update([
              'read' => 1
            ]);
        }
        return view('dashboard.backend.products.show' , compact('product'));

    }

    public function edit($id)
    {
        $product = $this->productRepo->findOne($id);
        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $setting = Setting::where('type' , 'setting')->first();
        $sallers = $this->sallerRepo->getAll();

        $unique_stocks = $this->getStocks();
        $stocks     = $this->stockRepo->getAll()->whereIn('id', $unique_stocks);
        return view('dashboard.backend.products.edit' , compact('product' , 'categories' , 'brands' , 'countries' , 'setting' , 'stocks' , 'sallers'));

    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->productRepo->findOne($id);
        $data = $request->except('id' , 'img' , 'type' , 'sallers' , 'video' , 'images' , 'countries' , 'admin_id' , 'sku' , 'profit_app' , 'profit_saller' , 'min_setting' , 'max_setting' , 'size_ar' , 'size_en' , 'color_ar' , 'color_en' , 'code_size' , 'code_color' );
        $this->productService->update_product($request , $data , $product);

        return redirect(route('admin.products.index'))->with('success', __('models.updated_successfully'));

    }

    public function destroy($id)
    {
        $product = $this->productRepo->findOne($id);
        $this->productService->delete($product);
        return redirect(route('admin.products.index'))->with('success', __('models.deleted_successfully'));

    }

    public function changeActiveProduct(Request $request){

        $this->productService->change_active($request);
        return response()->json(['success' => __('models.status_update')]);
    }

}
