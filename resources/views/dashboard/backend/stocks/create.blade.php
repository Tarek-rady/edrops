@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.add_stock') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.add_stock') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.stocks.index') }}">{{ __('models.stocks') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.add_stock') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.stocks.store') }}" enctype="multipart/form-data" novalidate>

                    @csrf


                    @php
                        $stock = '' ;
                    @endphp

                   @include('dashboard.backend.stocks._inputs')




















                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('models.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
</div>



@endsection


@section('js')
@include('dashboard.backend.cities.js')

@endsection
