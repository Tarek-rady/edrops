@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.setting') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.setting') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('models.categories') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.setting') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.update-setting' , $setting->id) }}" enctype="multipart/form-data" novalidate>
                     @method('PUT')
                    @csrf

                    {{--  twitter  --}}
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-body text-body shadow">
                                <i class="ri-twitter-fill"></i>
                            </span>
                        </div>
                        <input type="text"  class="form-control" id="twitter" name="twitter" placeholder="twitter" value="{{ $setting->twitter }}">
                    </div>

                    {{--  facebook  --}}
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-primary shadow">
                                <i class="ri-facebook-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder="www.example.com" value="{{ $setting->facebook }}">
                    </div>

                    {{--  youtube  --}}
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-danger shadow">
                                <i class="ri-youtube-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="youtube" name="youtube" placeholder="youtube" value="{{ $setting->youtube }}">
                    </div>

                    {{--  instagram  --}}
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-danger shadow">
                                <i class="ri-instagram-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="instagram" value="{{ $setting->instagram }}">
                    </div>

                    {{--  email  --}}
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-success shadow">
                                <i class="ri-dribbble-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ $setting->email }}">
                    </div>

                    {{--  gmail  --}}
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-primary shadow">
                                <i class="ri-pinterest-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="gmail" name="gmail" placeholder="gmail" value="{{ $setting->gmail }}">
                    </div>


                    {{--  wattsapp  --}}
                    <div class="col-md-6">
                        <label for="wattsapp" class="form-label">{{ __('models.wattsapp') }}</label>
                        <input type="number" class="form-control" name="wattsapp" value="{{ old('wattsapp' , $setting->wattsapp) }}" id="wattsapp" >

                    </div>


                    {{--  phone  --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label">{{ __('models.phone') }}</label>
                        <input type="number" class="form-control" name="phone" value="{{ old('phone' , $setting->phone) }}" id="phone" >

                    </div>

                    {{--  profit_app  --}}
                    <div class="col-md-6">
                        <label for="profit_app" class="form-label">{{ __('models.profit_app') }}</label>
                        <input type="text" class="form-control" name="profit_app" value="{{ old('profit_app' , $setting->profit_app) }}" id="profit_app" >

                    </div>

                    {{--  profit_saller  --}}
                    <div class="col-md-6">
                        <label for="profit_saller" class="form-label">{{ __('models.profit_saller') }}</label>
                        <input type="text" class="form-control" name="profit_saller" value="{{ old('profit_saller' , $setting->profit_saller) }}" id="profit_saller" >

                    </div>



                    {{--  min  --}}
                    <div class="col-md-6">
                        <label for="min" class="form-label">{{ __('models.min') }}</label>
                        <input type="text" class="form-control" name="min" value="{{ old('min' , $setting->min) }}" id="min" >

                    </div>


                    {{--  max  --}}
                    <div class="col-md-6">
                        <label for="max" class="form-label">{{ __('models.max') }}</label>
                        <input type="text" class="form-control" name="max" value="{{ old('max' , $setting->max) }}" id="max" >

                    </div>

                    {{--  bronze  --}}
                    <div class="col-md-4">
                        <label for="bronze" class="form-label">{{ __('models.bronze') }}</label>
                        <input type="number" class="form-control" name="bronze" value="{{ old('bronze' , $setting->bronze) }}" id="bronze" >

                    </div>

                    {{--  silver  --}}
                    <div class="col-md-4">
                        <label for="silver" class="form-label">{{ __('models.silver') }}</label>
                        <input type="number" class="form-control" name="silver" value="{{ old('silver' , $setting->silver) }}" id="silver" >

                    </div>


                    {{--  gold  --}}
                    <div class="col-md-4">
                        <label for="gold" class="form-label">{{ __('models.gold') }}</label>
                        <input type="number" class="form-control" name="gold" value="{{ old('gold' , $setting->gold) }}" id="gold" >

                    </div>




                    <div class="col-md-12 col-12 mb-3">
                        <div class="d-flex col-md-12 flex-column mb-7 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required" style="font-weight:bold">
                                        {{ __('models.location') . ' ('.__('models.search_in_map').')' }}
                                    </span>

                                </label>
                                    <input type="text"  name="icon"  class="form-control form-control-solid" id="searchInput" value="{{ old('location' , $setting->location) }}" >

                        </div> <br>
                    </div>

                    <div class="col-md-12 col-12 mb-3">
                        <div class="d-flex col-12 flex-column mb-7 fv-row fv-plugins-icon-container" style="height:100vh">
                            <input type="hidden" name="location" class="form-control" id="location"  value="{{ old('location' , $setting->location) }}">
                            <input type="hidden" name="lat" class="form-control" id="lat"  value="{{ old('lat' , $setting->lat) }}">
                            <input type="hidden" name="lng" class="form-control" id="lng"  value="{{ old('lng' , $setting->lng) }}">
                            <div id="map" style="height: 100%;width: 100%;">
                        </div>
                    </div>


                    <br><br>




                    <div class="col-md-6 col-12 mb-3">
                        <label for="formFile" class="form-label">{{ __('models.img') }}</label>
                        <input class="form-control image" type="file" id="formFile"
                            name="logo" >

                        @error('img')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group prev">
                        <img src="{{ asset('storage/' . $setting->logo) }}" style="width: 100px" class="img-thumbnail preview-formFile" alt="">
                    </div>




                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('models.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
</div>



@endsection


@section('js')
@include('dashboard.backend.setting.mab')
<script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>

@endsection
