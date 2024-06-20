

@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.static') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.static') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">{{ __('models.static') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.update-static') }}" enctype="multipart/form-data" novalidate>
                    @method('PUT')

                    @csrf



                    {{--  title_ar  --}}
                    <div class="col-md-6">
                        <label for="title_ar" class="form-label">{{ __('models.title_ar') }}</label>
                        <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar' , $static->title_ar) }}" id="title_ar"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    {{--  title_en  --}}
                    <div class="col-md-6">
                        <label for="title_en" class="form-label">{{ __('models.title_en') }}</label>
                        <input type="text" class="form-control" name="title_en" value="{{ old('title_en' , $static->title_en) }}" id="title_en"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>



                    {{--  desc_ar  --}}
                    <div class="col-md-6">
                        <label class="form-label" for="meta-description-input">Arabic Description</label>
                        <textarea class="form-control" name="desc_ar" id="meta-description-input" placeholder="Enter Product Arabic description" rows="3">{{ old('desc_ar' , $static->desc_ar) }}</textarea>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>


                     {{--  desc_en  --}}
                     <div class="col-md-6">
                        <label class="form-label" for="meta-description-input">English Description</label>
                        <textarea class="form-control" name="desc_en" id="meta-description-input" placeholder="Enter Product English description" rows="3">{{ old('desc_en' , $static->desc_en) }}</textarea>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>


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
                        <img src="{{ asset('storage/' . $static->img) }}" style="width: 100px" class="img-thumbnail preview-formFile" alt="">
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
