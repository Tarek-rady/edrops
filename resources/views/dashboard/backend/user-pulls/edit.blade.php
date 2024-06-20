@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.pulls') }}
@endsection


@section('content')


<div class="col-xxl-12">
    <div class="card">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('models.pulls') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.user-pulls') }}">{{ __('models.pulls') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('models.pulls') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card-body">
            <div class="live-preview">

                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.post-user-pulls') }}" enctype="multipart/form-data" novalidate>

                    @csrf


                    <input type="hidden" name="user_id" id="{{ $user->id }}" value="{{ $user->id }}">

                    @php
                        $user_amount = $user->amount  ;
                        $user_pull = $payout->amount ;
                        $total = $user_amount - $user_pull;
                    @endphp


                    {{--  total_amount  --}}
                    <div class="col-md-12">
                        <label for="name_ar" class="form-label">{{ __('models.total_amount') }}</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{ $user->amount }}" id="total_amount"  readonly>

                    </div>


                    {{--  saller_amount  --}}
                    <div class="col-md-4">
                        <label for="name_ar" class="form-label">{{ __('models.saller_amount') }}</label>
                        <input type="text" class="form-control" id="saller_amount" name="saller_amount" value="{{ $user->amount }}" id="saller_amount"  readonly>

                    </div>



                    {{--  pull  --}}
                    <div class="col-md-4">
                        <label for="name_ar" class="form-label">{{ __('models.pull') }}</label>
                        <input type="text" class="form-control" id="pull" name="pull" value="{{ $user_pull }}" id="pull"  readonly>

                    </div>





                    {{--  amount  --}}
                    <div class="col-md-4">
                        <label for="name_ar" class="form-label">{{ __('models.amount') }}</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ $total }}" id="amount"  readonly>

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



@endsection



