<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\Saller\CartOrderRequest;
use App\Models\Notification;
use Faker\Factory;


class CartController extends Controller
{

    public function index() {
        $seller = auth('admin')->user()->saller;
        $cart_items = Cart::where('saller_id', $seller->id)->get();

        if(!count($cart_items)) return redirect()->route('saller.products-catalog');

        $countries = Country::all();

        return view('dashboard.saller.cart.index', compact('cart_items', 'countries'));
    }

    public function add_cart($product_id) {

        $seller = auth('admin')->user()->saller;

        $cart_item = Cart::where('saller_id', $seller->id)->where('product_id', $product_id)->where('type' , 'saller')->first();

        if($cart_item){
            $cart_item->qty +=1;
            $cart_item->type = 'saller' ;

            $cart_item->save();
        }else{
            $cart_item = Cart::create([
                'type'     => 'saller' ,
                'saller_id' => $seller->id,
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

        $seller = auth('admin')->user()->saller;

        $cart_item = Cart::where('saller_id', $seller->id)->where('product_id', $product_id)->first();

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
            $seller = auth('admin')->user()->saller;
            $fake = Factory::create();

            $lastSellerOrder = Order::where('saller_id', $seller->id)->latest('id')->first();
            $orderCode = $lastSellerOrder ? '00' . $lastSellerOrder->order_code + 1 :  '001';

            $order = new Order();

            $order->code    = $fake->unique()->numberBetween(10000 , 99999) ;
            $order->order_code = $orderCode;
            $order->saller_id = $seller->id;
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

            Cart::where('saller_id', $seller->id)->delete();

            foreach ($order->items as $item) {
                $product = Product::where('id' , $item->product_id)->first();

                $product->update([
                    'qty'  =>  $product->qty - $item->qty ,
                    'stock'  =>  $product->stock - $item->qty ,
                ]);

                if($product->qty <= 2){
                    Notification::create([
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

            return response()->json([
                'success' => false,
                'message' => __('models.something_went_wrong')
            ]);
        }

    }


}
