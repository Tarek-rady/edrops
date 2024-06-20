<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Status;
use App\Repositories\Sql\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    protected $orderRepo ;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo ;
    }


    public function get_orders(Request $request)
    {



        $admin = auth('admin')->user();
        $saller = $admin->saller ;

        $orders = $this->orderRepo->query()->where('saller_id' , $saller->id );

        return DataTables($orders)



            ->filterColumn('status', function ($query, $keyword) {
                $query->whereRelation('status', 'id', $keyword);
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


            ->addColumn('action', 'dashboard.saller.orders.actions')

            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function index()
    {

        return view('dashboard.saller.orders.index');
    }


    public function show($id)
    {
        $order = $this->orderRepo->findOne($id);
        $admin = auth('admin')->user()->saller;
        $notify = Notification::where('order_id' , $id)->where('saller_id' , $admin->id)->where('type' , 'sallers')->first();
        if($notify){
            $notify->update([
              'read' => 1
            ]);
        }
        return view('dashboard.saller.orders.show' , compact('order'));
    }

    public function destroy($id)
    {
        $order = $this->orderRepo->findOne($id);

        if($order->status_id > 1){
            return redirect(route('saller.orders.index'))->with('error', __('لا يمكن حذا الاوردر'));
        }else{
            $order->delete();
            return redirect(route('saller.orders.index'))->with('success', __('models.deleted_successfully'));

        }

    }



}
