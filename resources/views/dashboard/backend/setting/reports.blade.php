@extends('dashboard.layouts.master')

@section('title')
   {{ __('models.reports') }}
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">{{ __('models.saller_rates') }}</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">

                    </div>

                    @if (isset($sallers_rated))
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">

                                        </th>
                                        <th> {{ __('models.sallers') }} </th>
                                        <th> {{ __('models.img') }} </th>
                                        <th> {{ __('models.email') }} </th>
                                        <th> {{ __('models.countries') }} </th>
                                        <th> {{ __('models.cities') }} </th>
                                        <th> {{ __('models.amount') }} </th>

                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">

                                    @foreach ($sallers_rated as $rate_saller )

                                        <tr>
                                            <th scope="row">

                                            </th>
                                            <td>{{ $rate_saller->saller->name }}</td>
                                            <td><img src="{{ $rate_saller->saller->img ? asset('storage/' . $rate_saller->saller->img ) : asset('storage/users/1.png') }}" alt="{{ $rate_saller->saller->name }}" height="50" width="50"></td>
                                            <td>{{ $rate_saller->saller->email }}</td>
                                            <td>{{ $rate_saller->saller->country->name }}</td>
                                            <td>{{ $rate_saller->saller->city->name }}</td>
                                            <td>{{ $rate_saller->saller->amount }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endif



                    @if (isset($products_rated))
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ __('models.product_rates') }}</h4>
                    </div><!-- end card header -->

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="sort">{{ __('models.products') }}</th>
                                    <th class="sort">{{ __('models.img') }}</th>
                                    <th class="sort">{{ __('models.categories') }}</th>
                                    <th class="sort">{{ __('models.countries') }}</th>
                                    <th class="sort">{{ __('models.users') }}</th>
                                    <th class="sort">{{ __('models.price') }}</th>
                                    <th class="sort">{{ __('models.stocks') }}</th>


                                </tr>
                            </thead>
                            <tbody class="list form-check-all">

                                @foreach ($products_rated as $rate_product )

                                    <tr>

                                        <td>{{ $rate_product->product->name }}</td>
                                        <td><img src="{{ asset('storage/' . $rate_product->product->img ) }}" alt="{{ $rate_product->product->name }}" height="50" width="50"></td>
                                        <td>{{ $rate_product->product->category->name }}</td>
                                        <td>{{ $rate_product->product->country->name }}</td>
                                        <td>{{ $rate_product->product->user ? $rate_product->product->user->name : $rate_product->product->admin->name }}</td>
                                        <td>{{ $rate_product->product->price }}</td>
                                        <td>{{ $rate_product->product->store->name }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @endif









            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection


