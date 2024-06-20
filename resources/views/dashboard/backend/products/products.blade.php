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



                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_product') }}</a>
                                </div>


                            </div>
                            @php
                                $product = '' ;
                            @endphp

                            <x-select col="4" name="category_id" label="{{ __('models.categories') }}" :options="$categories->pluck('name' , 'id')"/>
                            <x-select col="4" name="brand_id" label="{{ __('models.brands') }}" :options="$brands->pluck('name' , 'id')"/>
                            <x-select col="4" name="country_id" label="{{ __('models.countries') }}" :options="$countries->pluck('name' , 'id')"/>
                            <x-select col="4" name="user_id" label="{{ __('models.users') }}" :options="$users->pluck('name' , 'id')"/>
                            <x-select col="4" name="stock_id" label="{{ __('models.stocks') }}" :options="$stocks->pluck('name' , 'id')"/>


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
                                    <th class="sort">{{ __('models.users') }}</th>
                                    <th class="sort">{{ __('models.price') }}</th>
                                    <th class="sort">{{ __('models.stocks') }}</th>
                                    <th class="sort">{{ __('models.is_active') }}</th>
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

        $(function() {
            $(document).on('change', '.is_active', function() {
                var is_active = $(this).prop('checked') ? 1 : 0; // Simplified the is_active check
                var id = $(this).data('id');
                console.log("is_active: " + is_active); // Check if is_active and id are correct
                console.log("ID: " + id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.changeActiveProduct') }}",
                    data: {
                        'is_active': is_active,
                        'id': id
                    },
                    success: function(data) {
                        alert(data.success);
                    }
                });
            });
        });


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
                ajax: "{{ route('admin.get-new-products') }}",
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
                        data : 'user' ,
                        render: function (data, type, full, meta) {
                            return '<span class="badge bg-info">' + data +'</span>' ;
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
                        data: 'is_active',
                        render: function (data, type, full, meta) {
                            var switchHtml = '<div class="form-check form-switch">' +
                                '<input class="form-check-input is_active" type="checkbox" name="is_active" data-id="'+full.id+'" id="switch_' + full.id + '" ' + (data == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" for="switch_' + full.id + '"></label>' +
                                '</div>';
                            return switchHtml;
                        },
                        searchable: false,
                    },



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
            $('#user_id').change(function(){
                table.column(5).search($(this).val()).draw();
            });

            $('#stock_id').change(function(){
                table.column(7).search($(this).val()).draw();
            });

        });



    </script>
@endsection
