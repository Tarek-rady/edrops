@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.edit_product') }}
@endsection



@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('models.edit_product') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.products.index') }}">{{ __('models.products') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('models.edit_product') }}</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

{{--  id="ckeditor-classic"  --}}
<form  class="row g-3 needs-validation" method="POST" action="{{ route('user.products.update' , $product->id) }}" enctype="multipart/form-data" novalidate>
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-lg-12">


            <input type="hidden" name="id" id="id" value="{{ $product->id }}">

            {{-- cart name  --}}
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta-title-input">{{ __('models.name_ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar' , $product->name_ar) }}" placeholder="Enter product Name Arabic" id="meta-title-input" required>
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
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en' , $product->name_en) }}" placeholder="Enter product Name English" id="meta-keywords-input" required>
                            </div>
                            @error('name_en')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>


                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta-keywords-input">{{ __('models.sku') }}</label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku' , $product->sku) }}" placeholder="Enter product Name English" id="meta-keywords-input" required>
                            </div>
                            @error('sku')
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

                                <option value="{{ $product->category_id }}" > {{ $product->category->name }} </option>
                                <option value="" disabled> {{ __('models.categories') }} </option>
                                @foreach ( $categories->whereNotIn('id' , [$product->category_id]) as $category )
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>


                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.brands') }}</label>
                            <select class="form-control js-example-basic-multiple" name="brand_id"   id="brand_id">

                                @if (isset($product->brand))
                                    <option value="{{ $product->brand_id }}" > {{ $product->brand->name }} </option>
                                @endif
                                <option value="" > {{ __('models.brands') }} </option>
                                @foreach ( $brands->whereNotIn('id' , [$product->brand_id]) as $brand )
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.countries') }}</label>
                            <select class="form-control js-example-basic-multiple" name="country_id"   id="country_id">
                                <option value="{{ $product->country_id }}" > {{ $product->country->name }} </option>
                                <option value="" > {{ __('models.countries') }} </option>
                                @foreach ( $countries->whereNotIn('id' , [$product->country_id]) as $country )
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @error('country_id')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.stocks') }}</label>
                            <select class="form-control js-example-basic-multiple" name="stock_id"   id="stock_id">
                                <option value="{{ $product->stock_id }}" > {{ $product->store->name }} </option>
                               
                            </select>

                            @error('stock_id')
                                <span class="text-danger">
                                    <small class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>








                        <div class="col-lg-6">
                            <label class="form-label" for="meta-keywords-input">{{ __('models.sallers') }}</label>
                            <select class="form-control js-example-basic-multiple" name="sallers[]" id="sallers" multiple>
                                <option value="" > {{ __('models.sallers') }} </option>
                                @if ($product->type == 'public')
                                    @foreach ( $sallers as $saller )
                                        <option value="{{ $saller->id }}">{{ $saller->name }}</option>
                                    @endforeach
                                @else

                                @foreach ( $sallers as $saller )
                                    <option value="{{ $saller->id }}" @foreach ($product->view_sallers as $product_saller)
                                        {{ $product_saller->saller_id == $saller->id ? 'selected' : ''  }}
                                    @endforeach >{{ $saller->name }}</option>
                                @endforeach

                                @endif
                            </select>
                        </div>
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
                            name="img" >

                        @error('img')
                            <span class="text-danger">
                                <small class="errorTxt">{{ $message }}</small>
                            </span>
                        @enderror
                </div>

                <div class="form-group prev">
                    <img src="{{ asset('storage/' . $product->img) }}" style="width: 100px" class="img-thumbnail preview-formFile" alt="">
                </div>

                {{--  images  --}}
                <div class="col-md-6 col-12 mb-3">
                    <label for="files" class="form-label">{{ __('models.images') }}</label>
                    <input class="form-control" type="file" id="files"
                        name="images[]"  multiple>

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
                                {{ __('models.sizes') }}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#product-colors" role="tab">
                                {{ __('models.colors') }}
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



                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"  href="#product-links" role="tab">
                                {{ __('models.links') }}
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



                                {{--  cost_user  --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-cost_user-input">{{__('models.cost_user')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text"></span>
                                            <input type="text" class="form-control" id="cost_user" value="{{ old('cost_user' , $product->cost_user) }}" name="cost_user" placeholder="Enter Product Cost" aria-label="cost_user" aria-describedby="product-cost_user-addon" required>
                                        </div>

                                    </div>

                                    @error('cost_user')
                                        <span class="text-danger">
                                            <small class="errorTxt">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>



                                {{--  qty  --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-qty-input">{{__('models.qty')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-qty-addon"></span>
                                            <input type="number" class="form-control" id="product-qty-input" value="{{ old('qty' , $product->qty) }}" name="qty" placeholder="Enter qty" aria-label="qty" aria-describedby="product-qty-addon" required>
                                            <div class="invalid-feedback">Please Enter a product qty.</div>
                                        </div>

                                    </div>

                                    @error('qty')
                                        <span class="text-danger">
                                            <small class="errorTxt">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>

                                {{--  stock  --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-stock-input">{{__('models.stock')}}</label>
                                        <div class="input-group has-validation mb-3">
                                            <span class="input-group-text" id="product-stock-addon"></span>
                                            <input type="number" class="form-control" id="product-stock-input" value="{{ old('stock' , $product->stock) }}" name="stock" placeholder="Enter stock" aria-label="stock" aria-describedby="product-stock-addon" required>
                                            <div class="invalid-feedback">Please Enter a product stock.</div>
                                        </div>

                                    </div>
                                    @error('stock')
                                        <span class="text-danger">
                                            <small class="errorTxt">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>



                                {{--  discount  --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-discount-input">Discount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="product-discount-addon">%</span>
                                            <input type="text" class="form-control" name="discount" id="product-discount-input" value="{{ old('discount' , $product->discount ) }}" placeholder="Enter discount" aria-label="discount" aria-describedby="product-discount-addon">
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


                        {{--  product sizes  --}}
                        <div class="tab-pane" id="product-sizes" role="tabpane2">
                            <div class="d-grid gap-2" >
                                <a href="" class="btn btn-danger waves-effect waves-light btn-block add-input-value-size">Add Size</a><br>
                            </div>
                            <div class="row">

                                @if (isset($product->sizes))
                                  @foreach ( $product->sizes as $size)

                                    <div class="delete-row col-lg-12 row">



                                            <div class="col-md-4 col-12 mb-3">

                                                <div class="sub-main-value-size">
                                                    <label class="form-label" for="size_ar">{{ __('models.name_ar') }}</label>
                                                    <input type="text" class="form-control" placeholder="Enter Size Name Arabic" name="size_ar[]" id="size_ar" value="{{ $size->size_ar }}">

                                                </div>


                                            </div>


                                            <div class="col-md-4 col-12 mb-3">

                                                <div class="sub-main-price">
                                                    <label class="form-label" for="size_en">{{ __('models.name_en') }}</label>
                                                    <input type="text" class="form-control" placeholder="Enter Size Name English" name="size_en[]" id="size_en" value="{{ $size->size_en }}">
                                                </div>

                                            </div>

                                            <div class="col-md-2 col-12 mb-3">

                                                <div class="sub-main-price">
                                                    <label class="form-label" for="code">{{ __('models.code') }}</label>
                                                    <input type="text" class="form-control" placeholder="Enter Code" name="code_size[]" id="code" value="{{ $size->code_size }}">
                                                </div>

                                            </div>

                                            <div class="col-md-2 col-12 mb-3 mt-4">

                                                <div>
                                                    <button class="btn btn-danger delelte-item-size"><i class="mdi mdi-trash-can-outline"></i><button>
                                                </div>
                                            </div>
                                    </div>

                                  @endforeach

                                @endif


                                <div class="col-lg-12 row main-value-size" style="padding: 0">
                                </div>
                            </div>
                            <!-- end row -->


                        </div>


                        {{--  product colors  --}}
                        <div class="tab-pane" id="product-colors" role="tabpane3">


                            <div class="d-grid gap-2" >
                                <a href="" class="btn btn-primary waves-effect waves-light btn-block add-input-value-color">Add Color</a><br>
                            </div>

                            <div class="row">

                                @if (isset($product->colors))
                                   @foreach ($product->colors as $color)

                                   <div class="delete-row col-lg-12 row">

                                        <div class="col-md-4 col-12 mb-3">

                                            <div class="sub-main-value-color">
                                                <label class="form-label" for="color_ar">{{ __('models.name_ar') }}</label>
                                                <input type="text" class="form-control" placeholder="Enter Color Name Arabic" name="color_ar[]" id="color_ar" value="{{ $color->color_ar }}">

                                            </div>


                                        </div>


                                        <div class="col-md-4 col-12 mb-3">

                                            <div class="sub-main-price">
                                                <label class="form-label" for="color_en">{{ __('models.name_en') }}</label>
                                                <input type="text" class="form-control" placeholder="Enter Color Name English" name="color_en[]" id="color_en" value="{{ $color->color_en }}">
                                            </div>


                                        </div>

                                        <div class="col-md-2 col-12 mb-3">

                                            <div class="sub-main-price">
                                                <label class="form-label" for="code">{{ __('models.code') }}</label>
                                                <input type="text" class="form-control" placeholder="Enter Code" name="code_color[]" id="code" value="{{ $color->code_color }}">
                                            </div>

                                        </div>

                                        <div class="col-md-2 col-12 mb-3 mt-4">

                                            <div>

                                                <button class="btn btn-danger delelte-item-color"><i class="mdi mdi-trash-can-outline"></i><button>
                                            </div>


                                        </div>




                                    </div>

                                   @endforeach
                                @endif




                                <div class="col-lg-12 row main-value-color" style="padding: 0">
                                </div>
                            </div>
                            <!-- end row -->


                        </div>


                        {{--  product use_product  --}}
                        <div class="tab-pane" id="product-comment" role="tabpane4">

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.use_product_ar') }}</label>
                                <textarea class="form-control summernote" name="use_product_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('use_product_ar'  , $product->use_product_ar) }}</textarea>
                                @error('use_product_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.use_product_en') }}</label>
                                <textarea class="form-control summernote" name="use_product_en" placeholder="Enter Product Arabic description" rows="3">{{ old('use_product_en'  , $product->use_product_en) }}</textarea>
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
                                <textarea class="form-control summernote" name="desc_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('desc_ar'  , $product->desc_ar) }}</textarea>
                                @error('desc_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.desc_en') }}</label>
                                <textarea class="form-control summernote" name="desc_en" placeholder="Enter Product Arabic description" rows="3">{{ old('desc_en'  , $product->desc_en) }}</textarea>
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
                                <textarea class="form-control summernote" name="note_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('note_ar'  , $product->note_ar) }}</textarea>
                                @error('note_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.note_en') }}</label>
                                <textarea class="form-control summernote" name="note_en" placeholder="Enter Product Arabic description" rows="3">{{ old('note_en'  , $product->note_en) }}</textarea>
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
                                <textarea class="form-control summernote" name="populer_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('populer_ar'  , $product->populer_ar) }}</textarea>
                                @error('populer_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.populer_en') }}</label>
                                <textarea class="form-control summernote" name="populer_en" placeholder="Enter Product Arabic description" rows="3">{{ old('populer_en'  , $product->populer_en) }}</textarea>
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
                                <textarea class="form-control summernote" name="adv_ar" placeholder="Enter Product Arabic description" rows="3">{{ old('adv_ar'  , $product->adv_ar) }}</textarea>
                                @error('adv_ar')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="meta-description-input">{{ __('models.adv_en') }}</label>
                                <textarea class="form-control summernote" name="adv_en" placeholder="Enter Product Arabic description" rows="3">{{ old('adv_en'  , $product->adv_en) }}</textarea>
                                @error('adv_en')
                                    <span class="text-danger">
                                        <small class="errorTxt">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>


                        </div>



                        {{--  product links  --}}
                        <div class="tab-pane" id="product-links" role="tabpane10">


                            <div class="row">
                                {{--  youtube  --}}
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-danger shadow">
                                            <i class="ri-youtube-fill"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="youtube" value="{{ old('youtube' , $product->youtube) }}">
                                </div>

                                {{--  amazon  --}}
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-primary shadow">
                                            <i class="ri-amazon-fill"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="amazon" name="amazon" placeholder="amazon" value="{{ old('amazon' , $product->amazon) }}">
                                </div>


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
@include('dashboard.user.products.js')

@endsection
