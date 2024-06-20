@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.brands') }}
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
                        <table class="table align-middle table-nowrap" id="brands_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.brands') }}</th>
                                    <th class="sort">{{ __('models.img') }}</th>
                                    <th class="sort">{{ __('models.products') }}</th>
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
        $('#brands_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('user.get-brands') }}",
        columns: [


            {
                data : 'name' ,
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
                data : 'products' ,
                render: function (data, type, full, meta) {
                    return '<span class="badge bg-secondary">' + data +'</span>' ;
                },
                searchable: false,
            } ,
            {
                data : 'created_at' ,
                searchable: false,

            } ,






        ]
        });
    </script>
@endsection
