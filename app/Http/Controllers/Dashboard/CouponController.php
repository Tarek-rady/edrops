<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CouponExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Repositories\Sql\CouponRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CouponController extends Controller
{
    protected $couponRepo ;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->middleware('permission:coupons-read')->only(['index']);
        $this->middleware('permission:coupons-create')->only(['create', 'store']);
        $this->middleware('permission:coupons-update')->only(['edit', 'update']);
        $this->middleware('permission:coupons-delete')->only(['destroy']);
        $this->couponRepo = $couponRepo ;

    }


    public function get_coupons()
    {
        $coupons = $this->couponRepo->query();
        return DataTables($coupons)

        ->editColumn('value' , function($coupon){
            $type = $coupon->type == 'fixed' ? '<span class="badge bg-info-subtle text-info badge-border">'. $coupon->value.'</span>': '<span class="badge bg-info-subtle text-danger badge-border">'. $coupon->value .'%'.'</span>'  ;
            return $type;
        })
        ->editColumn('type' , function($coupon){
            $type = $coupon->type == 'fixed' ? '<span class="badge bg-info-subtle text-info badge-border">'. $coupon->type.'</span>': '<span class="badge bg-info-subtle text-danger badge-border">'. $coupon->type.'</span>'  ;
            return $type;
        })
        ->editColumn('created_at' , function($coupon){
            return $coupon->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.coupons.actions')

        ->rawColumns(['action'  , 'value' , 'type'])
        ->make(true);

    }

    public function index()
    {
         return view('dashboard.backend.coupons.index');
    }


    public function create()
    {
         return view('dashboard.backend.coupons.create');
    }


    public function store(CouponRequest $request)
    {

        $this->couponRepo->create($request->all());
        return redirect(route('admin.coupons.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $coupon = $this->couponRepo->findOne($id);
        return view('dashboard.backend.coupons.edit' , compact('coupon'));

    }


    public function update(CouponRequest $request, $id)
    {
        $coupon = $this->couponRepo->findOne($id);
        $data = $request->except('id');
        $coupon->update($data);
        return redirect(route('admin.coupons.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $coupon = $this->couponRepo->findOne($id)->delete();

         return redirect(route('admin.coupons.index'))->with('success', __('models.deleted_successfully'));

    }

    public function export()
    {
        return Excel::download(new CouponExport, 'coupons.xlsx');
    }
}
