<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\News;
use App\Models\Order;
use App\Models\PayoutRequest;
use App\Models\Product;
use App\Models\Profit;
use App\Models\ProfitApp;
use App\Models\Pull;
use App\Models\Role;
use App\Models\Saller;
use App\Models\SallerProduct;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()  {

        if(auth('admin')->check()){

            if(auth('admin')->user()->type == 'admin'){
                $roles = Role::count();
                $admins = Admin::count();
                $countries = Country::count();
                $cities = City::count();
                $sallers = Saller::count();
                $categories = Category::where('type' , 'category')->count();
                $brands = Category::where('type' , 'brand')->count();
                $products = Product::count();
                $banners = Banner::count();
                $coupons = Banner::count();
                $users = User::count();
                $news = News::count();
                $stocks = Stock::count();

                $orders = Order::where('type' , 'order')->count();
                $order_waiting = Order::where('type' , 'order')->where('status_id' , 1)->count();
                $order_completed = Order::where('type' , 'order')->where('status_id' , 6)->count();
                $order_canceled = Order::where('type' , 'order')->where('status_id' , 7)->count();



                $day = [Carbon::parse(now()->startOfDay()), Carbon::parse(now()->endOfDay())];
                $week = [Carbon::parse(now()->startOfWeek()), Carbon::parse(now()->endOfWeek())];
                $month = [Carbon::parse(now()->startOfMonth()), Carbon::parse(now()->endOfMonth())];
                $year = [Carbon::parse(now()->startOfYear()), Carbon::parse(now()->endOfYear())];


                $profits = ProfitApp::sum('profit');
                $pulls = Pull::sum('pull');
                $profits_today = ProfitApp::whereBetween('created_at', $day)->sum('profit');
                $profits_week = ProfitApp::whereBetween('created_at', $week)->sum('profit');
                $profits_month = ProfitApp::whereBetween('created_at', $month)->sum('profit');
                $profits_year = ProfitApp::whereBetween('created_at', $year)->sum('profit');







                return view('dashboard.home' , compact('roles' ,'admins' , 'stocks' , 'countries' , 'sallers'  , 'news' , 'cities','categories' , 'brands' , 'products' , 'banners' , 'coupons' , 'users' , 'orders' , 'order_waiting' ,'order_completed' , 'order_canceled' ,
                 'profits' , 'profits_today' , 'profits_week' , 'profits_month' , 'profits_year' , 'pulls'));
            }elseif(auth('admin')->user()->type == 'saller'){

                $saller = auth('admin')->user()->saller ;
                $products = SallerProduct::where('saller_id' , $saller->id)->where('type' , 'products')->count();
                $fav_products = SallerProduct::where('saller_id' , $saller->id)->where('type' , 'fav')->count();
                $orders = $saller->orders()->count();

                $profits = $saller->amount ;
                $pulls = Pull::where('saller_id' , $saller->id)->sum('pull');
                $pull_requests = PayoutRequest::where('saller_id' , $saller->id)->sum('amount');


                $day = [Carbon::parse(now()->startOfDay()), Carbon::parse(now()->endOfDay())];
                $week = [Carbon::parse(now()->startOfWeek()), Carbon::parse(now()->endOfWeek())];
                $month = [Carbon::parse(now()->startOfMonth()), Carbon::parse(now()->endOfMonth())];
                $year = [Carbon::parse(now()->startOfYear()), Carbon::parse(now()->endOfYear())];



                $profits_today = Profit::where('saller_id' , $saller->id)->whereBetween('created_at', $day)->sum('profit');
                $profits_week = Profit::where('saller_id' , $saller->id)->whereBetween('created_at', $week)->sum('profit');
                $profits_month = Profit::where('saller_id' , $saller->id)->whereBetween('created_at', $month)->sum('profit');
                $profits_year = Profit::where('saller_id' , $saller->id)->whereBetween('created_at', $year)->sum('profit');

                return view('dashboard.home' , compact('products' ,'fav_products' , 'orders' , 'profits' ,'pulls' , 'pull_requests' , 'profits_today' , 'profits_week' , 'profits_month' , 'profits_year'));

            }


        }else{
            $user = auth()->user();
            $categories = Category::where('type' , 'category')->count();
            $brands = Category::where('type' , 'brand')->count();
            $stocks = Stock::count();
            $products = $user->products->count();
            $active_products = $user->products->where('is_active' , 1)->count();
            $unactive_products = $user->products->where('is_active' , 0)->count();

            $day = [Carbon::parse(now()->startOfDay()), Carbon::parse(now()->endOfDay())];
            $week = [Carbon::parse(now()->startOfWeek()), Carbon::parse(now()->endOfWeek())];
            $month = [Carbon::parse(now()->startOfMonth()), Carbon::parse(now()->endOfMonth())];
            $year = [Carbon::parse(now()->startOfYear()), Carbon::parse(now()->endOfYear())];



            $pulls = Pull::where('user_id' , $user->id)->sum('pull');
            $profits = Profit::where('user_id' , $user->id)->sum('profit');
            $profits_today = Profit::where('user_id' , $user->id)->whereBetween('created_at', $day)->sum('profit');
            $profits_week = Profit::where('user_id' , $user->id)->whereBetween('created_at', $week)->sum('profit');
            $profits_month = Profit::where('user_id' , $user->id)->whereBetween('created_at', $month)->sum('profit');
            $profits_year = Profit::where('user_id' , $user->id)->whereBetween('created_at', $year)->sum('profit');

            return view('dashboard.home' , compact('categories' , 'brands' , 'stocks' , 'products' , 'active_products' , 'unactive_products'
            , 'pulls' , 'profits' , 'profits_today' , 'profits_week' , 'profits_month' , 'profits_year'
        ));
        }

    }


    public function order_details($order_code){
        $order = Order::Where('code' , $order_code)->first();
        $setting = Setting::Where('type' , 'setting')->first();
        return view('dashboard.order' , compact('order', 'setting'));
    }
}
