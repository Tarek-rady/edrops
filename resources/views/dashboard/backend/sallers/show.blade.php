@extends('dashboard.layouts.master')

@section('title')
    {{ __('models.saller_details') }}
@endsection


@section('content')


<div class="container-fluid">
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ asset('storage/' . $saller->img) }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ asset('storage/' . $saller->img) }}" alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{  $saller->name }}</h3>
                    <p class="text-white text-opacity-75">{{  $saller->email }} </p>
                    <p class="text-white text-opacity-75"> {{  $saller->phone }}</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $saller->country->name }}</div>
                        <div>
                            <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $saller->city->name }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">{{ $saller->products()->count() }}</h4>
                            <p class="fs-14 mb-0">{{ __('models.saller_cart') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">0</h4>
                            <p class="fs-14 mb-0">{{ __('models.saller_puy') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex profile-wrapper">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>

                    </ul>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.sallers.edit' , $saller->id) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">Complete Your Profile</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                <div class="label">30%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Info</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.name') }} :</th>
                                                        <td class="text-muted">{{ $saller->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.phone') }} :</th>
                                                        <td class="text-muted">+{{ $saller->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.email') }} :</th>
                                                        <td class="text-muted">{{ $saller->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.countries') }} :</th>
                                                        <td class="text-muted"><span class="badge bg-secondary">{{ $saller->country->name }}</span>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.cities') }} :</th>
                                                        <td class="text-muted"><span class="badge bg-success">{{ $saller->city->name }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.points') }} :</th>
                                                        <td class="text-muted">{{ $saller->point ? $saller->point->name : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.created_at') }}</th>
                                                        <td class="text-muted">{{ date('D, d M Y - h:ia', strtotime($saller->created_at)) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Portfolio</h5>
                                        <div class="row justify-content-center align-items-center my-3">
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="sale">
                                                    <div class="sale1-icon"></div>
                                                    <div class="sale-header">
                                                        <h4>{{ __('models.total_amount') }}</h4>
                                                    </div>
                                                    <div class="sale-price">
                                                        <p class="m-0"> <span class="badge bg-secondary">{{ $saller->amount }}</span></p>                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="sale">
                                                    <div class="sale1-icon"></div>
                                                    <div class="sale-header">
                                                        <h4>{{ __('models.pull') }}</h4>
                                                    </div>
                                                    <div class="sale-price">
                                                        <p class="m-0"> <span class="badge bg-danger">{{ $saller->pulls->sum('pull') }}</span></p>                                                     </div>
                                                        </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="sale">
                                                    <div class="sale1-icon"></div>
                                                    <div class="sale-header">
                                                        <h4>{{ __('models.saller_amount') }}</h4>
                                                    </div>
                                                    <div class="sale-price">
                                                        <p class="m-0"> <span class="badge bg-success">{{ $saller->amount -  $saller->pulls->sum('pull')}}</span></p>                                                     </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div>
                                                <a href="{{ $saller->instagram }}" class="avatar-xs d-block">
                                                    <span class="avatar-title rounded-circle fs-16 bg-body text-body shadow">
                                                        <i class="ri-instagram-fill"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ $saller->facebook }}" class="avatar-xs d-block">
                                                    <span class="avatar-title rounded-circle fs-16 bg-primary shadow">
                                                        <i class="ri-facebook-fill"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <div>
                                                <a href="{{ $saller->shopify }}" class="avatar-xs d-block">
                                                    <span class="avatar-title rounded-circle fs-16 bg-danger shadow">
                                                        <i class="ri-pinterest-fill"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->




                                <!--end card-->


                                <!--end card-->
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>


                </div>
                <!--end tab-content-->
            </div>
        </div>


        <div class="d-grid gap-2" >
            <a href="" class="btn btn-trans waves-effect waves-light btn-block add-input-value-color">{{ __('models.pulls') }}</a><br>
        </div>

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
        </div><!-- end card -->  <br><br><br>


        <div class="d-grid gap-2" >
            <a href="" class="btn btn-success waves-effect waves-light btn-block add-input-value-color">{{ __('models.profits') }}</a><br>
        </div>

        <div class="card-body">
            <div class="listjs-table" id="customerList">
                <div class="row g-4 mb-3">






                </div>

                <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap" id="profits_table">
                        <thead class="table-light">
                            <tr>

                                <th class="sort">{{ __('models.profits') }}</th>
                                <th class="sort">{{ __('models.orders') }}</th>
                                <th class="sort">{{ __('models.admins') }}</th>
                                <th class="sort">{{ __('models.created_at') }}</th>
                                <th class="sort" >{{ __('models.action') }}</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">


                        </tbody>
                    </table>






            </div>
        </div><!-- end card -->


        <!--end col-->
    </div>
    <!--end row-->

</div><!-- container-fluid -->

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
        ajax: {
            url: "{{ route('admin.get-saller-pulls') }}",
            type: "GET",
            data: {
                saller_id: {{ $saller->id }}
            }
        },
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

    <script>
        $('#profits_table').DataTable({
        processing     : true,
        serverSide     : true ,
        ordering       : false ,
        iDisplayLength : 10 ,
        lengthMenu     : [
                 [10 , 50 , 100 ,  -1] ,
                 [10 , 50 , 100 ,  'All'] ,
        ] ,
        ajax: {
            url: "{{ route('admin.get-saller-profits') }}",
            type: "GET",
            data: {
                saller_id: {{ $saller->id }}
            }
        },
        columns: [


            {
                data : 'profit' ,
                searchable: false,
            } ,




            {
                data : 'order' ,
                render: function (data, type, full, meta) {
                    return   data  ;
                },
            } ,

            {
                data : 'admin' ,
                render: function (data, type, full, meta) {
                    return '<span class="badge bg-info">' + data +'</span>' ;
                },
            } ,


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
