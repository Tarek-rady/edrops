@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.new_sallers') }}
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
                        <table class="table align-middle table-nowrap" id="saller_table">
                            <thead class="table-light">
                                <tr>

                                    <th class="sort">{{ __('models.sallers') }}</th>
                                    <th class="sort">{{ __('models.name') }}</th>
                                    <th class="sort">{{ __('models.email') }}</th>
                                    <th class="sort">{{ __('models.phone') }}</th>
                                    <th class="sort">{{ __('models.countries') }}</th>
                                    <th class="sort">{{ __('models.cities') }}</th>
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
                    url: "{{ route('admin.changeActiveSaller') }}",
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


        var table =  $('#saller_table').DataTable({
            processing     : true,
            serverSide     : true ,
            ordering       : false ,
            iDisplayLength : 10 ,
            lengthMenu     : [
                    [10 , 50 , 100 ,  -1] ,
                    [10 , 50 , 100 ,  'All'] ,
            ] ,
            ajax: "{{ route('admin.get-new-sallers') }}",
            columns: [



                {
                    data: 'img',
                    render: function (data, type, full, meta) {
                        return '<img src="' + '{{ asset("storage/") }}' + '/' + data + '" alt="Image" class="me-3 rounded-circle avatar-md p-2 bg-light" >';
                    } ,
                    searchable: false,

                },

                {
                    data : 'name' ,
                    render: function (data, type, full, meta) {
                       return data ;
                    },
                } ,

                {
                    data : 'email' ,
                    render: function (data, type, full, meta) {
                       return data ;
                    },
                } ,

                {
                    data : 'phone' ,
                    render: function (data, type, full, meta) {
                        return  data  ;
                    },
                } ,


                {
                    data : 'country' ,
                    render: function (data, type, full, meta) {
                        return '<span class="badge bg-secondary">' + data +'</span>' ;
                    },
                } ,

                {
                    data : 'city' ,
                    render: function (data, type, full, meta) {
                        return '<span class="badge bg-success">' + data +'</span>' ;
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

        $('#country_id').change(function(){
            table.column(4).search($(this).val()).draw();
        });

        $('#city_id').change(function(){
            table.column(5).search($(this).val()).draw();
        });


    </script>

    @include('dashboard.backend.cities.js')
@endsection
