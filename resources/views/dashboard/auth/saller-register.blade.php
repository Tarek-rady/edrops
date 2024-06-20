@extends('dashboard.auth.auth')


@section('title')
   تسجيل الحساب
@endsection

@section('content')
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">

            </div>
            <!-- end row -->
            {{--  <img src="{{ asset('img/login-user.png') }}" alt="" height="20">  --}}

            <div class="row justify-content-center card-register" style="direction: rtl">
                <div class="col-md-6 col-12">
                    <img src="{{ asset('img/login-user.png') }}" alt="">
               </div>
                <div class="col-md-6 col-12">
                    <div class="card card-boxShadow mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h3 class="login-head">Create New Account</h3>

                                <p class="text-muted">Get your free EDROPS account now</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="needs-validation" action="{{ route('saller.register') }}"
                                    method="POST">
                                    @csrf


                                    <div class="row ">
                                        <div class="col-lg-6 col-12">
                                            {{--  first_name  --}}
                                            <div class="mb-3">
                                                <label for="first_name"
                                                    class="form-label">{{ __('models.first_name') }}</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" name="first_name"
                                                        value="{{ old('first_name') }}" id="first_name"
                                                        aria-describedby="inputGroupPrepend" placeholder="ادخل الاسم الاول"
                                                        >
                                                    <div class="invalid-feedback">
                                                        Please choose a First Name
                                                    </div>
                                                </div>
                                                @error('first_name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            {{--  last_name  --}}
                                            <div class="mb-3">
                                                <label for="last_name"
                                                    class="form-label d-block text-end">{{ __('models.last_name') }}</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" name="last_name"
                                                        value="{{ old('last_name') }}" id="last_name"
                                                        aria-describedby="inputGroupPrepend" placeholder="ادخل الاسم الاخير"
                                                        >
                                                    <div class="invalid-feedback">
                                                        Please choose a Last Name
                                                    </div>
                                                </div>
                                                @error('last_name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{--  name  --}}
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('models.name') }}</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend"
                                                style="border-top-left-radius: 0;
                                            border-bottom-left-radius: 0;
                                            border-top-right-radius: 0.25rem;
                                            border-bottom-right-radius: 0.25rem;
                                            border-left-width:0px">@</span>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}" id="name"
                                                aria-describedby="inputGroupPrepend" placeholder="ادخل اسم المستخدم"
                                                >
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>



                                    {{--  email  --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('models.email') }}</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" id="email" >
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
                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('models.password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password" >
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
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">{{ __('models.phone') }}</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" id="phone" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        @error('phone')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            {{--  country_id  --}}
                                            <div class="mb-3">
                                                <label for="country_id"
                                                    class="form-label">{{ __('models.countries') }}</label>

                                                <select class="form-control js-example-basic-multiple" name="country_id"
                                                    id="country_id" onchange="handleCountryChange(this)" >
                                                    <option value=""> {{ __('models.countries') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            {{--  city_id  --}}
                                            <div class="mb-3">
                                                <label for="city_id"
                                                    class="form-label">{{ __('models.cities') }}</label>

                                                <select class="form-control js-example-basic-multiple" name="city_id"
                                                    id="city_id" >
                                                    <option value=""> {{ __('models.cities') }} </option>

                                                </select>
                                                @error('city_id')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    {{--  region  --}}
                                    <div class="mb-3">
                                        <label for="region" class="form-label">{{ __('models.region') }}</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" name="region"
                                                value="{{ old('region') }}" id="region"
                                                aria-describedby="inputGroupPrepend" >
                                        </div>
                                        @error('region')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  address  --}}
                                    <div class="mb-3">
                                        <label for="address" class="form-label">{{ __('models.address') }}</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address') }}" id="address"
                                                aria-describedby="inputGroupPrepend" >
                                        </div>
                                        @error('address')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  address_2  --}}
                                    <div class="mb-3">
                                        <label for="address_2" class="form-label">{{ __('models.address_2') }}</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" name="address_2"
                                                value="{{ old('address_2') }}" id="address_2"
                                                aria-describedby="inputGroupPrepend" >
                                        </div>

                                        @error('address_2')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  company  --}}
                                    <div class="mb-3">
                                        <label for="company" class="form-label">{{ __('models.company') }}</label>
                                        <div class="input-group has-validation">

                                            <input type="text" class="form-control" name="company"
                                                value="{{ old('company') }}" id="company" >
                                        </div>
                                        @error('company')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  facebook  --}}
                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">{{ __('models.facebook') }}</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" name="facebook"
                                                value="{{ old('facebook') }}" id="facebook">
                                        </div>
                                        @error('facebook')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  instagram  --}}
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">{{ __('models.instagram') }}</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" name="instagram"
                                                value="{{ old('instagram') }}" id="instagram">
                                        </div>
                                        @error('instagram')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  shopify  --}}
                                    <div class="mb-3">
                                        <label for="shopify" class="form-label">{{ __('models.shopify') }}</label>
                                        <div class="input-group has-validation">

                                            <input type="text" class="form-control" name="shopify"
                                                value="{{ old('shopify') }}" id="shopify">

                                        </div>
                                        @error('shopify')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="formFile-passport" class="form-label">{{ __('models.passport') }}</label>
                                        <input class="form-control image" type="file" id="formFile-passport"
                                            name="passport" required>

                                        @error('passport')
                                            <span class="text-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group prev">
                                        <img src="" style="width: 100px" class="img-thumbnail preview-formFile-passport" alt="">
                                    </div>



                                    <div class="mt-4">
                                        <button class="btn btn-success w-100 btn-login" type="submit">Register</button>
                                    </div>

                                    <div class="mt-4 text-center">

                                    </div>
                                </form>
                                <div class="mt-2 text-center">
                                    <p class="mb-0 py-1">Already have an account ? <a href="{{ route('saller.login') }}"
                                            class="fw-semibold text-primary text-decoration-underline" style="color: #fe914a !important"> Signin </a> </p>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->



                </div>

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
@endsection
@section('js')
<script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>

    <script>
        function handleCountryChange(countrySelect) {
            var countryId = countrySelect.value;
            var citySelect = document.querySelector('select[name="city_id"]');

            var url = "{{ route('saller.country_cities', ":id") }}";
            url = url.replace(':id', countryId);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    citySelect.innerHTML = '<option value="">أختر المدينة</option>';
                    for (var key in data) {
                        citySelect.innerHTML += '<option value="' + key + '">' + data[key] + '</option>';
                    }
                },
                error: function(xhr, status, error) {
                }
            });

        }
    </script>
@endsection
