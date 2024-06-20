<?php

namespace App\Http\Controllers\User;

use App\Exports\ProductExport;
use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProductRequest;
use App\Models\Notification;
use App\Models\Setting;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\SallerRepository;
use App\Repositories\Sql\StockRepository;
use App\Repositories\Sql\UserRepository;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class ProductController extends Controller
{
    protected $productRepo , $categoryRepo  , $countryRepo  , $stockRepo , $sallerRepo , $userRepo;

    use GetRoleStocks ;
    public function __construct(ProductRepository $productRepo , CategoryRepository $categoryRepo  ,
       CountryRepository $countryRepo , StockRepository $stockRepo , SallerRepository  $sallerRepo ,
        UserRepository $userRepo)
    {
        $this->productRepo  = $productRepo ;
        $this->categoryRepo = $categoryRepo ;
        $this->countryRepo  = $countryRepo ;
        $this->stockRepo    = $stockRepo ;
        $this->sallerRepo   = $sallerRepo ;
        $this->userRepo     = $userRepo ;

    }


    public function get_products()
    {

        $user = auth()->user();
        $products = $this->productRepo->query()->where('is_active' , 1)->where('user_id' , $user->id);

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

        ->filterColumn('store', function($query , $keyword) {
            $query->whereRelation('store' , 'id' , $keyword);
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



        ->editColumn('store' , function($product){
            return $product->store->name ;
        })


        ->addColumn('action', 'dashboard.user.products.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function get_new_products()
    {


        $user = auth()->user();
        $products = $this->productRepo->query()->where('is_active' , 0)->where('user_id' , $user->id);
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



        ->filterColumn('store', function($query , $keyword) {
            $query->whereRelation('store' , 'id' , $keyword);
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


        ->editColumn('store' , function($product){
            return $product->store->name ;
        })
        ->addColumn('action', 'dashboard.user.products.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function products()
    {

        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands     = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $stocks     = $this->stockRepo->getAll();
        return view('dashboard.user.products.products' , compact('categories' , 'brands' , 'countries', 'stocks'));
    }

    public function index()
    {

        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands     = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $stocks     = $this->stockRepo->getAll();
        return view('dashboard.user.products.index' , compact('categories' , 'brands' , 'countries', 'stocks'));
    }


    public function create()
    {
        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands = $this->categoryRepo->getWhere(['type' => 'brand']);
        $sallers = $this->sallerRepo->getAll();
        $stocks = $this->stockRepo->getAll();
        $countries  = $this->countryRepo->getAll();
        return view('dashboard.user.products.create' , compact('categories' , 'brands' , 'countries' , 'sallers' , 'stocks'));
    }

    public function uploadFile(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.mp4'; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('videos', $file, $fileName);

            session()->put('link_video', $path);

            $file_path = 'videos';

            session()->put('time_video', Storage::disk(config('filesystems.default'))->put($file_path, $file));
            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName,
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
        ];
    }


    public function store(ProductRequest $request)
    {
       $setting = Setting::where('type' , 'setting')->first();
       $data = $request->except('img' , 'sallers' , 'video' , 'images' , 'countries'   , 'size_ar' , 'size_en' , 'color_ar' , 'color_en' , 'code_size' , 'code_color');
       $cost_user = $request->cost_user; // 10
       $cost = ($cost_user * $setting->profit_app) / 100; // 3
       $new_cost = $cost_user + $cost; // 13
       $price = ($new_cost * $setting->profit_saller) / 100; // 6.5
       $new_price = $new_cost + $price ; // 19.50

       $data['cost'] = $new_cost ;
       $data['price'] = $new_price ;
       $data['profit'] = $new_price - $new_cost ;
       $data['min'] = $new_price + $setting->min ;
       $data['max'] = $new_price + $setting->max ;

       $data['user_id'] = auth()->user()->id ;
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('products');
        }

        if (session('link_video')) {
            $data['video'] = session('time_video');

            $getID3 = new \getID3;
            $video_file = $getID3->analyze('storage/' . session('time_video'));

            session()->forget('link_video');
        }

        $product = $this->productRepo->create($data);

        $files = $request->file('images');


        foreach ($files as $file) {
            $image = $file->store('images');
            $product->images()->create([
                'img'=>$image ,
                'type' => 'img'
            ]);

        }



        if(isset($request->sallers)){
            foreach ($request->sallers as $saller_id) {
                  $product->view_sallers()->create([
                      'saller_id' => $saller_id ,
                      'type'     => 'products'
                  ]);
            }
        }else{
            $sallers = $this->sallerRepo->getAll();

            foreach ($sallers as $saller) {
                $product->view_sallers()->create([
                    'saller_id' => $saller->id ,
                    'type'     => 'products'
                ]);
            }
        }

        if(isset($request->size_ar)){
            foreach ($request->size_ar as $key => $product_size) {
                  $product->sizes()->create([
                      'size_ar'  => $product_size ,
                      'size_en'  => $request->size_en[$key] ,
                      'code_size'=> $request->code_size[$key] ,
                      'type'     => 'size'
                  ]);
            }
        }

        if(isset($request->color_ar)){
            foreach ($request->color_ar as $key => $product_color) {
                  $product->colors()->create([
                      'color_ar'  => $product_color ,
                      'color_en'  => $request->color_en[$key] ,
                      'code_color'=> $request->code_color[$key] ,
                      'type' => 'color'
                  ]);
            }
        }

        Notification::create([
            'user_id'   =>  auth()->user()->id ,
            'product_id'   => $product->id ,
            'title_ar'     => 'تم اضافه منتج جديد ' . $product->name . ' بواسطه ' . auth()->user()->name,
            'title_en'     =>'تم اضافه منتج جديد ' . $product->name . ' بواسطه ' . auth()->user()->name,
            'type'         => 'admins' ,
        ]);




        return redirect(route('user.products.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        $product = $this->productRepo->findOne($id);

        $notify = Notification::where('product_id' , $product->id)->where('user_id' , auth()->user()->id)->where('type' , 'users')->where('read' , 0)->first();
        if($notify){
            $notify->update([
              'read' => 1
            ]);
        }
        return view('dashboard.user.products.show' , compact('product'));

    }


    public function edit($id)
    {
        $product = $this->productRepo->findOne($id);
        $categories = $this->categoryRepo->getWhere(['type' => 'category']);
        $brands = $this->categoryRepo->getWhere(['type' => 'brand']);
        $countries  = $this->countryRepo->getAll();
        $sallers = $this->sallerRepo->getAll();
        $stocks = $this->stockRepo->getAll();
        return view('dashboard.user.products.edit' , compact('product' , 'categories' , 'brands' , 'countries'  , 'stocks' , 'sallers'));

    }


    public function update(ProductRequest $request, $id)
    {
         $product = $this->productRepo->findOne($id);
         $data = $request->except('img' , 'id' , 'sallers' , 'video' , 'images' , 'countries'  , 'size_ar' , 'size_en' , 'color_ar' , 'color_en', 'code_size' , 'code_color' );
         $setting = Setting::where('type' , 'setting')->first();
         $cost_user = $request->cost_user; // 10
        $cost = ($cost_user * $setting->profit_app) / 100; // 3
        $new_cost = $cost_user + $cost; // 13
        $price = ($new_cost * $setting->profit_saller) / 100; // 6.5
        $new_price = $new_cost + $price ; // 19.50

        $data['cost'] = $new_cost ;
        $data['price'] = $new_price ;
        $data['profit'] = $new_price - $new_cost ;
        $data['min'] = $new_price + $setting->min ;
        $data['max'] = $new_price + $setting->max ;
        if ($request->hasFile('img')) {

            Storage::delete($product->img);

            $data['img'] = $request->file('img')->store('products');

        } else {
            $data['img'] = $product->img;
        }

        if (session('link_video')) {
            if(isset($product->video)){
                Storage::delete($product->video);
            }

            $getID3 = new \getID3;
            $video_file = $getID3->analyze('storage/' . session('time_video'));

            // Update the 'video' field in the $data array with the new video path
            $data['video'] = session('time_video');

            // Update the 'video' field in the product model
            $product->video = session('time_video');

            session()->forget('link_video');
        }

        $product->update($data);

        if(isset($request->countries)){
            $product->countries()->delete();

            foreach ($request->countries as $country) {
                $product->countries()->create([
                    'country_id' => $country ,
                    'type'     => 'country'
                ]);
            }
        }

        if(isset($request->sallers)){
            $product->view_sallers()->delete();
            foreach ($request->sallers as $saller_id) {
                  $product->view_sallers()->create([
                      'saller_id' => $saller_id ,
                      'type'     => 'products'
                  ]);
            }
        }else{
            $sallers = $this->sallerRepo->getAll();
            $product->view_sallers()->delete();
            foreach ($sallers as $saller) {
                $product->view_sallers()->create([
                    'saller_id' => $saller->id ,
                    'type'     => 'products'
                ]);
            }
        }



        if(isset($request->size_ar)){
            $product->sizes()->delete();
            foreach ($request->size_ar as $key => $product_size) {
                  $product->sizes()->create([
                      'size_ar'  => $product_size ,
                      'size_en'  => $request->size_en[$key] ,
                      'code_size'  => $request->code_size[$key] ,
                      'type'     => 'size'
                  ]);
            }
        }

        if(isset($request->color_ar)){
            $product->colors()->delete();

            foreach ($request->color_ar as $key => $product_color) {
                  $product->colors()->create([
                      'color_ar'  => $product_color ,
                      'color_en'  => $request->color_en[$key] ,
                      'code_color'  => $request->code_color[$key] ,
                      'type'     => 'color'
                  ]);
            }
        }


        $files = $request->file('images');

        if ($request->hasFile('images')) {

            Storage::delete($product->images()->pluck('img')->toArray());
            $product->images()->delete();

            $files = $request->file('images');

            foreach ($files as $file) {
                $image = $file->store('images');
                $product->images()->create([
                    'img'=>$image ,
                    'type' => 'img'
                ]);
            }

        }


        return redirect(route('user.products.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $product = $this->productRepo->findOne($id);

        if ($product->img) {
            Storage::delete($product->img);
        }

        $product->delete();

        return redirect(route('user.products.index'))->with('success', __('models.deleted_successfully'));

    }


    public function changeActiveProduct(Request $request){
        $product = $this->productRepo->findOne($request->id);

        if($request->is_active == 1){
           $is_active = 1 ;
        }else{
            $is_active = 0 ;
        }

        $product->update([
            'is_active'    => $is_active
        ]);




        return response()->json(['success' => __('models.status_update')]);
    }
}
