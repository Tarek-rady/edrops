@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.pulls') }}
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
                        <table class="table align-middle table-nowrap" id="pulls_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.pulls') }}</th>
                                    <th class="sort">{{ __('models.amount') }}</th>
                                    <th class="sort">{{ __('models.admins') }}</th>
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
        $('#pulls_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('saller.get-pulls') }}",
        columns: [


            {
                data : 'pull' ,
                searchable: false,
            } ,


            {
                data : 'amount' ,
                searchable: false,
            } ,





            {
                data : 'admin' ,
                render: function (data, type, full, meta) {
                    return '<span class="badge bg-secondary">' + data +'</span>' ;
                },
            } ,


            {
                data : 'created_at' ,
                searchable: false,

            } ,







        ]
        });
    </script>
@endsection
