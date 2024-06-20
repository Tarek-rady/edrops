<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CartOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Saller;
use App\Repositories\Sql\CartRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\NotificationRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\SallerRepository;
use Faker\Factory;

class CartController extends Controller
{
    protected $cartRepo , $sallerRepo , $countryRepo , $productRepo , $notifyRepo;

    public function __construct(CartRepository $cartRepo , SallerRepository $sallerRepo , CountryRepository $countryRepo , ProductRepository $productRepo , NotificationRepository $notifyRepo)
    {
         $this->cartRepo    = $cartRepo ;
         $this->sallerRepo  = $sallerRepo ;
         $this->countryRepo = $countryRepo ;
         $this->productRepo = $productRepo ;
         $this->notifyRepo = $notifyRepo ;

    }

    public function index() {
        $admin = auth('admin')->user();
        $cart_items = $this->cartRepo->getWhere([ ['admin_id' , $admin->id] , ['type' , 'admin'] ]);
        $countries =  $this->countryRepo->getAll();
        $sallers  = $this->sallerRepo->getWhere(['is_active' => 1]);
        return view('dashboard.backend.cart.index', compact('cart_items', 'countries' , 'sallers'));
    }

    public function add_cart($product_id) {

        $admin = auth('admin')->user();

        $cart_item = Cart::where('admin_id', $admin->id)->where('product_id', $product_id)->where('type' , 'admin')->first();

        if($cart_item){
            $cart_item->qty +=1;
            $cart_item->type = 'admin' ;
            $cart_item->save();
        }else{
            $cart_item = Cart::create([
                'type'    => 'admin' ,
                'admin_id' => $admin->id,
                'product_id' => $product_id
            ]);
        }

        return response()->json([
            'success' => true,
            'message'  => 'تم إضافة المنتج الي السلة بنجاح',
            'cart_items_count'  => $cart_item->sum('qty')
        ]);

    }

    public function remove_cart($product_id) {

        $admin = auth('admin')->user();

        $cart_item = $this->cartRepo->getWhere([ ['admin_id' , $admin->id] , ['product_id' , $product_id]  ])->first();

        if($cart_item){
            $cart_item->delete();
        }

        return response()->json([
            'success' => true,
            'message'  => 'تم حذف المنتج من السلة بنجاح',
            'cart_items_count'  => $cart_item->sum('qty')
        ]);

    }

    public function check_product_country(Request $request){
        $productIds = $request->productIds;

        $products = Product::whereIn('id', $productIds)->get();

        $countryIds = $products->pluck('country_id')->toArray();

        if (count(array_unique($countryIds)) > 1) {
            return response()->json([
                'success' => false,
                'message' => 'يجب أن تكون جميع المنتجات من نفس الدولة'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function make_order(CartOrderRequest $request){

        try {

            DB::beginTransaction();
            $seller = $this->sallerRepo->findWhere(['id' => $request->saller_id]);
            $fake = Factory::create();

            $lastSellerOrder = Order::where('saller_id', $seller->id)->latest()->first();
            $orderCode = $lastSellerOrder ? '00' . $lastSellerOrder->order_code + 1 :  '001';

            $order = new Order();

            $order->code    = $fake->unique()->numberBetween(10000 , 99999) ;
            $order->order_code = $orderCode;
            $order->saller_id = $seller->id;
            $order->admin_id = auth('admin')->user()->id;
            $order->status_id = 1;
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
            $order->date_order = now();
            $order->save();

            $total_products_cost = 0;
            $customer_total_products_cost = 0;
            $seller_total_profit = 0;
            $shipping_tax = Country::find($request->country)->delivery ?? 0;
            $service_cost = 0.0;
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

             $carts = $this->cartRepo->getWhere(['admin_id' => auth('admin')->user()->id]);
             foreach ($carts as $cart) {
                $cart->delete();
             }

            foreach ($order->items as $item) {
                $product = $this->productRepo->findWhere(['id' => $item->product_id]);

                $product->update([
                    'qty'  =>  $product->qty - $item->qty ,
                    'stock'  =>  $product->stock - $item->qty ,
                ]);

                if($product->qty <= 2){
                    $this->notifyRepo->create([
                        'admin_id'     => auth('admin')->user()->id ,
                        'product_id'     => $product->id ,
                        'title_ar'     => 'تم الوصول الي الحد الاقصي من المنتج'  . $product->name ,
                        'title_en'     =>  'تم الوصول الي الحد الاقصي من المنتج'  . $product->name,
                        'type'         => 'admins' ,
                   ]);
                }
            }


            DB::commit();

            // return redirect(route('saller.orders.index'))->with('success', __('models.added_successfully'));
            return response()->json([
                'success' => true,
                'message' => __('models.added_successfully')
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
