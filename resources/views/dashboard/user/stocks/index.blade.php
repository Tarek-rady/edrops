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



                         {{--  country_id  --}}
                         <div class="col-lg-4">
                            <label for="country_id" class="form-label">{{ __('models.countries') }}</label>

                            <select class="form-control js-example-basic-multiple" name="country_id" id="country_id">
                                <option value="" > {{ __('models.countries') }} </option>
                                @foreach ( $countries as $country )
                                    <option value="{{ $country->id }}" {{ old('country_id') ==  $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{--  city_id  --}}
                        <div class="col-lg-4">
                            <label for="city_id" class="form-label">{{ __('models.cities') }}</label>

                            <select class="form-control js-example-basic-multiple" name="city_id"  id="city_id">
                                <option value="" > {{ __('models.cities') }} </option>

                            </select>
                        </div>





                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="stocks_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.stocks') }}</th>
                                    <th class="sort">{{ __('models.countries') }}</th>
                                    <th class="sort">{{ __('models.cities') }}</th>
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
        ajax: "{{ route('user.get-stocks') }}",
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
