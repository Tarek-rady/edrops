<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\OrderExport;
use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CartOrderRequest;
use App\Models\Country;
use App\Models\OrderItem;
use App\Models\Status;
use App\Repositories\Sql\CartRepository;
use App\Repositories\Sql\NotificationRepository;
use App\Repositories\Sql\OrderRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\SallerRepository;
use App\Repositories\Sql\UserRepository;
use App\Services\Admin\OrderService;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    protected $orderRepo,  $productRepo  , $notifyRepo , $sallerRepo , $userRepo , $cartRepo , $orderService ;
    use GetRoleStocks;
    public function __construct(OrderRepository $orderRepo,  ProductRepository $productRepo  , NotificationRepository $notifyRepo , SallerRepository $sallerRepo ,
     UserRepository $userRepo , CartRepository $cartRepo , OrderService $orderService)
    {
        $this->middleware('permission:orders-read')->only(['index']);
        $this->middleware('permission:orders-create')->only(['create', 'store']);
        $this->middleware('permission:orders-update')->only(['edit', 'update']);
        $this->middleware('permission:orders-delete')->only(['destroy']);
        $this->orderRepo    = $orderRepo;
        $this->productRepo  = $productRepo;
        $this->notifyRepo   = $notifyRepo;
        $this->sallerRepo   = $sallerRepo;
        $this->userRepo     = $userRepo;
        $this->cartRepo     = $cartRepo;
        $this->orderService = $orderService;

    }


    public function get_orders(Request $request)
    {
        return $this->orderService->get_orders();

    }


    public function index()
    {
        $statuses = Status::get();
        $sallers = $this->sallerRepo->getAll();
        return view('dashboard.backend.orders.index', compact('statuses' , 'sallers'));
    }

    public function show($id)
    {
        $order = $this->orderRepo->findOne($id);
        return view('dashboard.backend.orders.show', compact('order' ));
    }

    public function edit($id){
        $order = $this->orderRepo->findOne($id);
        $sallers = $this->sallerRepo->getWhere(['is_active' => 1]);
        $countries  = Country::all();
       return view('dashboard.backend.orders.edit' , compact('order' , 'sallers' , 'countries'));
    }


    public function update_status(Request $request, $id)
    {

        $order = $this->orderRepo->findOne($id);
        $this->orderService->update_status($request , $order);

        return redirect(route('admin.orders.index'))->with('success', __('models.updated_successfully'));
    }


    public function destroy($id)
    {
        $order = $this->orderRepo->findOne($id);

        if($order->status_id > 1){
            return redirect(route('admin.orders.index'))->with('error', __('لا يمكن حذا الاوردر'));
        }else{
            $order->delete();
            return redirect(route('admin.orders.index'))->with('success', __('models.deleted_successfully'));

        }

    }


    public function product_details($id)
    {
        $notification = $this->notifyRepo->findOne($id);
        $notification->update([
            'read' => 1
        ]);


        $product = $this->productRepo->findWhere(['id' => $notification->product_id ]);
        return view('dashboard.backend.products.show', compact('product'));
    }

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function make_order(CartOrderRequest $request){
      return  $this->orderService->create_order($request);
    }



}
