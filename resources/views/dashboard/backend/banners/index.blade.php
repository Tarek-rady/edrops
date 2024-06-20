@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.banners') }}
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

                        @if(auth('admin')->user()->hasPermission('banners-create'))
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.banners.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_banner') }}</a>
                                </div>
                            </div>
                        @endif




                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="banners_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.banners') }}</th>
                                    <th class="sort">{{ __('models.img') }}</th>
                                    <th class="sort">{{ __('models.status') }}</th>
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

        $(function() {
            $(document).on('change', '.status', function() {
                var status = $(this).prop('checked') ? 1 : 0; // Simplified the status check
                var id = $(this).data('id');
                console.log("status: " + status); // Check if status and id are correct
                console.log("ID: " + id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.changeBannerstatus') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        alert(data.success);
                    }
                });
            });
        });


        $('#banners_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-banners') }}",
        columns: [


            {
                data : 'title' ,
            } ,

            {
                data: 'img',
                render: function (data, type, full, meta) {
                    return '<img src="' + '{{ asset("storage/") }}' + '/' + data + '" alt="Image" class="me-3 rounded-circle avatar-md p-2 bg-light" >';
                } ,
                searchable: false,

            },


            {
                data: 'status',
                render: function (data, type, full, meta) {
                    var switchHtml = '<div class="form-check form-switch">' +
                        '<input class="form-check-input status" type="checkbox" name="status" data-id="'+full.id+'" id="switch_' + full.id + '" ' + (data == 'active' ? 'checked' : '') + '>' +
                        '<label class="form-check-label" for="switch_' + full.id + '"></label>' +
                        '</div>';
                    return switchHtml;
                },
                searchable: false,
            },


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
