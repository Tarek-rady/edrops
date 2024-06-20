@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.orders') }}
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">{{ __('models.orders') }}</h4>
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
                                    <input type="radio" data-index="1" class="custom-control fliter_datatable" name="fliter_datatable" value="request" />
                                    <label class="" for="">{{ __('models.request') }}</label>
                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="progress" />
                                    <label class="" for="">{{ __('models.progress') }}</label>

                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="processing" />
                                    <label class="" for=""> {{ __('models.processing') }}</label>
                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="Done" />
                                    <label class="" for=""> {{ __('models.Done') }}</label>
                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="Delivery" />
                                    <label class="" for=""> {{ __('models.Delivery') }}</label>
                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="Complete" />
                                    <label class="" for=""> {{ __('models.Complete') }}</label>
                                </div>
                                <div class="custom-control custom-control-primary" style="display: inline-flex;">
                                    <input type="radio" class="custom-control fliter_datatable" name="fliter_datatable" value="Canceled" />
                                    <label class="" for=""> {{ __('models.Canceled') }}</label>
                                </div>

                            </div>



                        </div>


                    </div>

                    <div class="col-sm-auto">

                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="order_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.order_code') }}</th>
                                    <th class="sort">{{ __('models.code') }}</th>
                                    <th class="sort">{{ __('models.customer_name') }}</th>
                                    <th class="sort">{{ __('models.status') }}</th>
                                    <th class="sort">{{ __('models.phone') }}</th>
                                    <th class="sort">{{ __('models.customer_total_cost') }}</th>
                                    <th class="sort">{{ __('models.profit_saller') }}</th>
                                    <th class="sort">{{ __('models.payment_method') }}</th>
                                    <th class="sort">{{ __('models.date_order') }}</th>
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
        $(document).ready(function() {
            var table =  $('#order_table').DataTable({
                processing     : true,
                serverSide     : true ,
                ordering       : false ,
                iDisplayLength : 10 ,
                lengthMenu     : [
                        [10 , 50 , 100 ,  -1] ,
                        [10 , 50 , 100 ,  'All'] ,
                ] ,
                ajax: "{{ route('saller.get-orders') }}",
                columns: [


                    {
                        data: 'order_code',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,

                    {
                        data: 'code',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,



                    {
                        data: 'customer_name',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,


                    {
                        data: 'status',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,

                    {
                        data: 'phone',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,

                    {
                        data: 'total_products_cost',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,

                    {
                        data: 'saller_total_profit',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,

                    {
                        data: 'payment_method',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,





                    {
                        data: 'date_order',
                        render: function (data, type, full, meta) {
                            return  data ;
                        },
                    } ,




                    {
                        data : 'action' ,
                        searchable: false,
                    } ,









                ]
            });





            $('#status_id').change(function(){
                table.column(2).search($(this).val()).draw();
            });

            $('.fliter_datatable').on('change', function(e) {
                console.log($(this).val());
                if ($(this).val() == 'all') {
                    table.search('').columns().search('').draw();

                } else if ($(this).val() == 'request') {
                        table.search('').columns(2).search(1).draw();
                } else if ($(this).val() == 'progress') {
                    table.search('').columns(2).search(2).draw();
                } else if ($(this).val() == 'processing') {
                    table.search('').columns(2).search(3).draw();
                }else if ($(this).val() == 'Done') {
                    table.search('').columns(2).search(4).draw();
                }else if ($(this).val() == 'Delivery') {
                    table.search('').columns(2).search(5).draw();
                }else if ($(this).val() == 'Complete') {
                    table.search('').columns(2).search(6).draw();
                }else if ($(this).val() == 'Canceled') {
                    table.search('').columns(2).search(7).draw();
                }
            });
        });
    </script>
@endsection
