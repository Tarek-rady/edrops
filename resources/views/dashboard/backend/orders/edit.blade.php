@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.products') }}
@endsection
@section('css')
    <style>
        .customer-cost h3,
        .seller-profit h3{
            font-size: 35px
        }
        .customer-cost p,
        .seller-profit p{
            font-size: 16px;
        }
        .customer-cost h2,
        .seller-profit h2{
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #000;
        }
        .seller-profit h2{
            color: #67cf94;
        }
        .payment-method{
            border: 2px solid #f0f0f0
        }
        .payment-method .title{
            background-color: #f0f0f0;
            padding:10px 15px;
        }
        .payment-method .body{
            padding: 10px
        }
    </style>
@endsection

@section('content')
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>
    <form action="{{route('admin.update-order')}}" method="POST" id="cartOrderForm">
        @csrf

        <input type="hidden" name="id" id="id" value="{{ $order->id }}">
        <div class="row mb-3">
            <div class="col-xl-8">
                <div class="row align-items-center gy-3 mb-3">
                    <div class="col-sm">
                        <div>
                            <h5 class="fs-20 mb-0">
                                سلة المشتريات
                                <span class="cart_qty">(<span>{{$order->cart_items->sum('qty')}}</span>)</span>
                            </h5>
                        </div>
                    </div>
                </div>
                @php
                    $items_cost_total = 0;
                    $items_customer_total_cost = 0;
                    $saller_profit = 0;
                    $product = \App\Models\Product::where('id', $order->cart_items[0]->product->id)->first();
                    $city = \App\Models\City::where('id', $order->city)->first();
                @endphp
                @foreach ($order->cart_items as $key=>$cart_item)
                    @php
                        $items_cost_total += $cart_item->product->cost * $cart_item->qty;
                        $items_customer_total_cost += $cart_item->product->price * $cart_item->qty;
                        $saller_profit += ($cart_item->product->price - $cart_item->product->cost) * $cart_item->qty;
                    @endphp
                    <div class="card product" data-id="{{$cart_item->product->id}}">
                        <input type="hidden" name="products[{{$key}}][id]" value="{{$cart_item->product->id}}">
                        <input type="hidden" name="products[{{$key}}][product_cost_price]" value="{{$cart_item->product->cost}}">
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-sm-auto">
                                    <div class="avatar-lg bg-light rounded p-1">
                                        <img src="{{ asset("storage/" . $cart_item->product->img)  }}" alt="" class="img-fluid d-block">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <h5 class="fs-18 text-truncate"><a href="{{ route('admin.products.show' , $cart_item->product->id) }}" class="text-body" data-id="{{$cart_item->product->id}}">{{ $cart_item->product->name}}</a></h5>
                                    <p>رمز المنتج : {{ $cart_item->product->sku }}</p>
                                    <div class="input-step">
                                        <button type="button" class="minus shadow">–</button>
                                        <input type="number" class="product-quantity" name="products[{{$key}}][qty]" value="{{$cart_item->qty}}" min="1" max="100">
                                        <button type="button" class="plus shadow">+</button>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="text-lg-end">
                                        <p class="text-muted mb-1 fs-16"> سعر التكلفة :</p>
                                        <h5 class="fs-14">$<span id="ticket_price" class="product-price">{{ $cart_item->product->cost }}</span></h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="text-lg-end">
                                        <p class="text-muted mb-1 fs-16"> سعر البيع :</p>
                                        <input type="number" class="form-control selling-price" name="products[{{$key}}][product_selling_price]" value="{{ $cart_item->product->price }}" id="selling_price"  min="{{$product->min}}" max="{{$product->max}}" onchange="updatePrice(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card body -->
                        <div class="card-footer">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <div class="d-flex flex-wrap my-n1">
                                        <div>
                                            <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill text-muted align-bottom me-1"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex align-items-center gap-2 text-muted">
                                        <div>الاجمالي :</div>
                                        <h5 class="fs-14 mb-0">$<span class="product-line-price">{{ $cart_item->product->price * $cart_item->qty }}</span></h5>
                                        <h5 class="fs-14 mb-0" style="display: none">$<span class="product-line-cost">{{ $cart_item->product->cost * $cart_item->qty }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card footer -->
                    </div>
                @endforeach
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="row gy-3">
                            <div>
                                <h3 class="mb-1">تفاصيل الشحن</h3>
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="customer_name" class="form-label fs-18">الإسم <span style="color: #ce0000">*</span></label>
                                            <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name' , $order->customer_name) }}"  id="customer_name" placeholder="أدخل الإسم" required>
                                            <div class="error"></div>
                                        </div>
                                    </div>

                                <div class="col-lg-6">
                                    <label class="form-label" for="meta-keywords-input">{{ __('models.sallers') }}</label>
                                    <select class="form-control js-example-basic-multiple" name="saller_id"   id="saller_id">
                                        <option value="{{  $order->saller_id}}">{{  $order->saller->name}}</option>
                                        <option value="" disabled> {{ __('models.sallers') }} </option>
                                        @foreach ( $sallers as $saller )
                                            <option value="{{ $saller->id }}" {{ old('saller_id') == $saller->id ? 'selected' : '' }}>{{ $saller->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('saller_id')
                                        <span class="text-danger">
                                            <small class="errorTxt">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="country" class="form-label fs-18">تشحن إلي<span style="color: #ce0000">*</span></label>
                                                <select name="country" class="form-control" id="country" required disabled>
                                                    <option value="" disabled>أختر الدولة</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->id}}" @selected($product->country_id == $country->id)>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="state" class="form-label fs-18">المدينة<span style="color: #ce0000">*</span></label>
                                                <select name="city" class="form-control" id="city" required>
                                                    <option value="{{ $order->city }}">{{ $city->name }}</option>
                                                    <option value="" disabled >أختر المدينة</option>
                                                    @foreach ($product->country->cities as $city)
                                                        <option value="{{$city->id}}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="country_code" class="form-label fs-18">رمز الدولة<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control"name="country_code" value="{{$product->country->phone_key}}" id="country_code" placeholder="رمز الدولة" required disabled>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label fs-18">رقم الهاتف<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone' , $order->phone) }}" id="phone" placeholder="أدخل رقم الهاتف" required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="website" class="form-label fs-18">اسم متجرك/صفحتك</label>
                                                <input type="text" class="form-control" name="website" value="{{ old('website' , $order->website) }}" id="website" placeholder="أدخل اسم متجرك / صفحتك">
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="address" class="form-label fs-18">العنوان<span style="color: #ce0000">*</span></label>
                                        <textarea class="form-control" name="address" id="address" placeholder="أدخل العنوان" rows="3" required>{{ old('address' , $order->address) }}</textarea>
                                        <div class="error"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="notes" class="form-label fs-18">ملاحظاتك على الطلب</label>
                                        <textarea class="form-control" name="notes" id="notes" placeholder="أدخل ملاحظاتك علي الطلب" rows="3">{{ old('notes' , $order->notes) }}</textarea>
                                        <div class="error"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-3">
                                    <button type="button" class="btn btn-danger btn-label right ms-auto nexttab" data-nexttab="pills-bill-address-tab" onclick="submitFormWithValidation()">
                                        أعتماد الطلب الان
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-4">
                <div class="sticky-side-div">
                    <div class="card">
                        <div class="card-header border-bottom-dashed">
                            <h5 class="card-title mb-0">ملخص الطلب</h5>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr class="fs-17">
                                            <td>اجمالي سعر تكلفة المنتجات :</td>
                                            <td class="text-end" id="cost-subtotal">{{ $items_cost_total }} $</td>
                                        </tr>
                                        <tr class="fs-17">
                                            <td>تكلفة شحن الطلب :</td>
                                            <td class="text-end" id="cart-shipping"><span id="shipping-value">{{$product->country->delivery}}</span> $</td>
                                        </tr>
                                        <tr class="table-active fs-17">
                                            <th>اجمالي التكلفة :</th>
                                            <td class="text-end">
                                                <span class="fw-semibold" id="cost-total">
                                                {{$items_cost_total + $product->country->delivery}} $
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="customer-cost">
                                    <h3>المبلغ المراد تحصيله من العميل</h3>
                                    <p>* بعد إضافة تكلفة الشحن</p>
                                    <h2 id="customer-cost" >{{$items_customer_total_cost + $product->country->delivery }} $</h2>
                                </div>
                            </div>
                            <!-- end table-responsive -->
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr class="fs-17">
                                            <td> تكلفة خدمات اي دروبس :</td>
                                            <td class="text-end" id="cart-subtotal">0.0 $</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="seller-profit">
                                    <h3>ارباحك من الطلب</h3>
                                    <p>* بعد خصم تكلفة خدمات اي دروبس</p>
                                    <p>مدة توصيل الطلب   1-3 أيام عمل</p>
                                    <h2 id="seller-profit">{{$saller_profit}} $</h2>
                                </div>
                            </div>
                            <hr>
                            <div class="payment-method">
                                <h4 class="title">طريقة الدفع</h4>
                                <div class="body">
                                    <p class="fs-17">الرجاء إختيار طريقة الدفع المفضلة لهذا الطلب.</p>
                                    <div class="form-check form-radio-info mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" value="cash" id="formradioRight10" checked>
                                        <label class="form-check-label" for="formradioRight10">
                                        دفع عند الاستلام
                                        </label>
                                    </div>
                                    <div class="form-check form-radio-info mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" value="wallet" id="formradioRight10">
                                        <label class="form-check-label" for="formradioRight10">
                                            الدفع من المحفظة
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end stickey -->

            </div>
        </div>
        <!-- end row -->
    </form>

    <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>هل انت متاكد ؟</h4>
                            <p class="text-muted mx-4 mb-0">هل انت متأكد من حذف المنتج من السلة ؟</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">أغلق</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-product">حذف</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('js')
    <!-- input step init -->
    <script src="{{ asset('dashboard/assets/js/pages/form-input-spin.init.js')}}"></script>
    <!-- ecommerce cart js -->
    <script src="{{ asset('dashboard/assets/js/pages/ecommerce-cart.init.js')}}"></script>
    <script>

        function remove_cart(product_id) {
            // Show loader
            $('#loader-overlay').show();

            var url = "{{ route('admin.cart.remove', ":id") }}";
            url = url.replace(':id', product_id);

            $.ajax({
                type: 'POST',
                url: url,
                data:{
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    if (response.cart_items_count == 0) {
                        window.location.href = "{{ route('admin.products.index') }}";
                    }
                    $('#loader-overlay').hide();

                    handleSuccessResponse(response);

                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);

                    $('#loader-overlay').hide();
                }
            });
        }
        function submitFormWithValidation() {
            checkProductCountry(function(success, response) {
                if (success) {
                    if(validateForm()){
                        makeCartOrder();
                    }
                } else {
                    handleErrorResponse(response);
                }
            });
        }
        function checkProductCountry(callback){
            const productIds = new Set();

            $('input[name^="products["][name$="][id]"]').each(function() {
                productIds.add($(this).val());
            });
            console.log(productIds);
            if (productIds.size > 0) {

                $('#loader-overlay').show();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.cart.check_product_country') }}",
                    contentType: "application/json",
                    data: JSON.stringify({ _token: '{{ csrf_token() }}', productIds: Array.from(productIds) }),
                    success: function(response) {
                        $('#loader-overlay').hide();
                        callback(response.success, response);
                    },
                    error: function(xhr, status, error) {
                        $('#loader-overlay').hide();
                        callback(false, { message: "Error occurred during AJAX request: " + error });
                    }
                });
            }
            console.log(productIds);
            // callback(true, { message: "Error occurred during AJAX request: "  });
        }
        function validateForm() {

            const formElem = document.getElementById('cartOrderForm');

            const validationOptions = [
                {
                    attribute: 'required',
                    isValid: input => input.value.trim() !== '',
                    errorMessage: (input, label) => `${label.textContent} مطلوب`
                }
            ];

            let firstErrorInput = null;

            const validateSingleFormGroup = formGroup => {

                const label = formGroup.querySelector('label');
                const input = formGroup.querySelector('input, select, textarea');
                const error = formGroup.querySelector('.error');

                let formGroupError = false;

                for (const option of validationOptions) {

                    if (input.hasAttribute(option.attribute) && !option.isValid(input)) {

                        error.textContent = option.errorMessage(input, label);
                        input.classList.add('is-invalid');
                        error.classList.add('invalid-feedback');

                        if (!firstErrorInput) {
                            firstErrorInput = input;
                        }

                        formGroupError = true;
                    }
                }

                if (!formGroupError) {
                    error.textContent = '';
                    input.classList.add('is-valid');
                    input.classList.remove('is-invalid');
                }
            };

            const validateAllFormGroup = formToValidate => {

                const formGroups = Array.from(formToValidate.querySelectorAll('.form-group:not(.hidden .form-group)'));

                formGroups.forEach(formGroup => {

                    validateSingleFormGroup(formGroup);

                });


            };

            validateAllFormGroup(formElem);

            if (firstErrorInput) {
                firstErrorInput.focus();
                return false;
            }

            return true;
        }
        function makeCartOrder(){

            document.getElementById('country').disabled = false;
            document.getElementById('country_code').disabled = false;

            const formData = new FormData(document.getElementById("cartOrderForm"));

            const formDataObject = {
                _token : '{{ csrf_token() }}'
            };
            formData.forEach(function(value, key){
                formDataObject[key] = value;
            });

            $('#loader-overlay').show();

            $.ajax({
                type: "POST",
                url: "{{route('admin.update-order')}}",
                data: formDataObject,
                success: function(response) {
                    $('#loader-overlay').hide();
                    if(response.success){
                        handleSuccessResponse(response);
                        window.location.href = "{{ route('admin.orders.index') }}";
                    }else{
                        document.getElementById('country').disabled = true;
                        document.getElementById('country_code').disabled = true;
                        handleErrorResponse(response);
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader-overlay').hide();
                    handleErrorResponse({ message: "Error occurred during AJAX request: " + error });
                }
            });
        }
        function handleSuccessResponse(response) {
            $('.alert-message.success p').html(response.message.replace(/\n/g, '<br>'));
            $('.alert-message.success').show();
            setTimeout(function() {
                $('.alert-message.success').hide();
            }, 2000);
        }
        function handleErrorResponse(response) {
            $('.alert-message.error p').html(response.message.replace(/\n/g, '<br>'));
            $('.alert-message.error').show();
            setTimeout(function() {
                $('.alert-message.error').hide();
            }, 2000);
        }
    </script>
@endsection
