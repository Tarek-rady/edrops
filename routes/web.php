<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AskController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ContentController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\FeautureController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\NewsController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PayoutRequestController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfitAppController;
use App\Http\Controllers\Dashboard\RateController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SallerController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\StaticController;
use App\Http\Controllers\Dashboard\StepController;
use App\Http\Controllers\Dashboard\TermsController;
use App\Http\Controllers\Dashboard\TypeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Saller\AuthController as SallerAuthController;
use App\Http\Controllers\Saller\OrderController as SallerOrderController;
use App\Http\Controllers\Saller\ProductCatalogController;
use App\Http\Controllers\Saller\SellerProductController;
use App\Http\Controllers\Dashboard\CartController ;
use App\Http\Controllers\Saller\BulkUploadOrderController;
use App\Http\Controllers\Saller\WalletController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProfitController;
use App\Http\Controllers\Dashboard\ProfitUserController;
use App\Http\Controllers\Dashboard\PullController;
use App\Http\Controllers\Dashboard\CurrencyController;
use App\Http\Controllers\Dashboard\StockController;
use App\Http\Controllers\Saller\CartController as SallerCartController;
use App\Http\Controllers\Saller\SallerController as SallerSallerController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\ProfitUserController as UserProfitUserController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\User\WalletController as UserWalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('order-details/{order_code}' , [HomeController::class , 'order_details']);

Route::get('/opt', function () {
    return Artisan::call('optimize:clear');
});





