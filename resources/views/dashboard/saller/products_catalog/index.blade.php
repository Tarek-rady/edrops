@extends('dashboard.layouts.master')

@section('title')
    {{ __('models.products_catalog') }}
@endsection
<link href="{{ asset('dashboard/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@section('css')
    <link href="{{ asset('dashboard/assets/css/products.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .search-form{
            display: flex;
            justify-content: center;
        }
        .search-form input[type="search"]{
            width: 50%;
            margin-left: 10px
        }
        .search-form .submit-btn{
            width: 10%;
            margin-left: 10px
        }
        .sorting-div{
            text-align: center;
            margin-top: 30px
        }
        .sorting-label{
            width: 140px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            border-radius: 10px;
            background-color: #FFF;
            font-size: 20px;
            box-shadow: 0 8px 16px #0003, 0 6px 22px #00000030;
            cursor: pointer;
            margin-left: 10px;
        }

        .filters-applied{
            display: flex;
            justify-content: flex-start;
        }
        .filters-applied .sorting {
            border: 1px solid #878787;
            border-radius: 5px;
            padding: 5px 20px 5px 8px;
            width: 140px;
            cursor: pointer;
            color: #878787;
            margin-top: 20px;
            font-size: 15px;
            font-weight: bold;
            margin-left: 5px;
        }
        .filters-applied .sorting span{
            margin-left: 5px;
        }

        .product-detail-card{
            border: 1px solid #e8eefa;
            border-radius: 5px;
            position: relative;
            padding: 10px;
            min-height: 120px;
        }
        .product-details .row{
            margin-bottom: 10px !important
        }
        .product-detail-card > i{
            position: absolute;
            top: 0px;
            left: 4px;
            color: #c3c8d8;
            font-size: 17px;
            cursor: pointer;
        }
        .product-detail-card span{
            color: #6d789c;
            font-size: 17px;
            font-weight: 500
        }
        .product-detail-card p{
            text-align: center;
            color: #6d789c;
            font-size: 17px;
            margin-top: 10px;
        }
        .product-detail-card.rate{
            min-height: 240px
        }
        .product-socail-links a{
            width: 100%;
            background-color: #FFF;
            border-radius: 5px;
        }
        .product-socail-links a span{
            font-size: 17px
        }
        .product-socail-links a.amazon-link{
            border: 1px solid #efb168;
        }
        .product-socail-links a.amazon-link i{
            color: #ff9900;
            font-size: 17px;
        }
        .product-socail-links a.youtube-link{
            border: 1px solid #f0a3a3;
        }
        .product-socail-links a.youtube-link i{
            color: #ce0000;
            font-size: 17px;
        }
        .product-modal .product-head{
            position: relative;
        }
        .product-modal .product-head button{
            position: absolute;
            top: 0;
            left: 0;
            border: 1px solid #ce0000;
            font-size: 18px;
        }
        .product-modal .product-head button:hover{
            border: 2px solid #ce0000;
        }
        .product-modal .stock{
            margin: 25px 15px 10px 0;
        }
        .product-modal .stock button{
            width: 100%;
            padding: 13px;
            border: 1px solid #e8eefa;
            font-size: 17px;
        }
        .product-modal .product-asset-download{
            margin: 0 15px 10px 0;
        }
        .product-modal .product-asset-download button{
            width: 100%;
            padding: 13px;
            border: 1px solid #ce0000;
            font-size: 17px;
        }
        .product-modal .product-asset-download button:hover{
            border: 2px solid #ce0000;
        }
        .product-modal .product-desc {
            margin-top: 25px
        }
        .product-modal .product-desc .nav-tabs li a{
            border-bottom: 1px solid #ce0000;
            color: #6d789c;
            font-size: 17px
        }
        .product-modal .product-desc .tab-content{
            border: 1px solid #e8eefa;
            border-top: none;
            padding: 10px;
        }
        .product-modal .product-comment{
            margin-top: 25px
        }
        .product-modal .product-comment button{
            width: 250;
            padding: 9px;
            border: 1px solid #ce0000;
            font-size: 17px;
            float: left;
        }
        .product-modal .product-comment button i{
            color: #ce0000
        }

        .rating > input {
            display: none;
        }

        .rating > label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            margin-top: auto;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 76%;
            transition: 0.3s;
        }

        .rating > input:checked ~ label,
        .rating > input:checked ~ label ~ label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23ce0000' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }

        .rating > input:not(:checked) ~ label:hover,
        .rating > input:not(:checked) ~ label:hover ~ label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23ce0000' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }
        .feed-back button{
            font-size: 25px;
            background-color: #ce0000;
            color: #FFF;
            width: 100px
        }
        .feed-back button:hover{
            background-color: #ce0000;
            color: #FFF;
        }
    </style>
