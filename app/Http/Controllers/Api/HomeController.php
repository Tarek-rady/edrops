<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AskResource;
use App\Http\Resources\Api\BannerResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\NewsResource;
use App\Http\Resources\Api\NumberResource;
use App\Http\Resources\Api\RateResource;
use App\Http\Resources\Api\SettingResource;
use App\Http\Resources\Api\StaticResource;
use App\Repositories\Sql\BannerRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\NewsRepository;
use App\Repositories\Sql\RateRepository;
use App\Repositories\Sql\SettingPageRepository;
use App\Repositories\Sql\StaticPageRepository;
use App\Repositories\Sql\TermsRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponseTrait ;

    protected $bannerRepo , $staticRepo , $termRepo , $countryRepo , $newsRepo , $rateRepo , $settingRepo ;
    public function __construct(BannerRepository $bannerRepo , StaticPageRepository $staticRepo , TermsRepository $termRepo , CountryRepository $countryRepo , RateRepository $rateRepo , SettingPageRepository $settingRepo , NewsRepository $newsRepo)
    {

        $this->bannerRepo     =  $bannerRepo ;
        $this->staticRepo     =  $staticRepo ;
        $this->termRepo       =  $termRepo ;
        $this->countryRepo    =  $countryRepo ;
        $this->rateRepo       =  $rateRepo ;
        $this->settingRepo    =  $settingRepo ;
        $this->newsRepo       =  $newsRepo ;

    }


    public function home(){

        $banners    = $this->bannerRepo->getWhere(['status' => 'active']);
        $steps      = $this->staticRepo->getWhere(['type' => 'step']);
        $terms      = $this->termRepo->getWhere(['type' => 'terms']);
        $feautures  = $this->staticRepo->getWhere(['type' => 'feauture']);
        $countries  = $this->countryRepo->getAll();
        $statics    = $this->staticRepo->getWhere(['type' => 'static']);
        $rates      = $this->rateRepo->getWhere(['type'  => 'users']);
        $asks       = $this->termRepo->getWhere(['type' => 'asks']);

        $response = [

            'banners'      => BannerResource::collection($banners) ,
            'steps'        => CategoryResource::collection($steps) ,
            'terms'        => StaticResource::collection($terms) ,
            'feautures'    => CategoryResource::collection($feautures) ,
            'countries'    => CountryResource::collection($countries) ,
            'statics'      => NumberResource::collection($statics) ,
            'rates'        => RateResource::collection($rates) ,
            'asks'         => AskResource::collection($asks) ,

        ];

        return $this->ApiResponse($response , '' , 200);





    }

    public function setting(){
       $setting = $this->settingRepo->findWhere(['type' => 'setting']) ;

       return $this->ApiResponse(new SettingResource($setting) , '' , 200 );
    }

    public function news(){
       $news = $this->newsRepo->getAll();
       return $this->ApiResponse(NewsResource::collection($news) , '' , 200);
    }

    public function news_details($id){
        $news = $this->newsRepo->findWhere(['id' => $id]);
        return $news ? $this->ApiResponse(new NewsResource($news) , '' , 200) : $this->notFoundResponse();
     }
}
