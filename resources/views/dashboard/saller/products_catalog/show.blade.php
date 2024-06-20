@foreach ($products as $product)
@php
$productImages = [];
@endphp
<div class="product-modal">
    <div class="modal fade bs-example-modal-xl-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="header__img">
                                <swiper-container class="mySwiper sell-mySwiper" pagination="true" pagination-type="fraction">
                                    @foreach ($product->images as $image)
                                        @php
                                            $productImages[] = asset('storage/'.$image->img);
                                        @endphp
                                        <swiper-slide>
                                            <img src="{{ asset('storage/'.$image->img) }}" alt="img-card" width="100%"
                                            height="100%">
                                        </swiper-slide>
                                    @endforeach
                                </swiper-container>
                            </div>
                            <div class="stock">
                                <button class="btn">
                                    الكميه : <span> {{ $product->qty }}</span>
                                </button>
                            </div>
                            <div class="product-asset-download" id="productAssetDownload">
                                <button class="btn" onclick="downloadMediaAsZip('images', '{{json_encode($productImages)}}', '{{$product->name}}', this)">
                                    <img src="{{asset('img/cloud_download.png')}}" style="width: 20px;height:20px;" id="downloadMedia">
                                    تحميل صور المنتج
                                </button>
                            </div>
                            @if ($product->video)
                                <div class="product-asset-download" id="productAssetDownload">
                                    <button class="btn" onclick="downloadMediaAsZip('video', '{{ asset('storage/'. $product->video) }}', '{{$product->name}}', this)">
                                        <img src="{{asset('img/cloud_download.png')}}" style="width: 20px;height:20px;" id="downloadMedia">
                                        تحميل فيديو المنتج
                                    </button>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-8">
                            <div class="product-head" style="margin-bottom:15px">
                                <h3>{{ $product->name }}</h3>
                                <button class="btn" onclick="add_to_my_products('{{$product->id}}')">
                                    <span>
                                        <img src="{{asset('img/add_to_my_products.svg')}}" style="width:20px;height:20px">
                                    </span>
                                    اضافة إلي منتجاتي
                                </button>
                            </div>
                            <div class="product-supplier">
                                @if ($product->user)
                                  <p style="color:green;margin-bottom:5px">المورد : <span>{{ $product->user->code }}</span></p>
                                @else
                                    <p style="color:green;margin-bottom:5px">الادمن : <span>{{ $product->admin->name }}</span></p>

                                @endif
                                <p>رمز المنتج : <span>{{$product->sku}}</span></p>
                            </div>
                            <div class="product-details">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="product-row">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="product-detail-card">
                                                        <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'سعر يضعه المورد كسعر تكلفة(جملة) للمنتج')"></i>
                                                        <span>
                                                            <img src="{{asset('img/cost_price.svg')}}" style="width:20px;height:20px">
                                                        </span>
                                                        <span>{{$product->cost}} $</span>
                                                        <p >سعر التكلفه</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="product-detail-card">
                                                        <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'سعر نقترحة لبيع هذا المنتج ، يمكنك البيع بأعلى أو أقل من سعر البيع المقترح ، يعتمد تقييم سعر البيع على سعر بيع المنتج في المتاجر المشهورة ، نسبة التأكيد ، نسبة التسليم للمنتج وتكلفة الاعلانات')"></i>
                                                        <span>
                                                            <img src="{{asset('img/selling_price.svg')}}" style="width:20px;height:20px" >
                                                        </span>
                                                        <span>{{$product->price}} $</span>
                                                        <p >سعر البيع المقترح</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="product-detail-card">
                                                        <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'الربح من المنتج اذا بعته على سعر البيع المقترح')"></i>
                                                        <span>
                                                            <img src="{{asset('img/cost_price.svg')}}" style="width:20px;height:20px">
                                                        </span>
                                                        <span>{{$product->profit}} $</span>
                                                        <p > الربح المتوقع</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="product-detail-card">
                                                    <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'مؤشر يقيس نسبة تأكيد الطلبات من الزبائن على هذا المنتج ، يساعدك على معرفة كفاءة المكالمات التأكيدية لهذا المنتج.')"></i>
                                                    <span>
                                                        <img src="{{asset('img/confirmaing_rate.svg')}}" style="width:20px;height:20px">
                                                    </span>
                                                    {{ $product->ratio ?  $product->ratio : 'لا توجد إحصائيات حاليا' }}
                                                    <p >نسبة التأكيد</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="product-detail-card">
                                                    <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'يُقاس هذا المعدل لمعرفة كمية الطلبات التي تم توصيلها بنجاح من الطلبات المؤكدة ، يساعدك على معرفة كفاءة عملية التوصيل لهذا المنتج.')"></i>
                                                    <span>
                                                        <img src="{{asset('img/delevary_rating.svg')}}" style="width:20px;height:20px">
                                                    </span>

                                                    {{ $product->delivery ?  $product->delivery : 'لا توجد إحصائيات حاليا' }}

                                                    <p > نسبة التسليم</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="product-detail-card">
                                                    <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'تعبر عن مدى التنافس على هذا المنتج في اي دروبس وفي السوق ، يساعدك باتخاذ قرارات حول التسعير وسياسة الترويج كلما كان الرقم اقل كانت المنافسة اضعف')"></i>
                                                    <span>
                                                        <img src="{{asset('img/monafaseh.svg')}}" style="width:20px;height:20px">
                                                    </span>
                                                    {{ $product->competition ?  $product->competition : 'لا توجد إحصائيات حاليا' }}

                                                    <p >المنافسة</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="product-detail-card rate">
                                            <i class="ri-information-fill" onclick="openModal('#zoomInModal', 'تُظهر هذه الدرجة تقييماً شاملاً لمدى نجاح المنتج على Dropphi. يعتمد المؤشر على مجموعة من العوامل ( سعر المنتج ، انتشار المنتج ، الترند ، الجودة، المنافسة ، نسبة التاكيد ، نسبة التسليم ، نسبة الهامش الربحي و فكرة المنتج. يساعدك في اتخاذ قرارك بالعمل على المنتج . كلما كان الرقم أعلى كان نسبة نجاح المنتج أعلى وأعلى تقييم هو 5.')"></i>
                                            <span>
                                                <i class="ri-star-fill" style="color:#ce0000"></i>
                                            </span>
                                            <span>تقييم المنتج</span>
                                            <p > {{ $product->avg_rates() }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-socail-links">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ $product->amazon }}" class="btn amazon-link">
                                            <span>
                                                <i class="ri-amazon-line"></i>
                                            </span>
                                            <span>لينك امازون</span>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ $product->youtube }}" class="btn youtube-link">
                                            <span>
                                                <i class="ri-youtube-fill"></i>
                                            </span>
                                            <span>لينك يوتيوب</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-desc">
                                <ul class="nav nav-tabs nav-tabs-custom nav-danger nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#product-use" role="tab">
                                            استخدام المنتج
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#product-desc" role="tab">
                                            وصف المنتج
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#product-detail" role="tab">
                                            تقاصيل المنتج
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="product-use" role="tabpanel">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-2">
                                                {{ $product->use_product }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product-desc" role="tabpanel">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-2">
                                               {{ $product->desc }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product-detail" role="tabpanel">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-2">
                                                {{ $product->note }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-comment">
                                <div>
                                    <button type="button" class="btn"  onclick="openModal('#commentModal', null, '{{$product->id}}')">
                                        <i class="ri-pencil-fill"></i>
                                        تعليقات علي المنتج
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
@endforeach
</div>
<div id="commentModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" style="display: none;z-index:99999">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-center p-5">
        <input type="hidden" name="product_id" value="">
        <div class="form-group">
            <div class="mb-3">
                <textarea class="form-control" name="msg" id="msg" placeholder="ملاحظات حول المنتج" rows="5" required></textarea>
                <div class="error"></div>
            </div>
        </div>
        <div class="feed-back">
            <h3 class="fs-18 mb-3">تقييم المنتج</h3>
            <div class="rating">
                <input type="radio" name="rating" id="rating-5">
                <label for="rating-5"></label>
                <input type="radio" name="rating" id="rating-4">
                <label for="rating-4"></label>
                <input type="radio" name="rating" id="rating-3">
                <label for="rating-3"></label>
                <input type="radio" name="rating" id="rating-2">
                <label for="rating-2"></label>
                <input type="radio" name="rating" id="rating-1">
                <label for="rating-1"></label>
            </div>
            <button class="btn" onclick="rateProduct(this)">تقييم</button>
        </div>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- Modal Blur -->
<div id="zoomInModal" class="modal fade zoomIn" tabindex="-1" aria-labelledby="zoomInModalLabel" aria-hidden="true" style="display: none;z-index:99999">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <p class="text-muted" style="font-size: 18px">

        </p>
    </div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
