@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.bulk_orders') }}
@endsection
@section('css')
    <style>
        .bulk_order_buttons button{
            width: 200px;
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            text-align: center
        }
        .card .ri-close-line,
        .card .ri-add-fill{
            position: absolute;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #f06548;
            top: 10px;
            left: 10px;
            z-index: 9999;
            line-height: 30px;
            text-align: center;
            color: #FFF;
            font-size: 20px;
            cursor: pointer;
        }
        .card .delete-product{
            top: 35px;
            left: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="row align-items-center gy-3 mb-3">
                <div class="col-sm">
                    <div class="bulk_order_buttons">
                        <a href="{{asset('model/bulk_upload_orders.xlsx')}}" download="bulk upload orders.xlsx">
                            <button type="button" class="btn btn-danger">تحميل النموذج</button>
                        </a>
                        <div>
                            <button type="button" class="btn btn-success" onclick="uploadFile()">استيراد الملف</button>
                            <input type="file" id="fileInput" style="display: none;">
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="addCard(this, 'sticky-side-div', 'card')">اضافة طلب</button>
                        <button type="button" class="btn btn-info" onclick="submitFormWithValidation()">اعتماد الطلبات</button>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-md-9">
            <form action="{{route('saller.bulkUploadOrders.make_order')}}" method="POST" id="bulkUploadOrdersForm">
                <div class="sticky-side-div" id="sticky-side-div">
                    <div class="card">
                        <i class="ri-close-line" onclick="removeCard(this, '.card')"></i>
                        <div class="card-header border-bottom-dashed">
                            <h5 class="card-title mb-0 text-danger fs-18">* سوف يتم اعتماد سعر البيع بعملة دولة الطلب</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="customer_name" class="form-label fs-18">إسم العميل<span style="color: #ce0000">*</span></label>
                                            <input type="text" class="form-control" name="orders[0][customer_name]" id="customer_name" placeholder="أدخل اسم العميل هنا" value="" required>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label fs-18">رقم هاتف العميل<span style="color: #ce0000">*</span></label>
                                            <input type="text" class="form-control" name="orders[0][phone]" id="phone" placeholder="أدخل رقم هاتف العميل" required>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="country" class="form-label fs-18">تشحن إلي<span style="color: #ce0000">*</span></label>
                                            <select name="orders[0][country]" class="form-control" id="country" required onchange="handleCountryChange(this)">
                                                <option value="">أختر الدولة</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}">{{ $country->name }}</option>
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
                                            <select name="orders[0][city]" class="form-control" id="city" required>
                                                <option value="">أختر المدينة</option>
                                            </select>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="address" class="form-label fs-18">العنوان التفصيلي<span style="color: #ce0000">*</span></label>
                                            <textarea class="form-control" name="orders[0][address]" id="address" placeholder="أدخل العنوان التفصيلي هنا" rows="3" required></textarea>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="notes" class="form-label fs-18">ملاحظات الطلب</label>
                                            <textarea class="form-control" name="orders[0][notes]" id="notes" placeholder="أدخل ملاحظات الطلب هنا" rows="3"></textarea>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products" style="position: relative">
                                <h5 class="card-title mb-10 fs-22">المنتجات</h5>
                                <i class="ri-add-fill" onclick="addCard(this, 'products-div', 'product-card')"></i>
                            </div>
                            <div class="products-div" id="products-div">
                                <div class="row product-card">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="product_sku" class="form-label fs-18">Product SKU<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="orders[0][products][0][sku]" id="product_sku" placeholder="أدخل SKU هنا" value="" required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="product_selling_price" class="form-label fs-18">سعر البيع<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="orders[0][products][0][selling_price]" id="product_selling_price" placeholder="أدخل سعر البيع هنا  " required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="qty" class="form-label fs-18">الكمية<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="orders[0][products][0][qty]" id="qty" placeholder="أدخل الكمية هنا" required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <i class="ri-close-line delete-product" onclick="removeCard(this, '.product-card')"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end stickey -->
            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
