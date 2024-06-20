@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.rates') }}
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

                        @if(auth('admin')->user()->hasPermission('rates-create'))


                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.rates.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_rate') }}</a>
                                </div>
                            </div>
                        @endif


                    <div class="col-lg-6">
                        <select class="form-control js-example-basic-multiple" name="country_id"   id="country_id">
                            <option value="" > {{ __('models.countries') }} </option>
                            @foreach ( $countries as $country )
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>







                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="rates_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.user_name') }}</th>
                                    <th class="sort">{{ __('models.rates') }}</th>
                                    <th class="sort">{{ __('models.countries') }}</th>
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
        var table = $('#rates_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-rates') }}",
            columns: [

                {
                    data : 'user_name' ,
                    render: function (data, type, full, meta) {
                        return  data  ;
                    },
                } ,
                {
                    data : 'rate' ,

                } ,



                {
                    data : 'country' ,
                    render: function (data, type, full, meta) {
                        return '<span class="badge bg-secondary">' + data +'</span>' ;
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
    </script>
@endsection
