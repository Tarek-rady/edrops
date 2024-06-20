@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.payouts') }}
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
             <div class="card-header card-add-edit">
                <h4 class="card-title mb-0">{{ __('models.Add,edit') }}</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">


                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="payouts_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.payouts') }}</th>
                                    <th class="sort">{{ __('models.status') }}</th>
                                    <th class="sort">{{ __('models.method') }}</th>
                                    <th class="sort">{{ __('models.iban') }}</th>
                                    <th class="sort">{{ __('models.swift_code') }}</th>
                                    <th class="sort">{{ __('models.wallet_name') }}</th>
                                    <th class="sort">{{ __('models.wallet_no') }}</th>
                                    <th class="sort">{{ __('models.name') }}</th>
                                    <th class="sort">{{ __('models.phone') }}</th>
                                    <th class="sort">{{ __('models.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">


                            </tbody>
                        </table>






                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection

@section('js')
    <script>



        var table = $('#payouts_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('saller.get-payouts') }}",
        columns: [

            {
                data : 'amount' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,






            {
                data : 'status' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,

            {
                data : 'method' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,

            {
                data : 'iban' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,

            {
                data : 'swift_code' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,
            {
                data : 'wallet_name' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
                searchable: false,

            } ,
            {
                data : 'wallet_no' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,

            {
                data : 'english_name' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,

            {
                data : 'phone' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,


            {
                data : 'created_at' ,
                searchable: false,

            } ,







        ]
        });


    </script>
@endsection