<script>
    function handleCountryChange(countrySelect) {
        var countryId = countrySelect.value; 
        var parentCard = countrySelect.closest(".card");
        var cardIndex = Array.from(document.querySelectorAll('.card')).indexOf(parentCard);
        var citySelect = document.querySelector('select[name="orders[' + cardIndex + '][city]"]');
            
        var url = "{{ route('saller.country_cities', ":id") }}";
        url = url.replace(':id', countryId);

        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                citySelect.innerHTML = '<option value="">أختر المدينة</option>';
                for (var key in data) {
                    citySelect.innerHTML += '<option value="' + key + '">' + data[key] + '</option>';
                }
            },
            error: function(xhr, status, error) {
                handleErrorResponse({ message: "Error occurred during AJAX request: " + error });
            }
        });


    }
    function uploadFile() {
        document.getElementById('fileInput').click();
    }

    function createTemplate(type) {
        var template;
        if (type === "card") {
            template =  ` <div class="card">
                        <i class="ri-close-line" onclick="removeCard(this, '.card')"></i>
                        <div class="card-header border-bottom-dashed">
                            <h5 class="card-title mb-0 text-danger fs-18">* سوف يتم اعتماد سعر البيع بعملة دولة الطلب</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="customer_name" class="form-label fs-18">إسم العميل<span style="color: #ce0000">*</span></label>
                                            <input type="text" class="form-control" name="orders[0][customer_name]" id="customer_name" placeholder="أدخل اسم العميل هنا" value="" required>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label fs-18">رقم هاتف العميل<span style="color: #ce0000">*</span></label>
                                            <input type="text" class="form-control" name="orders[0][phone]" id="phone" placeholder="أدخل رقم هاتف العميل" required>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="country" class="form-label fs-18">تشحن إلي<span style="color: #ce0000">*</span></label>
                                            <select name="orders[0][country]" class="form-control" id="country" required onchange="handleCountryChange(this)">
                                                <option value="">أختر الدولة</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}">{{ $country->name }}</option>
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
                                            <select name="orders[0][city]" class="form-control" id="city" required>
                                                <option value="">أختر المدينة</option>
                                            </select>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="address" class="form-label fs-18">العنوان التفصيلي<span style="color: #ce0000">*</span></label>
                                            <textarea class="form-control" name="orders[0][address]" id="address" placeholder="أدخل العنوان التفصيلي هنا" rows="3" required></textarea>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="notes" class="form-label fs-18">ملاحظات الطلب</label>
                                            <textarea class="form-control" name="orders[0][notes]" id="notes" placeholder="أدخل ملاحظات الطلب هنا" rows="3"></textarea>
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products" style="position: relative">
                                <h5 class="card-title mb-10 fs-22">المنتجات</h5>
                                <i class="ri-add-fill" onclick="addCard(this, 'products-div', 'product-card')"></i>
                            </div>
                            <div class="products-div" id="products-div">
                                <div class="row product-card">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="product_sku" class="form-label fs-18">Product SKU<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="orders[0][products][0][sku]" id="product_sku" placeholder="أدخل SKU هنا" value="" required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="product_selling_price" class="form-label fs-18">سعر البيع<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="orders[0][products][0][selling_price]" id="product_selling_price" placeholder="أدخل سعر البيع هنا  " required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="qty" class="form-label fs-18">الكمية<span style="color: #ce0000">*</span></label>
                                                <input type="text" class="form-control" name="orders[0][products][0][qty]" id="qty" placeholder="أدخل الكمية هنا" required>
                                                <div class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <i class="ri-close-line delete-product" onclick="removeCard(this, '.product-card')"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
        } else {
            template =`<div class="row product-card">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="product_sku" class="form-label fs-18">Product SKU<span style="color: #ce0000">*</span></label>
                                    <input type="text" class="form-control" name="orders[0][products][0][sku]" id="product_sku" placeholder="أدخل SKU هنا" value="" required>
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="product_selling_price" class="form-label fs-18">سعر البيع<span style="color: #ce0000">*</span></label>
                                    <input type="text" class="form-control" name="orders[0][products][0][selling_price]" id="product_selling_price" placeholder="أدخل سعر البيع هنا  " required>
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="qty" class="form-label fs-18">الكمية<span style="color: #ce0000">*</span></label>
                                    <input type="text" class="form-control" name="orders[0][products][0][qty]" id="qty" placeholder="أدخل الكمية هنا" required>
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <i class="ri-close-line delete-product" onclick="removeCard(this, '.product-card')"></i>
                        </div>
                    </div>`;
        }
        var range = document.createRange();
        range.selectNode(document.body);
        var fragment = range.createContextualFragment(template);
        return fragment.firstElementChild;
    }

    function addCard(button, parentElem, type) {

        var originalDiv = createTemplate(type);
        var clonedDiv = originalDiv.cloneNode(true);
                
        type == "card" ? duplicateCard(clonedDiv, parentElem) : duplicateProductCard(clonedDiv, button, parentElem);

    }
        
    function duplicateProductCard(clonedDiv, button, parentElem) {
        var parentCard = button.closest(".card");
        var cardIndex = Array.from(document.querySelectorAll('.card')).indexOf(parentCard);
        var numProductCards = parentCard.querySelectorAll(".product-card").length;

        clonedDiv.querySelectorAll('input, textarea, select').forEach(function(field) {
            var nameAttr = field.getAttribute('name');
            if (nameAttr) {
                field.setAttribute('name', nameAttr.replace('orders[0][products][0]', 'orders['+cardIndex+'][products][' + numProductCards + ']'));
            }
        });

        var parentElement = button.parentElement;
        var nextElement = parentElement.nextElementSibling;
        while (nextElement && nextElement.id !== parentElem) {
            nextElement = nextElement.nextElementSibling;
        }
        nextElement.appendChild(clonedDiv);
    }

    function duplicateCard(clonedDiv, parentElem) {
        var index = document.querySelectorAll('.card').length;

        clonedDiv.querySelectorAll('input, textarea, select').forEach(function(field) {
            var nameAttr = field.getAttribute('name');
            if (nameAttr) {
                field.setAttribute('name', nameAttr.replace('orders[0]', 'orders[' + index + ']'));
            }
        });

        document.getElementById(parentElem).appendChild(clonedDiv);
    }

    function removeCard(btn, elem) {
        var parent = btn.closest(elem);

        if (parent.classList.contains(elem.replace('.', ''))) {
            var cards = parent.parentElement.querySelectorAll(elem);

            if (cards.length > 1) {
                var card = btn.closest(elem);
                card.remove();
            } else {
                var message = elem == '.card' ? 'يجب أن يحتوي النموذج على طلب واحد على الأقل' : 'يجب أن يحتوي الطلب على منتج واحد على الأقل';
                $('.alert-message.error p').text(message);
                $('.alert-message.error').show();
                setTimeout(function() {
                    $('.alert-message.error').hide();
                }, 2000);
            }
        } else {
            console.error('Parent element does not match the specified class:', elem);
        }
    }

    function handleFile(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });

            // Assuming only one sheet in the Excel file
            const sheetName = workbook.SheetNames[0];
            const worksheet = workbook.Sheets[sheetName];

            // Convert the worksheet to JSON object
            const jsonData = XLSX.utils.sheet_to_json(worksheet);

            if (jsonData.length === 0) {
                var message = 'لا يوجد طلبات داخل الملف';
                $('.alert-message.error p').text(message);
                $('.alert-message.error').show();
                setTimeout(function() {
                    $('.alert-message.error').hide();
                }, 2000);

                document.getElementById("fileInput").value = "";
                return;
            }
            
            // Check for empty Product SKU in any row
            const emptySKUIndex = jsonData.findIndex(row => !row['Product SKU']);

            if (emptySKUIndex !== -1) {
                var message = 'في جميع صفوف الملف وإعادة التحميل مرة أخري SKU يرجي التأكد من تعبئة رقم الطلب وال';
                $('.alert-message.error p').text(message);
                $('.alert-message.error').show();
                setTimeout(function() {
                    $('.alert-message.error').hide();
                }, 2000);
                document.getElementById("fileInput").value = "";
                return;
            }

            // Populate HTML fields with data from JSON
            populateFields(jsonData);
        };

        reader.readAsArrayBuffer(file);
    }

    function populateFields(data) {
        const ordersContainer = document.getElementById('sticky-side-div');
        ordersContainer.innerHTML = '';

        data.forEach((row, index) => {
            const orderHtml = `<div class="card">
                                <i class="ri-close-line" onclick="removeCard(this, '.card')"></i>
                                <div class="card-header border-bottom-dashed">
                                    <h5 class="card-title mb-0 text-danger fs-18">* سوف يتم اعتماد سعر البيع بعملة دولة الطلب</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="customer_name" class="form-label fs-18">إسم العميل<span style="color: #ce0000">*</span></label>
                                                    <input type="text" class="form-control" name="orders[${index}][customer_name]" id="customer_name" placeholder="أدخل اسم العميل هنا" value="${row['الإسم'] ?? ''}" required>
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label fs-18">رقم هاتف العميل<span style="color: #ce0000">*</span></label>
                                                    <input type="text" class="form-control" name="orders[${index}][phone]" value="${row['رقم الهاتف'] ?? ''}" id="phone" placeholder="أدخل رقم هاتف العميل" required>
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="country" class="form-label fs-18">تشحن إلي<span style="color: #ce0000">*</span></label>
                                                    <select name="orders[${index}][country]" class="form-control" id="country" required onchange="handleCountryChange(this)">
                                                        <option value="">أختر الدولة</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{$country->id}}" ${row['الدولة'] == '{{ $country->name }}' ? 'selected' : ''}>{{ $country->name }}</option>
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
                                                    <select name="orders[${index}][city]" class="form-control" id="city" required>
                                                        <option value="">أختر المدينة</option>
                                                    </select>
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label fs-18">العنوان التفصيلي<span style="color: #ce0000">*</span></label>
                                                    <textarea class="form-control" name="orders[${index}][address]"  id="address" placeholder="أدخل العنوان التفصيلي هنا" rows="3" required>${row['العنوان التفصيلى'] ?? ''}</textarea>
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="notes" class="form-label fs-18">ملاحظات الطلب</label>
                                                    <textarea class="form-control" name="orders[${index}][notes]" id="notes" placeholder="أدخل ملاحظات الطلب هنا" rows="3" required>${row['ملاحظات الطلب'] ?? ''}</textarea>
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products" style="position: relative">
                                        <h5 class="card-title mb-10 fs-22">المنتجات</h5>
                                        <i class="ri-add-fill" onclick="addCard(this, 'products-div', 'product-card')"></i>
                                    </div>
                                    <div class="products-div" id="products-div">
                                        <div class="row product-card">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="product_sku" class="form-label fs-18">Product SKU<span style="color: #ce0000">*</span></label>
                                                        <input type="text" class="form-control" name="orders[0][products][0][sku]" id="product_sku" placeholder="أدخل SKU هنا" value="" required>
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="product_selling_price" class="form-label fs-18">سعر البيع<span style="color: #ce0000">*</span></label>
                                                        <input type="text" class="form-control" name="orders[0][products][0][selling_price]" id="product_selling_price" placeholder="أدخل سعر البيع هنا  " required>
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="qty" class="form-label fs-18">الكمية<span style="color: #ce0000">*</span></label>
                                                        <input type="text" class="form-control" name="orders[0][products][0][qty]" id="qty" placeholder="أدخل الكمية هنا" required>
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <i class="ri-close-line delete-product" onclick="removeCard(this, '.product-card')"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            ordersContainer.innerHTML += orderHtml;
        });

        validateExcelData(data);
    }

    function submitFormWithValidation() {
        checkProductSku(function(success, response) {
            if(success){
                checkProductCountry(function(success, response) {
                    if(success){
                        if(validateForm()){
                            makeBulkOrder();
                        }
                    }else{
                        handleErrorResponse(response);
                    }
                });

            }else{
                handleErrorResponse(response);
            }
        });
    }

    function checkProductSku(callback){
        const productSKUs = new Set();

        $('input[name*="[products]"][name$="[sku]"]').each(function() {
            productSKUs.add($(this).val());
        });

        if (productSKUs.size > 0) {

            $('#loader-overlay').show();

            $.ajax({
                type: "POST",
                url: "{{ route('saller.bulkUploadOrders.check_product_sku') }}",
                contentType: "application/json",
                data: JSON.stringify({ _token: '{{ csrf_token() }}', skus: Array.from(productSKUs) }),
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
        // callback(true, { message: "Error occurred during AJAX request: "  }); 
    }

    function checkProductCountry(callback){
        const productCards = document.querySelectorAll('.products-div');
        const orders = [];

        productCards.forEach((card, orderIndex) => {
            const products = [];
            const productInputs = card.querySelectorAll('input[name$="[sku]"]');

            productInputs.forEach((input) => {
                const sku = input.value;
                products.push(sku);
            });


            orders.push({ products });
            
        });

        // return orders;

        $('#loader-overlay').show();

        $.ajax({
            type: "POST",
            url: "{{ route('saller.bulkUploadOrders.check_product_country') }}",
            contentType: "application/json",
            data: JSON.stringify({ _token: '{{ csrf_token() }}', orders: orders }),
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
    function makeBulkOrder(){
                    
        const formData = new FormData(document.getElementById("bulkUploadOrdersForm"));

        const formDataObject = {
            _token : '{{ csrf_token() }}'
        };
        formData.forEach(function(value, key){
            formDataObject[key] = value;
        });

        $('#loader-overlay').show();

        $.ajax({
            type: "POST",
            url: "{{ route('saller.bulkUploadOrders.make_order') }}",
            data: formDataObject,
            success: function(response) {
                $('#loader-overlay').hide();
                if(response.success){
                    handleSuccessResponse(response);
                    window.location.href = "{{ route('saller.orders.index') }}";
                }else{
                    handleErrorResponse(response);
                }
            },
            error: function(xhr, status, error) {
                $('#loader-overlay').hide();
                handleErrorResponse({ message: "Error occurred during AJAX request: " + error });
            }
        });
    }
 
    function validateForm() {

        const formElem = document.getElementById('bulkUploadOrdersForm');

        const validationOptions = [
            {
                attribute: 'required',
                isValid: input => input.value.trim() !== '',
                errorMessage: (input, label) => `${label.textContent} مطلوب`
            }
        ];
        let errors = 0;
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

                    formGroupError = true;
                }
            }

            if (!formGroupError) {
                error.textContent = '';
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            } else {
                errors++;
            }
        };

        const validateAllFormGroup = formToValidate => {

            const formGroups = Array.from(formToValidate.querySelectorAll('.form-group:not(.hidden .form-group)'));
            
            formGroups.forEach(formGroup => {

                validateSingleFormGroup(formGroup);

            });


        };

        validateAllFormGroup(formElem);

        if (errors == 0)
            return true;

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
    document.getElementById('fileInput').addEventListener('change', handleFile);
</script>
@endsection
