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

                        <div class="controls d-flex">

                            <div class="custom-controls m-1" style="background-color: #eee; padding: 5px; border-radius: 4px;">

                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="all" />
                                    <label class="" for="">{{ __('models.all') }}</label>
                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" data-index="1" class="custom-control fliter_datatable" name="fliter_datatable" value="waiting" />
                                    <label class="" for="">{{ __('models.waiting') }}</label>
                                </div>


                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="accept" />
                                    <label class="" for="">{{ __('models.accept') }}</label>

                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="rejection" />
                                    <label class="" for=""> {{ __('models.rejection') }}</label>
                                </div>



                            </div>








                        </div>

                        <div class="col-xxl-2 col-sm-4">
                            <div>
                                <select class="form-control js-example-basic-multiple"   id="saller_id">
                                    <option value="" selected>{{ __('models.sallers') }}</option>
                                    @foreach ( $sallers as $saller )
                                        <option value="{{ $saller->id }}">{{ $saller->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="payouts_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.payouts') }}</th>
                                    <th class="sort">{{ __('models.sallers') }}</th>
                                    <th class="sort">{{ __('models.status') }}</th>
                                    <th class="sort">{{ __('models.method') }}</th>
                                    <th class="sort">{{ __('models.iban') }}</th>
                                    <th class="sort">{{ __('models.swift_code') }}</th>
                                    <th class="sort">{{ __('models.wallet_name') }}</th>
                                    <th class="sort">{{ __('models.wallet_no') }}</th>
                                    <th class="sort">{{ __('models.name') }}</th>
                                    <th class="sort">{{ __('models.phone') }}</th>
                                    <th class="sort">{{ __('models.created_at') }}</th>
                                    <th class="sort" >{{ __('models.action') }}</th>
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
        ajax: "{{ route('admin.get-payouts') }}",
        columns: [

            {
                data : 'amount' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,



            {
                data : 'saller' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,


            {
                data: 'status',
                render: function (data, type, full, meta) {
                    if (data == 'waiting') {
                        return '<span class="badge bg-warning">' + data + '</span>';
                    } else if (data == 'accept') {
                        return '<span class="badge bg-success">' + data + '</span>';
                    } else {
                        return '<span class="badge bg-danger">' + data + '</span>';
                    }
                }
            },

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

            {
                data : 'action' ,
                searchable: false,
            } ,






        ]
        });

        $('#saller_id').change(function(){
            table.column(1).search($(this).val()).draw();
        });

        $('.fliter_datatable').on('change', function(e) {
            console.log($(this).val());
            if ($(this).val() == 'all') {
                table.search('').columns().search('').draw();

            } else if ($(this).val() == 'waiting') {
                    table.search('').columns(2).search('waiting').draw();
            } else if ($(this).val() == 'accept') {
                table.search('').columns(2).search('accept').draw();
            } else if ($(this).val() == 'rejection') {
                table.search('').columns(2).search('rejection').draw();
            }
        });




    </script>
@endsection
