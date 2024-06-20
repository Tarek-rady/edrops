<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CurrencyRequest;
use App\Repositories\Sql\CurrencyRepository;
use App\Services\Admin\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CurrencyController extends Controller
{
    protected $currencyRepo , $currencyService;

    public function __construct(CurrencyRepository $currencyRepo , CurrencyService $currencyService)
    {
        $this->middleware('permission:currencies-read')->only(['index']);
        $this->middleware('permission:currencies-create')->only(['create', 'store']);
        $this->middleware('permission:currencies-update')->only(['edit', 'update']);
        $this->middleware('permission:currencies-delete')->only(['destroy']);
        $this->currencyRepo    = $currencyRepo ;
        $this->currencyService = $currencyService ;

    }


    public function get_currencies()
    {
        return $this->currencyService->get_currencies();

    }

    public function index()
    {

         return view('dashboard.backend.currencies.index');
    }


    public function create()
    {
         return view('dashboard.backend.currencies.create');
    }


    public function store(CurrencyRequest $request)
    {

       $data = $request->all();
        $this->currencyService->add_currency($request , $data);
        return redirect(route('admin.currencies.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $currency = $this->currencyRepo->findOne($id);

        return view('dashboard.backend.currencies.edit' , compact('currency'));

    }


    public function update(CurrencyRequest $request, $id)
    {
         $currency = $this->currencyRepo->findOne($id);
         $data = $request->except('id');
         $this->currencyService->update_currency($request , $data , $currency);
        return redirect(route('admin.currencies.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $currency = $this->currencyRepo->findOne($id)->delete();
        return redirect(route('admin.currencies.index'))->with('success', __('models.deleted_successfully'));

    }
}
