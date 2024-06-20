@extends('dashboard.layouts.master')

@section('title')
    {{ __('models.profile') }}
@endsection
@section('css')
    <link href="{{ asset('dashboard/assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/libs/gridjs/theme/mermaid.min.css')}}">
@endsection

@section('content')


<div class="container-fluid">
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ asset('dashboard/' . $user->img) }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ $user->img ? asset('dashboard/' . $user->img) : asset('storage/admins/1.png') }}" alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{  $user->name }}</h3>
                    <p class="text-white text-opacity-75">{{  $user->email }} </p>
                    <p class="text-white text-opacity-75"> {{  $user->phone }}</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $user->country->name }}</div>
                        <div>
                            <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $user->city->name }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">{{ $user->products()->count() }}</h4>
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
                        <a href="#" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
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
                                                        <td class="text-muted">{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.phone') }} :</th>
                                                        <td class="text-muted">+{{ $user->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.email') }} :</th>
                                                        <td class="text-muted">{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.countries') }} :</th>
                                                        <td class="text-muted"><span class="badge bg-secondary">{{ $user->country->name }}</span>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.cities') }} :</th>
                                                        <td class="text-muted"><span class="badge bg-success">{{ $user->city->name }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('models.created_at') }}</th>
                                                        <td class="text-muted">{{ date('D, d M Y - h:ia', strtotime($user->created_at)) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Portfolio</h5>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div>
                                                <a href="{{ $user->instagram }}" class="avatar-xs d-block">
                                                    <span class="avatar-title rounded-circle fs-16 bg-body text-body shadow">
                                                        <i class="ri-instagram-fill"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ $user->facebook }}" class="avatar-xs d-block">
                                                    <span class="avatar-title rounded-circle fs-16 bg-primary shadow">
                                                        <i class="ri-facebook-fill"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <div>
                                                <a href="{{ $user->shopify }}" class="avatar-xs d-block">
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

                {{--  avg_rates  --}}
                <div class="card-body border-top border-top-dashed p-4">
                    <div>
                        <h6 class="text-muted text-uppercase fw-semibold mb-4">{{ __('models.avg_rates') }}</h6>
                        <div>
                            <div>
                                <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="fs-16 align-middle text-warning">

                                                @for ($i =1 ; $i < 6 ; $i++)
                                                    <i class="ri-star-{{ $user->avg_rates() >= $i ? 'fill' : ''}} "></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h6 class="mb-0">4.5 out of 5</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>


                <div class="card-body p-4 border-top border-top-dashed">
                    <h6 class="text-muted text-uppercase fw-semibold mb-4">{{ __('models.rates') }}</h6>
                    <!-- Swiper -->
                    <div class="swiper vertical-swiper" style="height: 242px;">
                        <div class="swiper-wrapper">

                            @foreach ($user->rates as $rate)

                                <div class="swiper-slide">
                                    <div class="card border border-dashed shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light rounded">
                                                        <img src="{{$rate->admin->img ? asset('storage/' . $rate->admin->img) : asset('storage/admins/1.png')}}" alt="{{ $rate->admin->name }}" height="30">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div>
                                                        <p class="text-muted mb-1 fst-italic">" Great product and looks great, lots of features. "</p>
                                                        <div class="fs-11 align-middle text-warning">
                                                            @for ($i =1 ; $i < 6 ; $i++)
                                                                <i class="ri-star-{{ $rate->rate >= $i ? 'fill' : ''}} "></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="text-end mb-0 text-muted">
                                                         <cite title="Source Title">{{ date('D, d M Y - h:ia', strtotime($rate->created_at)) }}</cite>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="javascript:void(0)" class="link-primary">View All Reviews <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                    </div>
                </div>



                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div><!-- container-fluid -->

@endsection


@section('js')
<!-- gridjs js -->
<script src="{{ asset('dashboard/assets/libs/gridjs/gridjs.umd.js')}}"></script>
<script src="https://unpkg.com/gridjs/plugins/selection/dist/selection.umd.js"></script>

<!--Swiper slider js-->
<script src="{{ asset('dashboard/assets/libs/swiper/swiper-bundle.min.js')}}"></script>

<!--seller-details init js -->
<script src="{{ asset('dashboard/assets/js/pages/seller-details.init.js')}}"></script>
@endsection
