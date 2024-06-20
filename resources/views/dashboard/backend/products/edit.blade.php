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
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('models.products') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('models.edit_product') }}</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

{{--  id="ckeditor-classic"  --}}
<form  class="row g-3 needs-validation" method="POST" action="{{ route('admin.products.update' , $product->id) }}" enctype="multipart/form-data" novalidate>
    @method('PUT')
    @csrf
      @include('dashboard.backend.products._inputs')

</form>

@endsection


@section('js')
@include('dashboard.backend.stocks.js')
<script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/preview-multi-image.js') }}"></script>
@include('dashboard.backend.products.js')

@endsection
