<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Repositories\Sql\SallerRepository;
use Faker\Factory;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    use HelperTrait , GetRoleStocks;

    protected $productRepo , $sallerRepo ;

    public function __construct(ProductRepository $productRepo , SallerRepository $sallerRepo)
    {
        $this->productRepo   = $productRepo ;
        $this->sallerRepo    = $sallerRepo  ;
    }

    public function get_products(){

        $unique_stocks = $this->getStocks();
        $products = $this->productRepo->query()->where('is_active' , 1)->whereIn('stock_id', $unique_stocks);
        return $this->columns($products);
    }

    public function get_new_products(){
        $unique_stocks = $this->getStocks();
        $products = $this->productRepo->query()->where('is_active' , 0)->whereIn('stock_id', $unique_stocks);
        return $this->columns($products);
    }

    public function columns($products){
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

        ->editColumn('store' , function($product){
            return $product->store->name ;
        })


        ->addColumn('action', 'dashboard.backend.products.actions')
        ->rawColumns(['action'])
        ->make(true);
    }

    public function view_file($receiver){
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

    public function add_product(Request $request , $data){

        $fake = Factory::create();
        $this->addImage($request, $data, 'img', 'products');
        $data['sku'] = 'sku' . $fake->unique()->numberBetween(100000 , 999999);
        $data['admin_id'] = auth('admin')->user()->id ;
        $data['type'] = isset($request->sallers) ? 'private' : 'public' ;
        $data['is_active'] = 1 ;
        $product = $this->productRepo->create($data);

        $this->add_viedo();
        $this->images($request , $product);
        $this->sallers($request , $product);
        $this->sizes($request , $product);
        $this->colors($request , $product);
        
    }

    public function update_product(Request $request , $data , $product){
        $data['type'] = isset($request->sallers) ? 'private' : 'public' ;
        $this->updateImg($request, $data, 'img', 'products' , $product);
        $product->update($data);
        $this->update_video($product);
        $this->images($request , $product);
        $this->sallers($request , $product);
        $this->sizes($request , $product);
        $this->colors($request , $product);
    }

    public function add_viedo(){
        if (session('link_video')) {
            $data['video'] = session('time_video');

            $getID3 = new \getID3;
            $video_file = $getID3->analyze('storage/' . session('time_video'));
            session()->forget('link_video');
       }
    }

    public function images($request , $product){

        $files = $request->file('images');

        if ($request->hasFile('images')) {
            if($product->images){
                Storage::delete($product->images()->pluck('img')->toArray());
                $product->images()->delete();
            }

            foreach ($files as $file) {
                $image = $file->store('images');
                $product->images()->create([
                    'img'=>$image ,
                    'type' => 'img'
                ]);
            }
        }


    }

    public function sallers($request , $product){
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


    }

    public function sizes($request , $product){
        if(isset($request->size_ar)){
            if($product->sizes){
                $product->sizes()->delete();
            }
              foreach ($request->size_ar as $key => $product_size) {
                 $product->sizes()->create([
                    'size_ar'  => $product_size ,
                    'size_en'  => $request->size_en[$key] ,
                    'code_size'=> $request->code_size[$key] ,
                    'type'     => 'size'
                 ]);
              }
           }
    }

    public function colors($request , $product){
        if(isset($request->color_ar)){
            if($product->colors){
                $product->colors()->delete();
            }
            foreach ($request->color_ar as $key => $product_color) {
                $product->colors()->create([
                    'color_ar'   => $product_color ,
                    'color_en'   => $request->color_en[$key] ,
                    'code_color' => $request->code_color[$key] ,
                    'type'       => 'color' ,
                ]);
            }
        }
    }

    public function update_video($product){
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
    }

    public function delete($product){
        if ($product->img) {
            Storage::delete($product->img);
        }

        if($product->images){
            Storage::delete($product->images()->pluck('img')->toArray());
            $product->images()->delete();
        }

        $product->delete();
    }

    public function change_active($request){
        $product = $this->productRepo->findOne($request->id);
        if($request->is_active == 1){
            $is_active = 1 ;
         }else{
             $is_active = 0 ;
         }

         $product->update([
             'is_active'    => $is_active
         ]);
    }



}
