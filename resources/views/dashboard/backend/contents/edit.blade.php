@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.edit_content') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.edit_content') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.contents.index') }}">{{ __('models.contents') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.edit_content') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.contents.update' , $content->id) }}" enctype="multipart/form-data" novalidate>

                    @method('PUT')
                    @csrf


                    {{--  name_ar  --}}
                    <div class="col-md-6">
                        <label for="name_ar" class="form-label">{{ __('models.name_ar') }}</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar' , $content->name_ar) }}" id="name_ar"  required>
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
                        <input type="text" class="form-control" name="name_en" value="{{ old('name_en' , $content->name_en) }}" id="name_en"  required>
                         <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('name_en')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    {{--  desc ar --}}
                    <div class="col-md-6 col-12 mb-3">
                        <label for="desc_ar">{{ __('models.desc_ar') }}</label>
                        <textarea class="form-control editor"  cols="70" rows="20" name="desc_ar" >{{ old('desc_ar' ,  $content->desc_ar) }}</textarea>

                        @error('desc_ar')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror

                    </div>

                    {{--  desc_en --}}
                    <div class="col-md-6 col-12 mb-3">
                        <label for="desc_en">{{ __('models.desc_en') }}</label>
                        <textarea class="form-control editor" cols="70" rows="20"  name="desc_en" >{{ old('desc_en' ,  $content->desc_en) }}</textarea>

                        @error('desc_en')
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
