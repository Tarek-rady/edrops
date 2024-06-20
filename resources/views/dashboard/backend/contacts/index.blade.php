@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.contacts') }}
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
                        <table class="table align-middle table-nowrap" id="contacts_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.sender') }}</th>
                                    <th class="sort">{{ __('models.phone') }}</th>
                                    <th class="sort">{{ __('models.email') }}</th>
                                    <th class="sort">{{ __('models.type') }}</th>
                                    <th class="sort">{{ __('models.msg') }}</th>
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
        $('#contacts_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: "{{ route('admin.get-contacts') }}",
        columns: [

            {
                data : 'sender' ,
                render: function (data, type, full, meta) {
                    return  data  ;
                },
            } ,

            {
                data : 'phone' ,
                render: function (data, type, full, meta) {
                    return  data  ;
                },
            } ,
            {
                data : 'email' ,
                render: function (data, type, full, meta) {
                    return  data  ;
                },
            } ,


            {
                data : 'type' ,
                render: function (data, type, full, meta) {
                    if(data == 'user'){
                       return 'مورد' ;
                    }else if(data == 'saller') {
                        return 'بائع' ;
                    }else{
                        return 'الموقع' ;
                    }
                },
            } ,
            {
                data : 'msg' ,
                render: function (data, type, full, meta) {
                    return  data  ;
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