Route::get('language/{locale}', function ($locale) {

    app()->setLocale($locale);

    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');

Route::get('/', [AuthController::class , 'showLoginForm'])->name('login');

Route::get('forget-password' , [AuthController::class , 'forget_password'])->name('forget-password');
Route::post('reset-password' , [AuthController::class , 'reset_password'])->name('reset-password');
Route::prefix('admin')->middleware('localization')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class , 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class , 'login'])->name('login.post');



    /* Dashboard Routes */
    Route::middleware('auth:admin')->group(function () {

        Route::get('/home', [HomeController::class , 'home'])->name('home');
        Route::get('logout', [AuthController::class , 'logout'])->name('logout');

        // roles
        Route::resource('roles', RoleController::class)->name('*','roles');
        Route::get('get-roles' , [RoleController::class , 'get_roles'])->name('get-roles');

        // admins
        Route::resource('/admins' , AdminController::class);
        Route::get('get-admin' , [AdminController::class , 'get_admins'])->name('get-admins');

        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('update-profile', 'AdminController@updateProfile')->name('update_profile');


        // countries
        Route::resource('/countries' , CountryController::class);
        Route::get('get-countries'   , [CountryController::class , 'get_countries'])->name('get-countries');

        // currencies
        Route::resource('/currencies' , CurrencyController::class);
        Route::get('get-currencies'   , [CurrencyController::class , 'get_currencies'])->name('get-currencies');

        // profits
        Route::resource('/profits' , ProfitController::class);
        Route::get('get-profits'   , [ProfitController::class , 'get_profits'])->name('get-profits');

        // pulls
        Route::resource('/pulls' , PullController::class)->only('index' , 'edit' , 'store');
        Route::get('get-pulls'   , [PullController::class , 'get_pulls'])->name('get-pulls');

        // cities
        Route::resource('/cities'         , CityController::class);
        Route::get('get-cities'           , [CityController::class , 'get_cities'])->name('get-cities');
        Route::get('/country-cities/{country_id}'  , [CityController::class , 'country_cities']);


        // stocks
        Route::resource('/stocks'         , StockController::class);
        Route::get('get-stocks'           , [StockController::class , 'get_stocks'])->name('get-stocks');
        Route::get('stock-products/{id}'  , [StockController::class , 'products'])->name('stock-products');
        Route::get('get-stock-products'  , [StockController::class , 'get_products'])->name('get-stock-products');
        Route::get('country-stocks/{country_id}'  , [StockController::class , 'stocks']);

        // profits-app
        Route::resource('/profits-app'         , ProfitAppController::class)->only('index');
        Route::get('get-profits-app'           , [ProfitAppController::class , 'get_profits'])->name('get-profits-app');

        Route::get('user-profits'             , [ProfitUserController::class , 'index'])->name('user-profits');
        Route::get('get-user-profits'           , [ProfitUserController::class , 'get_profits'])->name('get-user-profits');

        Route::get('user-pulls'             , [ProfitUserController::class , 'pulls'])->name('user-pulls');
        Route::get('get-user-pulls'           , [ProfitUserController::class , 'get_pulls'])->name('get-user-pulls');
        Route::post('user-pulls'             , [ProfitUserController::class , 'store'])->name('post-user-pulls');

        Route::get('user-payouts'             , [ProfitUserController::class , 'payouts'])->name('user-payouts');
        Route::get('get-user-payouts'           , [ProfitUserController::class , 'get_payouts'])->name('get-user-payouts');
        Route::put('update-user-payouts/{id}'             , [ProfitUserController::class , 'update'])->name('update-user-payouts');


        // sallers
        Route::resource('/sallers' , SallerController::class);
        Route::get('get-sallers'   , [SallerController::class , 'get_sallers'])->name('get-sallers');
        Route::get('new-sallers'   , [SallerController::class , 'new_sallers'])->name('new-sallers');
        Route::get('get-new-sallers'   , [SallerController::class , 'get_new_sallers'])->name('get-new-sallers');
        Route::get('/changeActiveSaller', [SallerController::class , 'changeActiveSaller'])->name('changeActiveSaller');
        Route::get('get-saller-pulls'   , [SallerController::class , 'get_pulls'])->name('get-saller-pulls');
        Route::get('get-saller-profits'   , [SallerController::class , 'get_profits'])->name('get-saller-profits');

        // categories
        Route::resource('/categories' , CategoryController::class);
        Route::get('get-categories' , [CategoryController::class , 'get_categories'])->name('get-categories');
        Route::get('export-categories' , [CategoryController::class , 'export'])->name('export-categories');

        // brands
        Route::resource('/brands' , BrandController::class);
        Route::get('get-brands'   , [BrandController::class , 'get_brands'])->name('get-brands');
        Route::get('export-brands' , [BrandController::class , 'export'])->name('export-brands');

        // products
        Route::resource('/products' , ProductController::class);
        Route::get('get-products' , [ProductController::class , 'get_products'])->name('get-products');
        Route::get('filter-price' , [ProductController::class , 'get_products'])->name('filter-price');
        Route::post('/upload.file' , [ProductController::class , 'uploadFile'])->name('upload.file');
        Route::get('export-products' , [ProductController::class , 'export'])->name('export-products');
        Route::get('new-products' , [ProductController::class , 'products'])->name('new-products');
        Route::get('get-new-products' , [ProductController::class , 'get_new_products'])->name('get-new-products');
        Route::get('/changeActiveProduct', [ProductController::class , 'changeActiveProduct'])->name('changeActiveProduct');

        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [CartController::class , 'index'])->name('index');
            Route::post('add/{product_id}', [CartController::class , 'add_cart'])->name('add');
            Route::post('remove/{product_id}', [CartController::class , 'remove_cart'])->name('remove');
            Route::post('check_product_country/', [CartController::class , 'check_product_country'])->name('check_product_country');
            Route::post('make_order/', [CartController::class , 'make_order'])->name('make_order');

        });



        // banners
        Route::resource('/banners'        , BannerController::class);
        Route::get('get-banners'          , [BannerController::class , 'get_banners'])->name('get-banners');
        Route::get('changeBannerstatus'   , [BannerController::class , 'changeBannerstatus'])->name('changeBannerstatus');
        Route::get('export-banners'       , [BannerController::class , 'export'])->name('export-banners');

        // payouts
        Route::resource('/payouts'        , PayoutRequestController::class);
        Route::get('get-payouts'          , [PayoutRequestController::class , 'get_payouts'])->name('get-payouts');

        // statics
        Route::resource('/statics'        , StaticController::class);
        Route::get('get-statics'          , [StaticController::class , 'get_statics'])->name('get-statics');

        // feautures
        Route::resource('/feautures'        , FeautureController::class);
        Route::get('get-feautures'          , [FeautureController::class , 'get_feautures'])->name('get-feautures');

        // steps
        Route::resource('/steps'        , StepController::class);
        Route::get('get-steps'          , [StepController::class , 'get_steps'])->name('get-steps');

        // users
        Route::resource('/users' , UserController::class);
        Route::get('get-user' , [UserController::class , 'get_users'])->name('get-users');
        Route::get('get-users' , [UserController::class , 'users'])->name('new-users');
        Route::get('get-new-user' , [UserController::class , 'get_new_users'])->name('get-new-users');
        Route::get('/changeActiveUser', [UserController::class , 'changeActiveUser'])->name('changeActiveUser');
        Route::get('export-users'       , [UserController::class , 'export'])->name('export-users');

        // orders
        Route::resource('/orders' , OrderController::class);
        Route::get('get-orders' , [OrderController::class , 'get_orders'])->name('get-orders');
        Route::get('product-details/{id}' , [OrderController::class , 'product_details'])->name('product-details');
        Route::put('update-status/{order_id}' , [OrderController::class , 'update_status'])->name('update-status');
        Route::get('export-orders'            , [OrderController::class , 'export'])->name('export-orders');
        Route::post('update-order' , [OrderController::class , 'make_order'])->name('update-order');
        // contacts
        Route::resource('/contacts' , ContactController::class);
        Route::get('get-contacts' , [ContactController::class , 'get_contacts'])->name('get-contacts');

        // contents
        Route::resource('/contents' , ContentController::class);
        Route::get('get-contents' , [ContentController::class , 'get_contents'])->name('get-contents');

        // asks
        Route::resource('/asks' , AskController::class);
        Route::get('get-asks' , [AskController::class , 'get_asks'])->name('get-asks');

        // rates
        Route::resource('/rates' , RateController::class);
        Route::get('get-rates' , [RateController::class , 'get_rates'])->name('get-rates');

        // news
        Route::resource('/news' , NewsController::class);
        Route::get('get-news' , [NewsController::class , 'get_news'])->name('get-news');

        Route::get ('setting' , [SettingController::class , 'setting'])->name('setting');
        Route::put('update-setting' , [SettingController::class , 'store_setting'])->name('update-setting');

        Route::get ('static' , [SettingController::class , 'static'])->name('static');
        Route::put('update-static' , [SettingController::class , 'update_static'])->name('update-static');

        // terms
        Route::resource('/terms'        , TermsController::class);
        Route::get('get-terms'          , [TermsController::class , 'get_terms'])->name('get-terms');
        Route::get('export-terms'       , [TermsController::class , 'export'])->name('export-terms');

        // types
        Route::resource('/types' , TypeController::class);
        Route::get('get-types' , [TypeController::class , 'get_types'])->name('get-types');
        Route::get('export-types'       , [TypeController::class , 'export'])->name('export-types');

        Route::get ('reports' , [SettingController::class , 'reports'])->name('reports');

    });


});