@endsection


@section('content')
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="filter-section">
                        <form class="search-form">
                            <input type="search" class="form-control" name="search" placeholder="ادخل كلمات البحث هنا(رمز المنتج، اسم المنتج، اسم المورد ...)">
                            <button type="button" class="btn btn-danger submit-btn" onclick="filterBySearch()">بحث</button>
                            <div class="dropdown sorting-label">
                                <div class="" id="page-header-user-dropdown " data-bs-toggle="dropdown">
                                    <span class="">
                                        <img src="{{asset('img/marker.png')}}" width="15px" height="15px"/>
                                        الدولة
                                        <i class="ri-arrow-drop-down-fill"></i>
                                    </span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-end country-dropdown">
                                    @foreach ($countries as $country)
                                        <a class="dropdown-item" href="#" onclick="filterByCountry('{{$country->id}}')" id="{{$country->id}}">
                                            <span class="align-middle">{{ $country->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="dropdown sorting-label">
                                <div class="" id="page-header-user-dropdown " data-bs-toggle="dropdown">
                                    <span class="">
                                        <img src="{{asset('img/category.png')}}" width="15px" height="15px"/>
                                        التصنيف
                                        <i class="ri-arrow-drop-down-fill"></i>
                                    </span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-end category-dropdown">
                                    @foreach ($categories as $category)
                                        <a class="dropdown-item" href="#" onclick="filterByCategory('{{$category->id}}')" id="{{$category->id}}">
                                            <span class="align-middle">{{ $category->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                        <div class="sorting-div">
                            <label class="sorting-label">
                                <div class="sorting-by-newest" onclick="sortBy('created_at')">
                                    <img src="{{asset('img/new.png')}}" width="15px" height="15px"/>
                                    الاحدث
                                </div>
                            </label>
                            <label class="sorting-label">
                                <div class="sorting-by-price" onclick="sortBy('price')">
                                    <img src="{{asset('img/dolar.png')}}" width="15px" height="15px"/>
                                    السعر
                                </div>
                            </label>

                        </div>
                    </div>
                    <div class="filters-applied">
                    </div>
                </div><!-- end card header -->

                <div class="card-body sell-bg">
                    <div class="listjs-table" id="productList">
                        <div class="row g-4 mb-3">
                            @foreach ($products->where('is_active' , 1) as $product)
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 pl-2 pr-2">
                                    <div class="sell">
                                        <div class="sell-header">
                                            <div class="header__img" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{$product->id}}">
                                                <swiper-container class="mySwiper sell-mySwiper" pagination="true" pagination-type="fraction">
                                                    @foreach ($product->images as $image)
                                                        <swiper-slide>
                                                            <img src="{{ asset('storage/'.$image->img) }}" alt="img-card" width="100%"
                                                            height="100%">
                                                        </swiper-slide>
                                                    @endforeach
                                                </swiper-container>

                                                {{--  <img src="{{ asset('storage/products/2.png') }}" alt="">  --}}
                                            </div>
                                        </div>
                                        <div class="sell-body">
                                            <div class="sell-body__title">
                                                <p class="title-name">{{ $product->name }}</p>
                                                <p class="title-code" style="margin-bottom:0">
                                                    المورد: id87596633298
                                                </p>
                                                <p>
                                                    رمز المنتج : {{ $product->sku }}
                                                </p>
                                            </div>
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-6">
                                                    <div class="sell-body__right">
                                                        <div class="sell-body__right-price">
                                                            <p>سعر التكلفة
                                                            </p>
                                                            <p>
                                                                <span> $ {{$product->price}}</span>
                                                            </p>
                                                        </div>
                                                        <div class="sell-body__right-city">
                                                            <p>الدوله</p>
                                                            <p>
                                                                <span>{{$product->country->name}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <div class="sell-body__left">
                                                        <div class="sell-body__right-profit">
                                                            <p>
                                                                الربح المتوقع</p>
                                                            <p><span> $ {{$product->profit}}</span></p>
                                                        </div>
                                                        <div class="sell-body__right-version">
                                                            <p>تقييم المنتج</p>
                                                            <p>
                                                                <span>{{ $product->avg_rates() }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="sell-body__btn">
                                                        <button onclick="add_to_my_products('{{$product->id}}')"> اضافة الى منتجاتي</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            {{ $products->links('vendor.pagination.custom') }}
                             @include('dashboard.saller.products_catalog.show')
                    </div><!-- end card -->
                </div>

                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    @endsection

    @section('js')

    @include('dashboard.saller.products_catalog.js')

    @endsection
