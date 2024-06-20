<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\RateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RateRequest;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\RateRepository;
use App\Repositories\Sql\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RateController extends Controller
{
    protected $rateRepo , $countryRepo;

    public function __construct(RateRepository $rateRepo , CountryRepository $countryRepo)
    {
        $this->middleware('permission:rates-read')->only(['index']);
        $this->middleware('permission:rates-create')->only(['create', 'store']);
        $this->middleware('permission:rates-update')->only(['edit', 'update']);
        $this->middleware('permission:rates-delete')->only(['destroy']);
        $this->rateRepo    = $rateRepo ;
        $this->countryRepo = $countryRepo ;

    }


    public function get_rates()
    {
        $rates = $this->rateRepo->query()->where('type' , 'users');
        return DataTables($rates)

        ->editColumn('rate', function ($rate) {
            $stars = '<div class="text-muted fs-16">';
            for ($i = 1; $i < 6; $i++) {
                $stars .= '<span class="mdi mdi-star ' . ($rate->rate >= $i ? 'text-warning' : '') . '"></span>';
            }
            $stars .= '</div>';
            return $stars;
        })


        ->editColumn('created_at' , function($rate){
            return $rate->created_at->format('y-m-d');
        })

        ->editColumn('country' , function($rate){
            return $rate->country->name;
        })
        ->addColumn('action', 'dashboard.backend.rates.actions')


        ->rawColumns(['rate' , 'action'])
        ->make(true);

    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.rates.index' , compact('countries'));
    }


    public function create()
    {
        $countries = $this->countryRepo->getAll();

        return view('dashboard.backend.rates.create' , compact('countries'));
    }


    public function store(RateRequest $request)
    {

        $data = $request->except('type');
        $data['type'] = 'users' ;
        $rate = $this->rateRepo->create($data);



        return redirect(route('admin.rates.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rate = $this->rateRepo->findOne($id);
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.rates.edit' , compact('rate' , 'countries'));

    }


    public function update(RateRequest $request, $id)
    {
        $rate = $this->rateRepo->findOne($id);
        $data = $request->except('type');

        $data['type'] = 'users' ;
        $rate->update($data);
        return redirect(route('admin.rates.index'))->with('success', __('models.updated_successfully'));

    }







    public function destroy($id)
    {
         $rate = $this->rateRepo->findOne($id);

        if ($rate->img) {
            Storage::delete($rate->img);
        }

        $rate->delete();

        return redirect(route('admin.rates.index'))->with('success', __('models.deleted_successfully'));

    }

    public function export()
    {
        return Excel::download(new RateExport, 'rates.xlsx');
    }
}
