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
                            <li class="breadcrumb-item"><a href="#">{{ __('models.users') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.update_profile') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('user.update-profile' , $user->id) }}" enctype="multipart/form-data" novalidate>

                    @method('PUT')
                    @csrf

                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                    {{--  name  --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">{{ __('models.name') }}</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" class="form-control" name="name" value="{{ old('name' , $user->name) }}" id="name" aria-describedby="inputGroupPrepend"
                                required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>

                    {{--  email  --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label">{{ __('models.email') }}</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email' , $user->email) }}" id="email"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    {{--  phone  --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label">{{ __('models.phone') }}</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone' , $user->phone) }}" id="phone"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('phone')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror

                    </div>

                    {{--  password  --}}
                    <div class="col-md-6">
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


                     {{--  country_id  --}}
                     <div class="col-lg-6">
                        <label for="country_id" class="form-label">{{ __('models.countries') }}</label>

                        <select class="form-control js-example-basic-multiple" name="country_id" id="country_id">
                            <option value="{{ $user->country_id }}" > {{ $user->country->name }} </option>
                            <option value="" disabled> {{ __('models.countries') }} </option>
                            @foreach ( $countries->whereNotIn('id' , [$user->country_id]) as $country )
                                <option value="{{ $country->id }}" {{ old('country_id') ==  $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    {{--  city_id  --}}
                    <div class="col-lg-6">
                        <label for="city_id" class="form-label">{{ __('models.cities') }}</label>

                        <select class="form-control js-example-basic-multiple" name="city_id"  id="city_id">
                            <option value="{{ $user->city_id }}" > {{ $user->city->name }} </option>

                            <option value="" disabled> {{ __('models.cities') }} </option>

                        </select>
                    </div>

                    {{--  company  --}}
                    <div class="col-md-6">
                        <label for="company" class="form-label">{{ __('models.company') }}</label>
                        <div class="input-group has-validation">

                            <input type="text" class="form-control" name="company" value="{{ old('company' , $user->company) }}" id="company"
                                required>

                        </div>
                    </div>





                    <div class="col-md-6"></div>






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
                        <img src="{{ asset('storage/' . $user->img) }}" style="width: 100px" class="img-thumbnail preview-formFile" alt="">
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
