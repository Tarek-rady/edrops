<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Models\Country;
use App\Models\OrderItem;
use App\Models\Profit;
use App\Models\ProfitApp;
use App\Models\Setting;
use App\Repositories\Sql\NotificationRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\SallerRepository;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class OrderService
{
    use HelperTrait , GetRoleStocks;
    protected $orderRepo , $sallerRepo , $productRepo , $notifyRepo , $profitRepo , $profitAppRepo;

    public function __construct(OrderRepository $orderRepo , SallerRepository $sallerRepo , ProductRepository $productRepo , NotificationRepository $notifyRepo )
    {
        $this->orderRepo    = $orderRepo ;
        $this->sallerRepo   = $sallerRepo ;
        $this->productRepo  = $productRepo ;
        $this->notifyRepo   = $notifyRepo ;
    }

    public function get_orders(){

        $unique_stocks = $this->getStocks();
        $orders = $this->orderRepo->query();

        return $this->columns($orders);
    }

    public function columns($orders){
        return DataTables($orders)

         ->filterColumn('status', function ($query, $keyword) {
             $query->whereRelation('status', 'id', $keyword);
         })

         ->filterColumn('saller', function ($query, $keyword) {
             $query->whereRelation('saller', 'id', $keyword);
         })

         ->editColumn('date_order', function ($order) {
             return date('D, d M Y - h:ia', strtotime($order->date_order));
         })

         ->editColumn('status', function ($order) {
             if ($order->status_id == 1 || $order->status_id == 2 || $order->status_id == 3) {
                 return '<span class="badge bg-warning-subtle text-warning text-uppercase">' . $order->status->name . '</span>';
             } elseif ($order->status_id == 2 || $order->status_id == 3) {
                 return '<span class="badge bg-info-subtle text-info text-uppercase">' . $order->status->name . '</span>';
             } elseif ($order->status_id == 4 || $order->status_id == 5) {
                 return '<span class="badge bg-primary-subtle text-primary text-uppercase">' . $order->status->name . '</span>';
             } elseif ($order->status_id == 6) {
                 return '<span class="badge bg-success-subtle text-success text-uppercase">' . $order->status->name . '</span>';
             } elseif ($order->status_id == 7) {
                 return '<span class="badge bg-danger-subtle text-danger text-uppercase">' . $order->status->name . '</span>';
             }
         })

         ->editColumn('saller', function ($order) {
             return $order->saller->name ;
         })

         ->addColumn('action', 'dashboard.backend.orders.actions')

         ->rawColumns(['status', 'action'])
         ->make(true);
    }

    public function add_order(Request $request , $data){
        $this->addImage($request, $data, 'img', 'orders');
        $order =$this->orderRepo->create($data);
    }

    public function update_status(Request $request , $order){
        $setting = Setting::where('type' , 'setting')->first();
        $saller = $this->sallerRepo->findWhere(['id' => $order->saller_id]);


       if($request->status_id == 2 ){

            $order->update([
                'status_id'      => 2 ,
                'date_progress'  => now()
            ]);

       }elseif($request->status_id == 3 ){

            $order->update([
                'status_id'        => 3 ,
                'date_processing'  => now()
            ]);
       }elseif($request->status_id == 4 ){

            $order->update([
                'status_id'   => 4 ,
                'date_done'   => now()
            ]);
       }elseif($request->status_id == 5 ){

            $order->update([
                'status_id'       => 5 ,
                'date_delivery'   => now()
            ]);
       }elseif($request->status_id == 6 ){

            $order->update([
                'status_id'       => 6 ,
                'date_complete'   => now() ,
            ]);


            $order->saller->update([
              'amount' => $order->saller->amount + $order->saller_total_profit ,
              'point_num' => $saller->point_num + 1
            ]);

            $this->point_saller($saller , $setting);

            $this->order_items($order);



       }elseif($request->status_id == 7){
            $order->update([
                'status_id'       => 7,
                'date_canceled'      => now()
            ]);


            foreach ($order->items as $item) {
                $product = $this->productRepo->findWhere(['id' => $item->product_id]);

                $product->update([
                    'qty'  =>  $product->qty + $item->qty ,
                    'stock'  =>  $product->stock + $item->qty ,
                ]);

            }
       }

    }


    public function point_saller($saller , $setting){
        if ($saller->point_num <= $setting->bronze) {
            $saller->update(['point_id' => 1]);
        } elseif ($saller->point_num <= $setting->silver) {
            $saller->update(['point_id' => 2]);
        } elseif ($saller->point_num <= $setting->gold) {
            $saller->update(['point_id' => 3]);
        }
    }

    public function order_items($order){

        foreach ($order->items as $item) {

            for ($i = 0; $i < $item->qty; $i++) {

               // profit_app
               $this->profit_app($item);

                // profits saller
                $this->profit_saller($item , $order);

                // profits user
                $this->profit_user($item , $order);
            }


            $this->notify_to_saller($item , $order);


        }
    }

    // profits App
    public function profit_app($item){
        ProfitApp::create([
            'product_id'   => $item->product_id ,
            'profit'       => $item->product->cost -  $item->product->cost_user,
            'cost'         => $item->product->cost_user ,
            'price'        => $item->product->cost ,
        ]);

    }

    // profits Saller
    public function profit_saller($item , $order){
        Profit::create([
            'saller_id'     => $order->saller_id ,
            'order_id'      => $order->id ,
            'product_id'      => $item->product_id ,
            'admin_id'      => auth('admin')->user()->id ,
            'profit'        => $item->product->price - $item->product->cost ,
            'type'          => 'saller'
        ]);
    }

    // profit user
    public function profit_user($item , $order){
        if(isset($item->product->user_id)){
                Profit::create([
                    'user_id'       => $item->product->user_id,
                    'order_id'      => $order->id ,
                    'product_id'      => $item->product_id ,
                    'admin_id'      => auth('admin')->user()->id ,
                    'profit'        => $item->product->cost_user ,
                    'type'          => 'user'
                ]);

                $this->notify_to_user($item , $order);

                $item->product->user->update([
                    'amount' => $item->product->user->amount + $item->product->cost_user
                ]);
        }
    }

    public function notify_to_user($item , $order){
        $notify = $this->notifyRepo->getWhere([ ['user_id' , $item->product->user_id] , ['product_id' , $item->product_id] , ['order_id' , $order->id]  , ['read' , 0]  ])->first();
        if(!$notify){
            $this->notifyRepo->create([
                'admin_id'     => auth('admin')->user()->id ,
                'order_id'   => $item->order_id ,
                'product_id'   => $item->product_id ,
                'user_id'      => $item->product->user_id ,
                'title_ar'     => 'تم بيع عدد ' . $item->qty . 'من المنتج ' . $item->product->name  ,
                'title_en'     => 'تم بيع عدد ' . $item->qty . 'من المنتج ' . $item->product->name ,
                'type'         => 'users' ,
            ]);
        }
    }

    public function notify_to_saller($item , $order){
        $notify = $this->notifyRepo->getWhere([ ['saller_id' , $order->saller_id] , ['order_id' , $order->id] , ['read' , 0]  ])->first();
        if(!$notify){

            $this->notifyRepo->create([
                'admin_id'     => auth('admin')->user()->id ,
                'saller_id'    => $order->saller_id ,
                'order_id'     => $order->id ,
                'title_ar'     => 'تم اكتمال بيع الاوردر'  . $order->code ,
                'title_en'     => 'تم اكتمال بيع الاوردر'  . $order->code,
                'type'         => 'sallers' ,
            ]);
        }

    }

    public function create_order(Request $request){
        try {
            $order= $this->orderRepo->findWhere(['id' => $request->id]);
            DB::beginTransaction();
            $seller = $this->sallerRepo->findWhere(['id' => $request->saller_id]);
            $fake = Factory::create();

            $order->saller_id = $seller->id;
            $order->admin_id = auth('admin')->user()->id;
            $order->status_id = $order->status_id;
            $order->customer_name = $request->customer_name;
            $order->country = $request->country;
            $order->city = $request->city;
            $order->country_code = $request->country_code;
            $order->phone = $request->phone;
            $order->website = $request->website;
            $order->address = $request->address;
            $order->notes = $request->notes;
            $order->type = 'cart';
            $order->payment_method = $request->payment_method;
            $order->save();

            $total_products_cost = 0;
            $customer_total_products_cost = 0;
            $seller_total_profit = 0;
            $shipping_tax = Country::find($request->country)->delivery ?? 0;
            $service_cost = 0.0;
            $order->cart_items()->delete();
            foreach ($request->products as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product['id'];
                $orderItem->qty = $product['qty'];
                $orderItem->product_cost_price = $product['product_cost_price'];
                $orderItem->product_selling_price = $product['product_selling_price'];
                $orderItem->total = $product['product_selling_price'] * $product['qty'];
                $orderItem->save();

                $total_products_cost +=( $product['product_cost_price'] * $product['qty']  );
                $customer_total_products_cost += ( $product['product_selling_price'] * $product['qty']);
                $seller_total_profit += ($product['product_selling_price'] - $product['product_cost_price'] ) * $product['qty'];
            }

            $order->total_products_cost = $total_products_cost;
            $order->shipping_tax = $shipping_tax;
            $order->customer_total_cost = $customer_total_products_cost + $shipping_tax;
            $order->saller_total_profit = $seller_total_profit + $service_cost;
            $order->save();



            DB::commit();

            // return redirect(route('saller.orders.index'))->with('success', __('models.added_successfully'));
            return response()->json([
                'success' => true,
                'message' => __('models.updated_successfully')
            ]);

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            // return redirect()->back()->with('error', __('models.something_went_wrong'));
            return response()->json([
                'success' => false,
                'message' => __('models.something_went_wrong')
            ]);
        }
    }
}
