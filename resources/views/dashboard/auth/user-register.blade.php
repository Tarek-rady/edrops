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

            <div class="row justify-content-center card-register" style="direction: rtl">
                <div class="col-md-6 col-12">
                    <img src="{{ asset('img/login-user.png') }}" alt="">
               </div>
                <div class="col-md-6 col-12">
                    <div class="card  card-boxShadow mt-4"
                       >

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h3 class="login-head">Create New Account</h3>

                                <p class="text-muted">Get your free velzon account now</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="needs-validation" novalidate action="{{ route('user.register') }}"
                                    method="POST">
                                    @csrf






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
                                                required>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>



                                    {{--  email  --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('models.email') }}</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" id="email" required>
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
                                        <input type="password" class="form-control" name="password" id="password" required>
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
                                            value="{{ old('phone') }}" id="phone" required>
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





                                    {{--  company  --}}
                                    <div class="mb-3">
                                        <label for="company" class="form-label">{{ __('models.company') }}</label>
                                        <div class="input-group has-validation">

                                            <input type="text" class="form-control" name="company"
                                                value="{{ old('company') }}" id="company" required>

                                        </div>
                                    </div>




                                    <div class="mt-4">
                                        <button class="btn btn-success w-100 btn-login" type="submit">{{ __('models.save') }}</button>
                                    </div>

                                    <div class="mt-4 text-center">

                                    </div>
                                </form>
                                <div class="mt-1 text-center">
                                    <p class="mb-0 py-2">Already have an account ? <a href="{{ route('user.login') }}"
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
