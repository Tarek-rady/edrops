@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.add_saller') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.add_saller') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.sallers.index') }}">{{ __('models.sallers') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.add_saller') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.sallers.store') }}" enctype="multipart/form-data" novalidate>

                    @csrf

                    @php
                        $saller = '' ;
                    @endphp

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
