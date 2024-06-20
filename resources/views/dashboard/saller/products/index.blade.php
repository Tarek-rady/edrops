@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.my_products') }}
@endsection


@section('content')
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ __('models.products') }}</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">

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
                                        <th class="sort">{{ __('models.qty') }}</th>
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
                ajax: "{{ route('saller.my_products') }}",
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
                        data : 'qty' ,
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



        });

    </script>
    <script>

        function add_cart(product_id) {
            // Show loader
            $('#loader-overlay').show();

            var url = "{{ route('saller.cart.add', ":id") }}";
            url = url.replace(':id', product_id);

            $.ajax({
                type: 'POST',
                url: url,
                data:{
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Hide loader
                    $('#loader-overlay').hide();

                    $('.alert-message.success p').text(response.message)
                    $('.alert-message.success').show();
                    setTimeout(function() {
                        $('.alert-message.success').hide();
                    }, 2000);

                    $('#cart>a>span').text(response.cart_items_count);
                },
                error: function(xhr, status, error) {
                    console.error(error);

                    // Hide loader
                    $('#loader-overlay').hide();
                }
            });
        }
    </script>
@endsection