Route::get('active-saller/{id}'          , [SallerController::class , 'finish_page'])->name('active-saller');

Route::prefix('saller')->middleware('localization')->name('saller.')->group(function () {
    Route::get('/country-cities/{country_id}'  , [SallerAuthController::class , 'country_cities'])->name('country_cities');
    Route::get('/show-register', [SallerAuthController::class , 'showregisterForm'])->name('show-register');
    Route::post('/register', [SallerAuthController::class , 'register'])->name('register');

    Route::get('/login', [SallerAuthController::class , 'showLoginForm'])->name('login');
    Route::post('login', [SallerAuthController::class , 'login'])->name('login.post');

    Route::middleware('auth:admin')->group(function () {

        // saller Auth ==============
        Route::get('/home'        , [HomeController::class , 'home'])->name('home');
        Route::get('/profile'     , [SallerAuthController::class , 'profile'])->name('profile');
        Route::get('/edit-profile',    [SallerAuthController::class , 'edit'])->name('edit-profile');
        Route::put('/update-profile/{id}',    [SallerAuthController::class , 'update'])->name('update-profile');
        Route::get('logout'       , [SallerAuthController::class , 'logout'])->name('logout');


        //

        Route::get('products-catalog' , [ProductCatalogController::class , 'products'])->name('products-catalog');
        Route::get('products-catalog/filter' , [ProductCatalogController::class , 'filter_products'])->name('filter.products');
        Route::post('products/{id}/add_to_my_products' , [SellerProductController::class , 'add_product'])->name('product.add');
        Route::get('/products' , [SellerProductController::class , 'index'])->name('products');
        Route::get('/products/{id}' , [SellerProductController::class , 'show'])->name('products.show');
        Route::get('/get-products' , [SellerProductController::class , 'my_products'])->name('my_products');
        Route::post('/product/rate' , [SellerProductController::class , 'rate_product'])->name('product.rate');

        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [SallerCartController::class , 'index'])->name('index');
            Route::post('add/{product_id}', [SallerCartController::class , 'add_cart'])->name('add');
            Route::post('remove/{product_id}', [SallerCartController::class , 'remove_cart'])->name('remove');
            Route::post('check_product_country/', [SallerCartController::class , 'check_product_country'])->name('check_product_country');
            Route::post('make_order/', [SallerCartController::class , 'make_order'])->name('make_order');

        });

        Route::prefix('bulkUploadOrders')->name('bulkUploadOrders.')->group(function () {
            Route::get('/', [BulkUploadOrderController::class , 'index'])->name('index');
            Route::post('/make_order', [BulkUploadOrderController::class , 'make_order'])->name('make_order');
            Route::post('/check_product_sku', [BulkUploadOrderController::class , 'check_product'])->name('check_product_sku');
            Route::post('/check_product_country', [BulkUploadOrderController::class , 'check_product_country'])->name('check_product_country');

        });

        Route::prefix('wallet')->name('wallet.')->group(function () {
            Route::get('/', [WalletController::class , 'index'])->name('index');
            Route::get('/my_payouts', [WalletController::class , 'my_payouts'])->name('my_payouts');
            Route::post('/make_payout_request', [WalletController::class , 'payout_request'])->name('make_payout_request');
        });

        // orders
        Route::resource('/orders' , SallerOrderController::class);
        Route::get('get-orders'   , [SallerOrderController::class , 'get_orders'])->name('get-orders');
        Route::get('delete-product/{id}' , [SellerProductController::class , 'delete_product'])->name('delete-product');

        // new ======================================================
        Route::get('profits'   , [SallerSallerController::class , 'profits'])->name('profits');
        Route::get('get-profits'   , [SallerSallerController::class , 'get_profits'])->name('get-profits');
        Route::get('pulls'   , [SallerSallerController::class , 'pulls'])->name('pulls');
        Route::get('get-pulls'   , [SallerSallerController::class , 'get_pulls'])->name('get-pulls');
        Route::get('payouts'          , [SallerSallerController::class , 'payouts'])->name('payouts');
        Route::get('get-payouts'          , [SallerSallerController::class , 'get_payouts'])->name('get-payouts');

        Route::get('change-currency/{currency_id}'          , [SallerSallerController::class , 'change_currency'])->name('change-currency');

    });

});



