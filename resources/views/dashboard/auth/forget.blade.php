@extends('dashboard.auth.auth')


@section('title')
    اعاده تعيين كلمه السر
@endsection

@section('content')

<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-3 text-white-50">
                   
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary" style="color: #fe914a !important">Forgot Password?</h5>
                            <p class="text-muted">Reset password with velzon</p>

                            <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                            </lord-icon>

                        </div>

                        <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                            Enter your email and instructions will be sent to you!
                        </div>
                        <div class="p-2">
                            <form class="needs-validation" novalidate action="{{ route('reset-password') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                                </div>

                                <div class="text-center mt-4">
                                    <button class="btn btn-success w-100" type="submit">{{ __('models.save') }}</button>
                                </div>
                            </form><!-- end form -->
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


@endsection
