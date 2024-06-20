<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Rate;
use App\Models\StaticPage;
use App\Repositories\Sql\SettingPageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $settingRepo ;

    public function __construct(SettingPageRepository $settingRepo)
    {
        $this->middleware('permission:settings-read')->only(['index']);
        $this->middleware('permission:settings-update')->only(['edit', 'update']);
        $this->settingRepo     = $settingRepo ;
    }


    public function setting(){
        $setting = $this->settingRepo->findWhere(['type' => 'setting']);
        return view('dashboard.backend.setting.setting' , compact('setting'));
    }


    public function store_setting(SettingRequest $request){

        $setting = $this->settingRepo->findWhere(['type' => 'setting']);

        $data = $request->except('logo' , 'icon' , '1');

        if ($request->hasFile('logo')) {
            if( $setting->logo){
                Storage::delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings');

        } else {
            $data['logo'] = $setting->logo;
        }

        $setting->update($data);
        return redirect(route('admin.setting'))->with('success', __('models.updated_successfully'));

    }

    public function static(){

        $static = StaticPage::where('type' , 'static')->first();
        return view('dashboard.backend.setting.static' , compact('static'));
    }

    public function update_static(Request $request){

        $static = StaticPage::where('type' , 'static')->first();

        $data = $request->except('img' );

        if ($request->hasFile('img')) {
            if( $static->img){
                Storage::delete($static->img);
            }
            $data['img'] = $request->file('img')->store('statics');

        } else {
            $data['img'] = $static->img;
        }

        $static->update($data);
        return redirect(route('admin.static'))->with('success', __('models.updated_successfully'));

    }


    public function reports(){

        $sallers_rated = Rate::select('saller_id', DB::raw('avg(rate) as average_rate'))
            ->groupBy('saller_id')
            ->where('type' , 'sallers')
            ->orderByDesc('average_rate')
            ->take(5)
            ->get();


        $products_rated = Rate::select('product_id', DB::raw('avg(rate) as average_rate'))
            ->groupBy('product_id')
            ->where('type' , 'products')
            ->orderByDesc('average_rate')
            ->take(5)
            ->get();


        return view('dashboard.backend.setting.reports' , compact('sallers_rated' , 'products_rated'));



    }
}





