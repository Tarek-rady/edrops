@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.wallet') }}
@endsection
@section('css')
    <style>
        .wallet-card{
            background-color: #FFF;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #DDD
        }
        .seller-profile .total-withdrawal-amount{
            background-color: #DDD;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-top: 10px;
        }
        .seller-profile .total-withdrawal-amount h2{
            font-size: 30px;
        }
        .seller-profile .total-withdrawal-amount p{
            font-weight: bold;
            font-size: 20px;
            color: #ce0000;
        }
        .seller-wallet{
            padding: 10px 10px 30px;
        }
        .seller-wallet .title{
            border-bottom: 5px solid #ce0000;
        }
        .seller-wallet .check-sign{
            text-align: center;
            margin-top: 15px;
        }
        .seller-wallet .check-sign i{
            font-size: 40px;
            color: green;
        }
        .seller-wallet .balance{
            margin-top: 15px;
            text-align: center;
        }
        .seller-wallet .balance h2{
            font-size: 30px;
        }
        .seller-wallet .balance p{
            font-weight: bold;
            font-size: 20px;
            color: #61cb93;
        }
        .balance-withdrawal{
            text-align: center
        }
        .balance-withdrawal .withdraw-button{
            margin-top: 10px;
            border: 1px solid #ce0000;
            background-color: #FFF;
            color: #ce0000;
            padding: 5px 10px;
            font-size: 18px
        }
        .balance-withdrawal .withdraw-button:hover{
            background-color: #ce0000;
            color: #FFF
        }
        .payment-methods {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .payment-method {
            text-align: center;
            cursor: pointer;
            padding: 10px
        }
        .payment-method:first-child {
            margin-left: 5px;
        }

        .payment-method:last-child {
            margin-right: 5px;
        }

        .payment-method input[type="radio"] {
            display: none;
        }

        .payment-method .icon {
            margin-bottom: 5px;
        }

        .payment-method.selected {
            background-color: #ce0000;
            color: #FFF
        }
        .input-fields {
            display: none;
        }

        .input-fields.active {
            display: block;
        }
        .payout-form .input-fields .form-group{
            margin-bottom: 10px
        }
        .payout-form .input-fields label{
            display: block;
            text-align:right;
            font-size: 20px;
            font-weight: 500
        }
        #overlay{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 9999;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div id="overlay"></div>
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>
    <div class="row align-items-center gy-3 mb-3">
        <div class="col-sm">
            <div>
                <h5 class="fs-20 mb-0">
                    المحفظة المالية
                </h5>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="wallet-card seller-profile">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="image">
                            <img src="{{ $seller->img ? asset('storage') . '/' . $seller->img : asset('storage/users/1.png')}}" alt="seller image" style="width:200px;height:200px">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="seller-data">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr class="fs-17">
                                            <td>الإسم</td>
                                            <td class="text-start">{{ $seller->name }}</td>
                                        </tr>
                                        <tr class="fs-17">
                                            <td>رقم الهاتف</td>
                                            <td class="text-start">{{ $seller->phone }}</td>
                                        </tr>
                                        <tr class="fs-17">
                                            <td>البريد الإلكتروني</td>
                                            <td class="text-start">{{ $seller->email}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-withdrawal-amount">
                                <h2>إجمالي المبالغ المسحوبة</h2>
                                <p>
                                    {{ $seller->sum_pull()}} 
                                    {{ \App\Models\Currency::find($seller->currency)->code ?? '$'}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
            <div class="wallet-card seller-wallet">
                <div class="title">
                    <h3>
                        <i class="ri-wallet-fill"></i>
                        المحفظة المالية
                    </h3>
                </div>
                <div class="check-sign">
                    <i class="ri-checkbox-circle-fill"></i>
                </div>
                <div class="balance">
                    <h2>إجمالي الرصيد المتاح</h2>
                    <p>
                        {{ $seller->amount }} 
                        {{ \App\Models\Currency::find($seller->currency)->code ?? '$'}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8">

        </div>
        <!-- end col -->
        <div class="col-md-4">
            <div class="wallet-card balance-withdrawal">
                <h2>سحب الرصيد</h2>
                <p class="fs-20" style="color: #ce0000">يجب ان تكون عملية السحب بالدولار الامريكي</p>
                <p class="fs-16" style="color: green">أقل مبلغ للسحب هو 10 $</p>
                <input type="number" step="1" id="amountInput" name="amount" class="form-control" placeholder="أدخل المبلغ المراد سحبه" autocomplete="off" oninput="removeErrorMessage()">
                <button type="submit" class="withdraw-button" onclick="checkAmount()">سحب</button>
                <div id="payoutRequestModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal" onclick="closeModal()"></button>
                            </div>
                            <div class="modal-body">
                                <h2 class="mb-5">أختر طريقة السحب</h2>
                                <div class="payout-form">
                                    <form id="payout-form">
                                        <div class="payment-methods">
                                            <label class="payment-method selected">
                                                <input type="radio" name="method" value="bank" onclick="togglePayment(this, 'bankInputFields')" checked>
                                                <div class="icon">
                                                    <img src="{{asset('img/bank-account.png')}}"  alt="Bank Icon">
                                                </div>
                                                <div class="text fs-16">حساب بنكي</div>
                                            </label>

                                            <label class="payment-method">
                                                <input type="radio" name="method" value="wallet" onclick="togglePayment(this, 'walletInputFields')">
                                                <div class="icon"><img src="{{asset('img/e-wallet.png')}}"  alt="Bank Icon"></div>
                                                <div class="text fs-16">محفظة إلكترونية</div>
                                            </label>

                                            <label class="payment-method">
                                                <input type="radio" name="method" value="western_union" onclick="togglePayment(this, 'westernUnionInputFields')">
                                                <div class="icon"><img src="{{asset('img/western-union.png')}}"  alt="Bank Icon"></div>
                                                <div class="text fs-16">ويسترن يونيون</div>
                                            </label>
                                        </div>

                                        <div id="bankInputFields" class="input-fields active">
                                            <h3>تأخذ رسوم تحويل مزود الخدمة فقط</h3>
                                            <div class="form-group">
                                                <label>اسم صاحب الحساب</label>
                                                <input type="text" name="account_holder_name" class="form-control" placeholder="أدخل إسم صاحب الحساب هنا">
                                            </div>
                                            <div class="form-group">
                                                <label>رقم IBAN</label>
                                                <input type="text" name="iban" class="form-control" placeholder="أدخل رقم IBAN هنا">
                                            </div>
                                            <div class="form-group">
                                                <label>رمز السويفت كود</label>
                                                <input type="text" name="swift_code" class="form-control" placeholder="أدخل رمز السويفت كود هنا">
                                            </div>
                                        </div>

                                        <div id="walletInputFields" class="input-fields">
                                            <h3>تأخذ رسوم تحويل مزود الخدمة فقط</h3>
                                            <div class="form-group">
                                                <label>اسم المحفظة</label>
                                                <select class="form-control" name="wallet_name">
                                                    <option value="">أختر محفظة</option>
                                                    @foreach ($wallets as $wallet)
                                                        <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>رقم المحفظة</label>
                                                <input type="text" name="wallet_no" class="form-control" placeholder="أدخل رقم المحفظة هنا">
                                            </div>
                                        </div>

                                        <div id="westernUnionInputFields" class="input-fields">
                                            <h3>تأخذ رسوم تحويل مزود الخدمة فقط</h3>
                                            <div class="form-group">
                                                <label>الإسم باللغة الانجليزية</label>
                                                <input type="text" name="english_name" class="form-control" placeholder="أدخل الإسم باللغة الانجليزية">
                                            </div>
                                            <div class="form-group">
                                                <label>رقم الجوال</label>
                                                <input type="text" name="phone" class="form-control" placeholder="أدخل رقم الجوال هنا">
                                            </div>
                                            <div class="form-group">
                                                <label>الدولة</label>
                                                <input type="text" name="country" class="form-control" placeholder="أدخل الدولة هنا">
                                            </div>
                                            <div class="form-group">
                                                <label>المدينة</label>
                                                <input type="text" name="city" class="form-control" placeholder="أدخل المدينة هنا">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex gap-2 mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-danger rounded-pill  fs-18" onclick="submitForm()">تقديم طلب السحب</button>
                                    <button type="button" class="btn w-sm btn-light rounded-pill  fs-18" data-bs-dismiss="modal" onclick="closeModal()">إلغاء</button>
                                </div>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')

    <script>
        function closeModal() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById("payoutRequestModal").classList.remove("show");
            document.getElementById("payoutRequestModal").style.display = "none";
            document.body.classList.remove("modal-open");
        }
        function removeErrorMessage() {
            var errorDiv = document.querySelector("#amountInput + .text-danger");
            if (errorDiv) {
                errorDiv.remove();
            }
        }
        function checkAmount() {
            var amountInput = document.getElementById("amountInput");
            var amount = parseFloat(amountInput.value);
            var seller_balance = {{ $seller->amount }};

            if (amount >= 10 && amount <= seller_balance) {
                document.getElementById('overlay').style.display = 'block';
                document.getElementById("payoutRequestModal").classList.add("show");
                document.getElementById("payoutRequestModal").style.display = "block";
                document.getElementById('payoutRequestModal').style.zIndex = "99999";
                document.body.classList.add("modal-open");
            } else {
                var message = !amountInput.value.trim() ? 'هذا الحقل مطلوب' : (amount < 10 ? "يجب ان تكون القيمة المطلوبة اكبر من 10 دنانير" : "رصيدك غير كاف");
                var errorDiv = document.createElement("div");
                errorDiv.classList.add("text-danger");
                errorDiv.style.fontSize = "16px";
                errorDiv.style.fontWeight = "600";
                errorDiv.style.color = "#ce0000";
                errorDiv.textContent = message;
                document.getElementById("amountInput").insertAdjacentElement("afterend", errorDiv);
            }
        }
        function togglePayment(input, paymentMethod) {
            // Highlight the selected payment method
            document.querySelectorAll('.payment-method').forEach(label => {
                label.classList.remove('selected');
            });

            input.closest('.payment-method').classList.add('selected');

            // Toggle the input fields
            document.querySelectorAll('.input-fields').forEach(fields => {
                fields.classList.remove('active');
            });

            document.getElementById(paymentMethod).classList.add('active');
        }

        function submitForm(){

            var amount = parseFloat(document.getElementById("amountInput").value);

            // Get form data
            const formData = new FormData(document.getElementById("payout-form"));
            // Convert form data to object
            const formDataObject = {
                'amount' : amount,
                _token : '{{ csrf_token() }}'
            };
            formData.forEach(function(value, key){
                formDataObject[key] = value;
            });

             $('#loader-overlay').show();

            $.ajax({
                type: 'POST',
                url: "{{ route('saller.wallet.make_payout_request') }}",
                data: formDataObject,
                success: function(response) {
                    // Hide loader
                    $('#loader-overlay').hide();
                    if(response.success){
                        handleSuccessResponse(response);
                        window.location.href = "{{ route('saller.wallet.index') }}";
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
