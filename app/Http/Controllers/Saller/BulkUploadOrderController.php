<?php

namespace App\Http\Controllers\saller;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\City;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\Saller\BulkOrderRequest;

class BulkUploadOrderController extends Controller
{
    use ApiResponseTrait ;

    public function index() {
        $countries = Country::all();
        return view('dashboard.saller.bulk_orders.index', compact('countries'));
    }

    public function check_product(Request $request) {
        foreach ($request->skus as $key=>$sku) {
            $product = Product::where('sku', $sku)->first();
            if(!$product){
                return response()->json([
                    'success' => false,
                    'message' => 'قم بألتاكد من ال sku الخاص بالمنتجات'
                ]);
            }
        }
        return response()->json([
            'success' => true
        ]);
    }

    public function check_product_country(Request $request){
        foreach ($request->orders as $key => $order) {
            $productSkus = $order['products'];

            $products = Product::whereIn('sku', $productSkus)->get();

            $countryIds = $products->pluck('country_id')->toArray();

            if (count(array_unique($countryIds)) > 1) {
                $errorMessage = 'في الطلب رقم ' . $key+1 . PHP_EOL;
                $errorMessage .= 'يجب أن تكون جميع المنتجات من نفس الدولة';
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }
        }
        return response()->json([
            'success' => true
        ]);
    }

    public function make_order(BulkOrderRequest $request) {

        try {

            DB::beginTransaction();
            $seller = auth('admin')->user()->saller;

            foreach ($request->orders as $sallerOrder) {

                $lastSellerOrder = Order::where('saller_id', $seller->id)->latest('id')->first();
                $orderCode = $lastSellerOrder ? '00' . $lastSellerOrder->order_code + 1 :  '001';

                $order = new Order();
                $order->order_code = $orderCode;
                $order->saller_id = $seller->id;
                $order->status_id = 1;
                $order->customer_name = $sallerOrder['customer_name'];
                $order->country = $sallerOrder['country'];
                $order->country_code ='555';
                $order->city = $sallerOrder['city'];
                $order->phone = $sallerOrder['phone'];
                $order->address = $sallerOrder['address'];
                $order->notes = $sallerOrder['notes'];
                $order->type = 'order';
                $order->date_order = now();
                $order->save();

                $total_products_cost = 0;
                $customer_total_products_cost = 0;
                $seller_total_profit = 0;
                $shipping_tax = Country::find($sallerOrder['country'])->delivery ?? 0;
                $service_cost = 0.0;
                foreach ($sallerOrder['products'] as $product) {
                    $getProduct = Product::where('sku', $product['sku'])->first();
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $getProduct->id;
                    $orderItem->qty = $product['qty'];
                    $orderItem->product_cost_price = $getProduct->cost;
                    $orderItem->product_selling_price = $product['selling_price'];
                    $orderItem->total = $product['selling_price'] * $product['qty'];
                    $orderItem->save();

                    $total_products_cost +=( $getProduct->cost  * $product['qty'] );
                    $customer_total_products_cost +=( $product['selling_price'] * $product['qty'] );
                    $seller_total_profit += ($product['selling_price'] - $getProduct->cost ) * $product['qty'];
                }

                $order->total_products_cost = $total_products_cost;
                $order->shipping_tax = $shipping_tax;
                $order->customer_total_cost = $customer_total_products_cost + $shipping_tax;
                $order->saller_total_profit = $seller_total_profit + $service_cost;
                $order->save();
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
