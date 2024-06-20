@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.update_profile') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.update_profile') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">{{ __('models.update_profile') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('saller.update-profile' , $saller->id) }}" enctype="multipart/form-data" novalidate>
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="id" id="id" value="{{ $saller->id }}">
                    <input type="hidden" name="admin_id" id="admin_id" value="{{ $saller->admin_id }}">

                    {{--  first_name  --}}
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">{{ __('models.first_name') }}</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name' , $saller->first_name) }}" id="first_name" aria-describedby="inputGroupPrepend"
                                required>
                            <div class="invalid-feedback">
                                Please choose a First Name
                            </div>
                        </div>
                    </div>

                    {{--  last_name  --}}
                    <div class="col-md-4">
                        <label for="last_name" class="form-label">{{ __('models.last_name') }}</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name' , $saller->last_name) }}" id="last_name" aria-describedby="inputGroupPrepend"
                                required>
                            <div class="invalid-feedback">
                                Please choose a Last Name
                            </div>
                        </div>
                    </div>

                    {{--  name  --}}
                    <div class="col-md-4">
                        <label for="name" class="form-label">{{ __('models.name') }}</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" class="form-control" name="name" value="{{ old('name' , $saller->name) }}" id="name" aria-describedby="inputGroupPrepend"
                                required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>



                    {{--  email  --}}
                    <div class="col-md-4">
                        <label for="email" class="form-label">{{ __('models.email') }}</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email' , $saller->email) }}" id="email"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror

                    </div>

                    {{--  password  --}}
                    <div class="col-md-4">
                        <label for="password" class="form-label">{{ __('models.password') }}</label>
                        <input type="password" class="form-control" name="password"  id="password"  >
                         <div class="valid-feedback">
                            Looks good!
                        </div>

                        @error('password')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                     {{--  phone  --}}
                     <div class="col-md-4">
                        <label for="phone" class="form-label">{{ __('models.phone') }}</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone' , $saller->phone) }}" id="phone"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('phone')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror

                    </div>


                    {{--  country_id  --}}
                    <div class="col-lg-6">
                        <label for="country_id" class="form-label">{{ __('models.countries') }}</label>

                        <select class="form-control js-example-basic-multiple" name="country_id" id="country_id">

                            <option value="{{ $saller->country_id }}" > {{ $saller->country->name }} </option>
                            <option value="" disabled> {{ __('models.countries') }} </option>
                            @foreach ( $countries->whereNotIn('id' , [$saller->country_id]) as $country )
                                <option value="{{ $country->id }}" {{ old('country_id') ==  $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    {{--  city_id  --}}
                    <div class="col-lg-6">
                        <label for="city_id" class="form-label">{{ __('models.cities') }}</label>

                        <select class="form-control js-example-basic-multiple" name="city_id"  id="city_id">
                            <option value="" disabled> {{ __('models.cities') }} </option>
                            <option value="{{ $saller->city_id }}" > {{ $saller->city->name }} </option>

                        </select>
                    </div>

                    {{--  region  --}}
                    <div class="col-md-6">
                        <label for="region" class="form-label">{{ __('models.region') }}</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" name="region" value="{{ old('region' , $saller->region) }}" id="region" aria-describedby="inputGroupPrepend"
                                required>

                        </div>
                    </div>

                    {{--  address  --}}
                    <div class="col-md-6">
                        <label for="address" class="form-label">{{ __('models.address') }}</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" name="address" value="{{ old('address' , $saller->address) }}" id="address" aria-describedby="inputGroupPrepend"
                                required>

                        </div>
                    </div>

                    {{--  address_2  --}}
                    <div class="col-md-6">
                        <label for="address_2" class="form-label">{{ __('models.address_2') }}</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" name="address_2" value="{{ old('address_2' , $saller->address_2) }}" id="address_2" aria-describedby="inputGroupPrepend"
                                required>

                        </div>
                    </div>

                    {{--  company  --}}
                    <div class="col-md-6">
                        <label for="company" class="form-label">{{ __('models.company') }}</label>
                        <div class="input-group has-validation">

                            <input type="text" class="form-control" name="company" value="{{ old('company' , $saller->company) }}" id="company"
                                required>

                        </div>
                    </div>

                    {{--  facebook  --}}
                    <div class="col-md-6">
                        <label for="facebook" class="form-label">{{ __('models.facebook') }}</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" name="facebook" value="{{ old('facebook' , $saller->facebook) }}" id="facebook">
                        </div>
                    </div>

                    {{--  instagram  --}}
                    <div class="col-md-6">
                        <label for="instagram" class="form-label">{{ __('models.instagram') }}</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" name="instagram" value="{{ old('instagram' , $saller->instagram) }}" id="instagram">
                        </div>
                    </div>

                    {{--  shopify  --}}
                    <div class="col-md-6">
                        <label for="shopify" class="form-label">{{ __('models.shopify') }}</label>
                        <div class="input-group has-validation">

                            <input type="text" class="form-control" name="shopify" value="{{ old('shopify' , $saller->shopify) }}" id="shopify"
                                >

                        </div>
                    </div>


                    <div class="col-md-6"> </div>


                    <div class="col-md-6 col-12 mb-3">
                        <label for="formFile" class="form-label">{{ __('models.img') }}</label>
                        <input class="form-control image" type="file" id="formFile"
                            name="img" >

                        @error('img')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group prev">
                        <img src="{{ asset('storage/' . $saller->img) }}" style="width: 100px" class="img-thumbnail preview-formFile" alt="">
                    </div>

                    <div class="col-md-6 col-12 mb-3">
                        <label for="formFile-logo" class="form-label">{{ __('models.logo') }}</label>
                        <input class="form-control image" type="file" id="formFile-logo"
                            name="logo" >

                        @error('logo')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group prev">
                        <img src="{{ asset('storage/' . $saller->logo) }}" style="width: 100px" class="img-thumbnail preview-formFile-logo" alt="">
                    </div>

                    <div class="col-md-6 col-12 mb-3">
                        <label for="formFile-passport" class="form-label">{{ __('models.passport') }}</label>
                        <input class="form-control image" type="file" id="formFile-passport"
                            name="passport" >

                        @error('passport')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group prev">
                        <img src="{{ asset('storage/'. $saller->passport) }}" style="width: 100px" class="img-thumbnail preview-formFile-passport" alt="">
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
<script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>
@include('dashboard.backend.cities.js')
@endsection
