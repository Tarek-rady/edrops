@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.new_products') }}
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





                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control js-example-basic-multiple"   id="category_id">
                                        <option value="" selected>{{ __('models.categories') }}</option>
                                        @foreach ( $categories as $category )
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control js-example-basic-multiple"   id="brand_id">
                                        <option value="" selected>{{ __('models.brands') }}</option>
                                        @foreach ( $brands as $brand )
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control js-example-basic-multiple"   id="country_id">
                                        <option value="" selected>{{ __('models.countries') }}</option>
                                        @foreach ( $countries as $country )
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control js-example-basic-multiple"   id="stock_id">
                                        <option value="" selected>{{ __('models.stocks') }}</option>
                                        @foreach ( $stocks as $stock )
                                            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>










                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="products_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.products') }}</th>
                                    <th class="sort">{{ __('models.img') }}</th>
                                    <th class="sort">{{ __('models.categories') }}</th>
                                    <th class="sort">{{ __('models.brands') }}</th>
                                    <th class="sort">{{ __('models.countries') }}</th>
                                    <th class="sort">{{ __('models.price') }}</th>
                                    <th class="sort">{{ __('models.stocks') }}</th>
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


            var table = $('#products_table').DataTable({
                processing     : true,
                serverSide     : true ,
                ordering       : true ,
                iDisplayLength : 10 ,
                lengthMenu     : [
                        [10 , 50 , 100 ,  -1] ,
                        [10 , 50 , 100 ,  'All'] ,
                ] ,
                ajax: "{{ route('user.get-new-products') }}",
                columns: [


                    {
                        data : 'name_ar' ,
                        searchable: false,

                    } ,

                    {
                        data: 'img',
                        render: function (data, type, full, meta) {
                            return '<img src="' + '{{ asset("storage/") }}' + '/' + data + '" alt="Image" class="me-3 rounded-circle avatar-md p-2 bg-light" >';
                        } ,
                        searchable: false,
                    },

                    {
                        data : 'category' ,
                        render: function (data, type, full, meta) {
                            return '<span class="badge bg-primary">' + data +'</span>' ;
                        },
                    } ,

                    {
                        data : 'brand' ,
                        render: function (data, type, full, meta) {
                            return '<span class="badge bg-secondary">' + data +'</span>' ;
                        },
                    } ,

                    {
                        data : 'country' ,
                        render: function (data, type, full, meta) {
                            return '<span class="badge bg-success">' + data +'</span>' ;
                        },
                    } ,



                    {
                        data : 'price' ,
                        render: function (data, type, full, meta) {
                            return  data  ;
                        },
                    } ,

                    {
                        data : 'store' ,
                        render: function (data, type, full, meta) {
                            return  data  ;
                        },
                    } ,





                    {
                        data : 'action' ,
                        searchable: false,
                    } ,






                ]
            });




            $('#category_id').change(function(){
                table.column(2).search($(this).val()).draw();
            });
            $('#brand_id').change(function(){
                table.column(3).search($(this).val()).draw();
            });
            $('#country_id').change(function(){
                table.column(4).search($(this).val()).draw();
            });


            $('#stock_id').change(function(){
                table.column(6).search($(this).val()).draw();
            });

        });



    </script>
@endsection
