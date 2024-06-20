@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.edit_saller') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.edit_saller') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.sallers.index') }}">{{ __('models.sallers') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.edit_saller') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.sallers.update' , $saller->id) }}" enctype="multipart/form-data" novalidate>
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="id" id="id" value="{{ $saller->id }}">
                    <input type="hidden" name="admin_id" id="admin_id" value="{{ $saller->admin_id }}">
                    @include('dashboard.backend.sallers._inputs')

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
@include('dashboard.backend.cities.js')
@endsection