Route::get('active-user/{id}'          , [UserController::class , 'finish_page'])->name('active-user');

Route::prefix('user')->middleware('localization')->name('user.')->group(function () {
    Route::get('/show-register', [UserAuthController::class , 'showregisterForm'])->name('show-register');
    Route::post('/register', [UserAuthController::class , 'register'])->name('register');

    Route::get('/login', [UserAuthController::class , 'showLoginForm'])->name('login');
    Route::post('login', [UserAuthController::class , 'login'])->name('login.post');

    Route::middleware('auth')->group(function () {

        Route::get('/home'        , [HomeController::class , 'home'])->name('home');
        // auth user
        Route::get('/profile'     , [UserAuthController::class , 'profile'])->name('profile');
        Route::get('/edit-profile',    [UserAuthController::class , 'edit'])->name('edit-profile');
        Route::put('/update-profile/{id}',    [UserAuthController::class , 'update'])->name('update-profile');
        Route::get('logout'       , [UserAuthController::class , 'logout'])->name('logout');




        // stocks
        Route::get('stocks'       , [UserUserController::class , 'stocks'])->name('stocks');
        Route::get('get-stocks'       , [UserUserController::class , 'get_stocks'])->name('get-stocks');

        Route::get('country-stocks/{country_id}'  , [UserUserController::class , 'country_stocks']);

        // categories
        Route::get('categories'       , [UserUserController::class , 'categories'])->name('categories');
        Route::get('get-categories'       , [UserUserController::class , 'get_categories'])->name('get-categories');

        // brands
        Route::get('brands'       , [UserUserController::class , 'brands'])->name('brands');
        Route::get('get-brands'       , [UserUserController::class , 'get_brands'])->name('get-brands');


        // products
        Route::resource('/products'   , UserProductController::class);
        Route::get('get-products'     , [UserProductController::class , 'get_products'])->name('get-products');
        Route::get('new-products'     , [UserProductController::class , 'products'])->name('new-products');
        Route::get('get-new-products' , [UserProductController::class , 'get_new_products'])->name('get-new-products');
        Route::post('/upload.file'    , [UserProductController::class , 'uploadFile'])->name('upload.file');


        Route::get('user-profits'             , [UserProfitUserController::class , 'index'])->name('user-profits');
        Route::get('get-user-profits'           , [UserProfitUserController::class , 'get_profits'])->name('get-user-profits');

        Route::get('user-pulls'             , [UserProfitUserController::class , 'pulls'])->name('user-pulls');
        Route::get('get-user-pulls'           , [UserProfitUserController::class , 'get_pulls'])->name('get-user-pulls');

        Route::get('user-payouts'             , [UserProfitUserController::class , 'payouts'])->name('user-payouts');
        Route::get('get-user-payouts'           , [UserProfitUserController::class , 'get_payouts'])->name('get-user-payouts');

        Route::prefix('wallet')->name('wallet.')->group(function () {
            Route::get('/', [UserWalletController::class , 'index'])->name('index');
            Route::get('/my_payouts', [UserWalletController::class , 'my_payouts'])->name('my_payouts');
            Route::post('/make_payout_request', [UserWalletController::class , 'payout_request'])->name('make_payout_request');
        });

    });

});
