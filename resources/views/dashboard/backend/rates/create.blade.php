@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.add_rate') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.add_rate') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rates.index') }}">{{ __('models.rates') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.add_rate') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.rates.store') }}" enctype="multipart/form-data" novalidate>

                    @csrf



                    {{--  user_name  --}}
                    <div class="col-md-6">
                        <label for="user_name" class="form-label">{{ __('models.user_name') }}</label>
                        <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" id="user_name"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('user_name')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>


                    {{--  rate  --}}
                    <div class="col-md-6">
                        <label for="rate" class="form-label">{{ __('models.rate') }}</label>
                        <input type="number" class="form-control" name="rate" value="{{ old('rate') }}" id="rate" min="1" max="5" required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('rate')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    {{--  country_id  --}}
                    <div class="col-lg-6">
                        <select class="form-control js-example-basic-multiple" name="country_id"   id="country_id">
                            <option value="" disabled> {{ __('models.countries') }} </option>
                            @foreach ( $countries as $country )
                                <option value="{{ $country->id }}" {{ old('country_id') ==  $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6"></div>


                      {{--  msg --}}
                      <div class="col-md-6 col-12 mb-3">
                        <label for="msg">{{ __('models.msg') }}</label>
                        <textarea class="form-control editor" cols="70" rows="20"  name="msg" >{{ old('msg') }}</textarea>

                        @error('msg')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror

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

@endsection
