@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.add_category') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.add_category') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('models.categories') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.add_category') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" novalidate>

                    @csrf



                    {{--  name_ar  --}}
                    <div class="col-md-6">
                        <label for="name_ar" class="form-label">{{ __('models.name_ar') }}</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}" id="name_ar"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('name_ar')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>


                    {{--  name_en  --}}
                    <div class="col-md-6">
                        <label for="name_en" class="form-label">{{ __('models.name_en') }}</label>
                        <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" id="name_en"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('name_en')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>





                    <div class="col-md-6 col-12 mb-3">
                        <label for="formFile" class="form-label">{{ __('models.img') }}</label>
                        <input class="form-control image" type="file" id="formFile"
                            name="img" required>

                        @error('img')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group prev">
                        <img src="" style="width: 100px" class="img-thumbnail preview-formFile" alt="">
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
