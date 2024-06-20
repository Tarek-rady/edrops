@extends('dashboard.layouts.master')

@section('title')
  {{ __('models.order_details') }}
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('models.order_details') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('models.orders') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('models.order_details') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">

            {{--  order details   --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">{{ __('models.code') }} #{{ $order->code }}</h5>

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">{{ __('models.product_details') }}</th>
                                    <th scope="col">{{ __('models.categories') }}</th>
                                    <th scope="col">{{ __('models.stocks') }}</th>
                                    <th scope="col">{{ __('models.brands') }}</th>
                                    <th scope="col">{{ __('models.cost') }}</th>
                                    <th scope="col">{{ __('models.price') }}</th>
                                    <th scope="col">{{ __('models.qty') }}</th>
                                    <th scope="col" class="text-end">{{ __('models.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ( $order->items as $item)


                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                    <img src="{{ asset('storage/' . $item->product->img) }}" alt="" class="img-fluid d-block">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-15"><a href="{{ route('admin.products.show' , $item->product_id) }}" class="link-primary">{{ $item->product->name }}</a></h5>
                                                    <div class="text-warning fs-15">
                                                        @for ($i = 1 ; $i < 6 ; $i++)
                                                            <i class="ri-star-{{ $item->product->avg_rates() >= $i ? 'fill' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ $item->product->category->name }}</td>
                                        <td> {{ $item->product->store->name }}</td>
                                        <td>{{ $item->product->brand ? $item->product->brand->name : ''}}</td>
                                        <td>${{ $item->product_cost_price }}</td>
                                        <td>${{ $item->product_selling_price }}</td>
                                        <td>{{ $item->qty }}</td>



                                        <td class="fw-medium text-end">
                                            <span class="badge bg-info-subtle text-info badge-border">${{ $item->total }}</span>
                                        </td>
                                    </tr>

                                @endforeach




                                <tr class="border-top border-top-dashed">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-medium p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td> {{ __('models.total cost') }}:</td>
                                                    <td class="text-end"><span class="badge bg-info-subtle text-info badge-border"> ${{ $order->total_products_cost }}</span></td>
                                                </tr>

                                                <tr>
                                                    <td>{{ __('models.delivery_price') }}  <span class="text-muted"></span> :</td>
                                                    <td class="text-end"><span class="badge bg-info-subtle text-info badge-border">${{ $order->shipping_tax }}</span></td>
                                                </tr>


                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">{{ __('models.amount_customer') }} :</th>
                                                    <th class="text-end"><span class="badge bg-info-subtle text-success badge-border">${{  $order->customer_total_cost }}</span></th>
                                                </tr>

                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">{{ __('models.profit_saller') }}</th>
                                                    <th class="text-end"><span class="badge bg-info-subtle text-success badge-border">${{  $order->saller_total_profit }}</span></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
            {{--  order Status  --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javasccript:void(0;)" class="btn btn-soft-info btn-sm mt-2 mt-sm-0 shadow-none"><i class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                            <a href="javasccript:void(0;)" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0 shadow-none"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">

                            @if (isset($order->date_order))
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingOne">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle shadow">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-0 fw-semibold">{{ __('models.date_order') }} - <span class="fw-normal">{{ date('D, d M Y - h:ia', strtotime($order->date_order)) }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endif

                            @if (isset($order->date_progress))
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingOne">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle shadow">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-0 fw-semibold">{{ __('models.date_progress') }} - <span class="fw-normal">{{ date('D, d M Y - h:ia', strtotime($order->date_progress)) }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endif

                            @if (isset($order->date_processing))
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingTwo">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle shadow">
                                                        <i class="mdi mdi-gift-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-1 fw-semibold">{{ __('models.date_processing') }} - <span class="fw-normal">{{ date('D, d M Y - h:ia', strtotime($order->date_processing)) }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endif

                            @if (isset($order->date_done))
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingThree">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle shadow">
                                                        <i class="ri-truck-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-1 fw-semibold">{{ __('models.date_done') }} - <span class="fw-normal">{{ date('D, d M Y - h:ia', strtotime($order->date_done)) }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endif

                            @if (isset($order->date_delivery))
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingFour">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-light text-success rounded-circle shadow">
                                                        <i class="ri-takeaway-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-1 fw-semibold">{{ __('models.date_delivery') }} - <span class="fw-normal">{{ date('D, d M Y - h:ia', strtotime($order->date_delivery)) }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if (isset($order->date_complete))
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingFive">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-light text-success rounded-circle shadow">
                                                        <i class="mdi mdi-package-variant"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-1 fw-semibold">{{ __('models.date_complete') }} - <span class="fw-normal">{{ date('D, d M Y - h:ia', strtotime($order->date_complete)) }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>


        <!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#4b38b3,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                        <h5 class="fs-16 mt-2">RQK Logistics</h5>
                        <p class="text-muted mb-0">ID: {{ $order->code }}</p>
                        <p class="text-muted mb-0">Payment Mode : {{ $order->Payment_method }}</p>
                    </div>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/users/1.png') }}" alt="" class="avatar-sm rounded shadow">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $order->customer_name}}</h6>
                                    <p class="text-muted mb-0">{{ $order->phone}}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">

                        <li>{{ $order->address }}</li>

                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('models.order_invoice') }}</h5>
                </div>
                <div class="card-body">
                    <button class="btn" style="background-color: #8280fd;color: #FFF;font-size: 18px;" onclick="printPage()">
                        <i class="ri-printer-line"></i>
                          {{ __('models.print_invoice') }}
                    </button>
                </div>
            </div>



            <!--end card-->
        </div>
        <!--end col-->
    </div>



    <div id="print-invoice" style="display:none">
            @include('dashboard.saller.orders.order_invoice')
    </div>
@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/js/preview-image.js') }}"></script>
    <script>
        function printPage() {
            var divToPrint = document.getElementById('print-invoice');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.close();
            newWin.print();
        }
    </script>
@endsection
