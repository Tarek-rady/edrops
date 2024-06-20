@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.stocks') }}
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

                        @if(auth('admin')->user()->hasPermission('stocks-create'))

                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.stocks.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_stock') }}</a>
                                </div>
                            </div>
                        @endif

                        @php
                        $stock = '' ;
                    @endphp
                    <x-select col="4" name="country_id" label="{{ __('models.countries') }}"  :options="$countries->pluck('name', 'id')" :value="$stock?$stock->country:''" />
                    <x-select col="4" name="city_id" label="{{ __('models.cities') }}"        :options="[]" :value="$stock?$stock->city:''" />







                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="stocks_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.stocks') }}</th>
                                    <th class="sort">{{ __('models.countries') }}</th>
                                    <th class="sort">{{ __('models.cities') }}</th>
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
@include('dashboard.backend.cities.js')
    <script>
        var table = $('#stocks_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-stocks') }}",
        columns: [


            {
                data : 'name' ,
                render: function (data, type, full, meta) {
                    return  data;
                },
                searchable: false,
            } ,



            {
                data : 'country' ,
                render: function (data, type, full, meta) {
                    return  data  ;
                },
            } ,
            {
                data : 'city' ,
                render: function (data, type, full, meta) {
                    return data ;
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

        $('#country_id').change(function(){
            table.column(1).search($(this).val()).draw();
        });

        $('#city_id').change(function(){
            table.column(2).search($(this).val()).draw();
        });
    </script>
@endsection
