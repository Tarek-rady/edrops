@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.profit_app') }}
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
                        <table class="table align-middle table-nowrap" id="profits_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.products') }}</th>
                                    <th class="sort">{{ __('models.profit') }}</th>
                                    <th class="sort">{{ __('models.cost_user') }}</th>
                                    <th class="sort">{{ __('models.cost') }}</th>
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
        $('#profits_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-profits-app') }}",
        columns: [



            {
                data : 'product' ,
                render: function (data, type, full, meta) {
                    return   data  ;
                },
                searchable: false,
            } ,


            {
                data : 'profit' ,
                render: function (data, type, full, meta) {
                    return   data  ;
                },
                searchable: false,
            } ,


            {
                data : 'cost' ,
                render: function (data, type, full, meta) {
                    return   data  ;
                },
                searchable: false,
            } ,


            {
                data : 'price' ,
                render: function (data, type, full, meta) {
                    return   data  ;
                },
            } ,

            {
                data : 'created_at' ,
                render: function (data, type, full, meta) {
                    return   data  ;
                },
                searchable: false,
            } ,












        ]
        });
    </script>
@endsection
