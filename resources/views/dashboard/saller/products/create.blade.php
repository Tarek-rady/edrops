@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.add_product') }}
@endsection



@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('models.add_product') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('models.products') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('models.add_product') }}</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

{{--  id="ckeditor-classic"  --}}
<form  class="row g-3 needs-validation" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-12">

            {{-- cart name  --}}
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta-title-input">{{ __('models.name_ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar') }}" placeholder="Enter product Name Arabic" id="meta-title-input" required>
                            </div>
                            @error('name_ar')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta-keywords-input">{{ __('models.name_en') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" placeholder="Enter product Name English" id="meta-keywords-input" required>
                            </div>
                            @error('name_en')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>


                        <!-- end col -->
                    </div>
                </div>
            </div>
            {{--  end card  --}}


            {{-- cart select  --}}
            <div class="card">
                <div class="card-body">

                    <div class="row">


                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.categories') }}</label>
                            <select class="form-control js-example-basic-multiple" name="category_id"   id="category_id">
                                <option value="" disabled> {{ __('models.categories') }} </option>
                                @foreach ( $categories as $category )
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.brands') }}</label>
                            <select class="form-control js-example-basic-multiple" name="brand_id"   id="brand_id">
                                <option value="" > {{ __('models.brands') }} </option>
                                @foreach ( $brands as $brand )
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.countries') }}</label>
                            <select class="form-control js-example-basic-multiple" name="country_id"   id="country_id">
                                <option value="" > {{ __('models.countries') }} </option>
                                @foreach ( $countries as $country )
                                    <option value="{{ $country->id }}"{{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.ship_to') }}</label>
                            <select class="form-control js-example-basic-multiple" name="countries[]" id="countries" multiple>
                                <option value="" > {{ __('models.ship_to') }} </option>
                                @foreach ( $countries as $country )
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            {{--  end card  --}}



            {{--  card images  --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Product Gallery</h5>
                </div>
                <div class="card-body">
                     {{--  img  --}}
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

                {{--  images  --}}
                <div class="col-md-6 col-12 mb-3">
                    <label for="files" class="form-label">{{ __('models.images') }}</label>
                    <input class="form-control" type="file" id="files"
                        name="images[]" required multiple>

                    @error('images')
                        <span class="text-danger">
                            <small class="errorTxt">{{ $message }}</small>
                        </span>
                    @enderror
                </div>

                <div class="carousel-inner" style="display: flex;" ></div><br>


                </div>
            </div>
            {{--  end card  --}}



            {{-- card video  --}}
            <div class="card">
                <div class="card-body">

                    {{--  video  --}}
                    <div class="container pt-4">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h5>تحميل فيديو</h5>
                                    </div>

                                    <div class="card-body">
                                        <div id="upload-container" class="text-center">
                                            <a href="#" type="button" id="browseFile"
                                                class="btn btn-primary">ملفات الجهاز</a>
                                        </div>
                                        <div style="display: none" class="progress mt-3"
                                            style="height: 25px">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" aria-valuenow="10"
                                                aria-valuemin="0" aria-valuemax="25"
                                                style="width: 75%; height: 100%">75%</div>
                                        </div>
                                    </div>

                                    <div class="card-footer p-4" style="display: none">
                                        <video id="videoPreview" src="" controls
                                            style="width: 100%; height: auto"></video>
                                    </div>

                                </div>
                                <p>الصيغ المتاحة : mp4 - flv - m3u8 - ts - 3gp - mov - avi - wmv -
                                    mkv</p>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            {{--  end card  --}}

            {{--  card product details  --}}
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                {{ __('models.product_details') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#product-sizes" role="tab">
                                {{ __('models.rates') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#product-colors" role="tab">
                                {{ __('models.links') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"  href="#product-comment" role="tab">
                                {{ __('models.use_product') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"  href="#product-details" role="tab">
                                {{ __('models.desc') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"  href="#product-note" role="tab">
                                {{ __('models.note') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"  href="#product-populer" role="tab">
                                {{ __('models.populer') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"  href="#product-adv" role="tab">
                                {{ __('models.adv') }}
                            </a>

                        </li>


                        </li>
                    </ul>
                </div>
                <!-- end card header -->


                <div class="card-body">
                    <div class="tab-content">

                        {{--  product details  --}}
                        <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">


                            <div class="row">



                                {{--  cost  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-cost-input">{{__('models.cost')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text"></span>
                                            <input type="text" class="form-control" id="cost" value="{{ old('cost') }}" name="cost" placeholder="Enter cost" aria-label="cost" aria-describedby="product-cost-addon" required>
                                            <div class="invalid-feedback">Please Enter a product cost.</div>
                                        </div>

                                    </div>
                                </div>

                                {{--  price  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="price">{{__('models.price')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text"></span>
                                            <input type="text" class="form-control" id="price" value="{{ old('price') }}" name="price" placeholder="Enter price" aria-label="price" aria-describedby="product-price-addon" required>
                                            <div class="invalid-feedback">Please Enter a product price.</div>
                                        </div>

                                    </div>
                                </div>

                                 {{--  profit  --}}
                                 <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-profit-input">{{__('models.profit')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text"></span>
                                            <input type="number" class="form-control" id="profit" value="{{ old('profit') }}" name="profit" placeholder="Enter profit" aria-label="profit" aria-describedby="product-profit-addon" readonly>
                                            <div class="invalid-feedback">Please Enter a product profit.</div>
                                        </div>

                                    </div>
                                </div>

                                {{--  qty  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-qty-input">{{__('models.qty')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-qty-addon"></span>
                                            <input type="number" class="form-control" id="product-qty-input" value="{{ old('qty') }}" name="qty" placeholder="Enter qty" aria-label="qty" aria-describedby="product-qty-addon" required>
                                            <div class="invalid-feedback">Please Enter a product qty.</div>
                                        </div>

                                    </div>
                                </div>

                                 {{--  stock  --}}
                                 <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-stock-input">{{__('models.stock')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-stock-addon"></span>
                                            <input type="number" class="form-control" id="product-stock-input" value="{{ old('stock') }}" name="stock" placeholder="Enter stock" aria-label="stock" aria-describedby="product-stock-addon" required>
                                            <div class="invalid-feedback">Please Enter a product stock.</div>
                                        </div>

                                    </div>
                                </div>





                                {{--  discount  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-discount-input">Discount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="product-discount-addon">%</span>
                                            <input type="text" class="form-control" name="discount" id="product-discount-input" value="{{ old('discount') }}" placeholder="Enter discount" aria-label="discount" aria-describedby="product-discount-addon">
                                        </div>
                                    </div>

                                    @error('discount')
                                        <span class="text-danger">
                                            <small class="errorTxt">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- end row -->
                        </div>


                        {{--  product rates  --}}
                        <div class="tab-pane" id="product-sizes" role="tabpane2">

                            <div class="row">

                                {{--  ratio  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-ratio-input">{{__('models.ratio')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-ratio-addon"></span>
                                            <input type="text" class="form-control" id="product-ratio-input" value="{{ old('ratio') }}" name="ratio" placeholder="Enter ratio" aria-label="ratio" aria-describedby="product-ratio-addon" >
                                            <div class="invalid-feedback">Please Enter a product ratio.</div>
                                        </div>

                                    </div>
                                </div>

                                {{--  delivery  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-delivery-input">{{__('models.delivery')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-delivery-addon"></span>
                                            <input type="text" class="form-control" id="product-delivery-input" value="{{ old('delivery') }}" name="delivery" placeholder="Enter delivery" aria-label="delivery" aria-describedby="product-delivery-addon">
                                            <div class="invalid-feedback">Please Enter a product delivery.</div>
                                        </div>

                                    </div>
                                </div>

                                {{--  competition  --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-competition-input">{{__('models.competition')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-competition-addon"></span>
                                            <input type="number" class="form-control" id="product-competition-input" value="{{ old('competition') }}" name="competition" placeholder="Enter competition" aria-label="competition" aria-describedby="product-competition-addon" >
                                            <div class="invalid-feedback">Please Enter a product competition.</div>
                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>


                        {{--  product links  --}}
                        <div class="tab-pane" id="product-colors" role="tabpane3">


                            <div class="row">
                                {{--  youtube  --}}
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-danger shadow">
                                            <i class="ri-youtube-fill"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="youtube" value="{{ old('youtube') }}">
                                </div>

                                {{--  amazon  --}}
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-primary shadow">
                                            <i class="ri-amazon-fill"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="amazon" name="amazon" placeholder="amazon" value="{{ old('amazon') }}">
                                </div>


                            </div>



                        </div>


                        {{--  product use_product  --}}
                        <div class="tab-pane" id="product-comment" role="tabpane4">

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.use_product_ar') }}</label>
                                <textarea class="form-control summernote" name="use_product_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('use_product_ar') }}</textarea>
                                @error('use_product_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.use_product_en') }}</label>
                                <textarea class="form-control summernote" name="use_product_en" placeholder="Enter Product Arabic description" rows="3">{{ old('use_product_en') }}</textarea>
                                @error('use_product_en')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>


                        </div>

                        {{--  product desc  --}}
                        <div class="tab-pane" id="product-details" role="tabpane5">

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.desc_ar') }}</label>
                                <textarea class="form-control summernote" name="desc_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('desc_ar') }}</textarea>
                                @error('desc_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.desc_en') }}</label>
                                <textarea class="form-control summernote" name="desc_en" placeholder="Enter Product Arabic description" rows="3">{{ old('desc_en') }}</textarea>
                                @error('desc_en')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>


                        </div>

                        {{--  product note  --}}
                        <div class="tab-pane" id="product-note" role="tabpane6">

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.note_ar') }}</label>
                                <textarea class="form-control summernote" name="note_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('note_ar') }}</textarea>
                                @error('note_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.note_en') }}</label>
                                <textarea class="form-control summernote" name="note_en" placeholder="Enter Product Arabic description" rows="3">{{ old('note_en') }}</textarea>
                                @error('note_en')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>


                        </div>

                        {{--  product populer  --}}
                        <div class="tab-pane" id="product-populer" role="tabpane7">

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.populer_ar') }}</label>
                                <textarea class="form-control summernote" name="populer_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('populer_ar') }}</textarea>
                                @error('populer_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.populer_en') }}</label>
                                <textarea class="form-control summernote" name="populer_en" placeholder="Enter Product Arabic description" rows="3">{{ old('populer_en') }}</textarea>
                                @error('populer_en')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>


                        </div>

                        {{--  product adv  --}}
                        <div class="tab-pane" id="product-adv" role="tabpane8">

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.adv_ar') }}</label>
                                <textarea class="form-control summernote" name="adv_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('adv_ar') }}</textarea>
                                @error('adv_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.adv_en') }}</label>
                                <textarea class="form-control summernote" name="adv_en" placeholder="Enter Product Arabic description" rows="3">{{ old('adv_en') }}</textarea>
                                @error('adv_en')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>


                        </div>


                    </div>






                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </div>
                <!-- end card body -->
            </div>
            {{--  end card  --}}
            <div class="text-end mb-3">
                <button type="submit" class="btn btn-success w-sm">Submit</button>
            </div>
        </div>
        <!-- end col -->


        <!-- end col -->
    </div>
    <!-- end row -->

</form>

@endsection


@section('js')
<script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/preview-multi-image.js') }}"></script>
@include('dashboard.backend.products.js')

@endsection
