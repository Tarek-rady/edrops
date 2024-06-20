@extends('dashboard.auth.auth')


@section('title')
    Login
@endsection

@section('content')


    <div class="auth-page-content">
        <div class="container">

            <!-- end row -->

            <div class="login">
                <div class="row my-4">
                    <div class="col-6">
                        <div class="card">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">

                                    <div class="logo">
                                        <img src="{{ asset('img/logo2.jpeg') }}" style="width: 200px" alt="">
                                    </div>
                                    <p class="text-muted">تسجيل دخول المشرفين</p>

                                </div>
                                <div class="p-2 mt-5">
                                    <form class="needs-validation" novalidate action="{{ route('admin.login.post') }}"
                                        method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="useremail" name="email"
                                                placeholder="Enter email address" required>
                                            <div class="invalid-feedback">
                                                Please enter email
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    name="password" onpaste="return false" placeholder="Enter password"
                                                    id="password-input" aria-describedby="passwordInput" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                <div class="invalid-feedback">
                                                    Please enter password
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                        </div>



                                        <div class="mt-4">
                                            <button class="btn btn-success w-100 submit" type="submit">Login</button>
                                        </div>

                                        <div class="mt-4 text-center">

                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <div class="col-6">
                        <img src="{{ asset('img/login.png') }}" class="w-100" alt="">
                    </div>
                </div>
            </div>


            <!-- end card -->



            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

@endsection
