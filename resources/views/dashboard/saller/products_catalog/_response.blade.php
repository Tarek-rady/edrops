<div class="row g-4 mb-3">
    @foreach ($products as $product)
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
                        <p class="title-code">
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
                                    <p>تشحن الى</p>
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
</div>
