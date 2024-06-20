@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.terms') }}
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
                                    <a href="{{ route('admin.terms.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i>{{ __('models.add_term') }}</a>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.export-terms') }}" class="btn btn-primary" ><i class=" ri-folder-received-fill"></i>{{ __('models.export') }}</a>
                                </div>
                            </div>



                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="terms_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.terms') }}</th>
                                    <th class="sort">{{ __('models.desc') }}</th>
                                    <th class="sort">{{ __('models.type') }}</th>
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




        $('#terms_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-terms') }}",
        columns: [


            {
                data : 'name_en' ,
            } ,

            {
                data : 'desc' ,

            } ,

            {

                data : 'type' ,
                render: function (data, type, full, meta) {
                    return '<span class="badge bg-info-subtle text-info badge-border">' + data + '</span>';
                },


            } ,

            {
                data : 'action' ,
                searchable: false,
            } ,


        ]
        });
    </script>

@endsection
