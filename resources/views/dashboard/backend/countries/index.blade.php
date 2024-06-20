@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.countries') }}
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

                        @if(auth('admin')->user()->hasPermission('countries-create'))


                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.countries.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_country') }}</a>
                                </div>
                            </div>
                        @endif







                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="countries_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.countries') }}</th>
                                    <th class="sort">{{ __('models.img') }}</th>
                                    <th class="sort">{{ __('models.phone_key') }}</th>
                                    <th class="sort">{{ __('models.delivery_price') }}</th>
                                    <th class="sort">{{ __('models.time') }}</th>
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
        $('#countries_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-countries') }}",
        columns: [

            {
                data : 'name' ,
                render: function (data, type, full, meta) {
                    return  data ;
                },
            } ,

            {
                data: 'img',
                render: function (data, type, full, meta) {
                    return '<img src="' + '{{ asset("storage/") }}' + '/' + data + '" alt="Image" class="me-3 rounded-circle avatar-md p-2 bg-light" >';
                } ,
                searchable: false,

            },


            {
                data : 'phone_key' ,
                render: function (data, type, full, meta) {
                    return   data ;
                },
            } ,
            {
                data : 'delivery' ,
                render: function (data, type, full, meta) {
                    return   data ;
                },
            } ,
            {
                data : 'time' ,
                render: function (data, type, full, meta) {
                    return   data ;
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
    </script>
@endsection
