@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.currencies') }}
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


                        @if(auth('admin')->user()->hasPermission('currencies-create'))

                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.currencies.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_currency') }}</a>
                                </div>
                            </div>
                        @endif




                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="currencies_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.currencies') }}</th>
                                    <th class="sort">{{ __('models.code') }}</th>
                                    <th class="sort">{{ __('models.exchange') }}</th>
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
        $('#currencies_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-currencies') }}",
        columns: [


            {
                data : 'name' ,
                searchable: false,

            } ,


            {
                data : 'code' ,
                render: function (data, type, full, meta) {
                    return  data  ;
                },
                searchable: false,

            } ,

            {
                data : 'exchange' ,
                render: function (data, type, full, meta) {
                    return  data  ;
                },
                searchable: false,

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
    </script>
@endsection
