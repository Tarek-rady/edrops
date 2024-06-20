

@if (auth('admin')->check())

    @if (auth('admin')->user()->type == 'saller')
        @php
            $saller = auth('admin')->user()->saller;
            $cart = \App\Models\Cart::where('saller_id', $saller->id)->where('type' , 'saller')->get();
            $saller_cart_items_count = $cart ? $cart->sum('qty') : 0;

            $currency_code = \App\Models\Currency::find($saller->currency??1)->code;
        @endphp
    @else
        @php
            $admin = auth('admin')->user();
            $cart = \App\Models\Cart::where('admin_id', $admin->id)->where('type' , 'admin')->get();
            $admin_cart_items_count = $cart ? $cart->sum('qty') : 0;
            
            $currency_code = \App\Models\Currency::find($admin->currency??1);
        @endphp
    @endif
@endif
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('dashboard/assets/images/logo-dark.png') }}" alt=""
                                height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('dashboard/assets/images/logo-light.png') }}" alt=""
                                height="17">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>


            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                @if (auth('admin')->user()->type == 'saller')
                    <div class="dropdown header-item ">
                        <button type="button" class="btn" id="page-header-user-dropdown "
                            data-bs-toggle="dropdown" style="background-color: #cc0000">
                            <span class="d-flex align-items-center ">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-xl-inline-block" style="color: #FFF">العملة ({{$currency_code}})</span>
                                    </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            @foreach (\App\Models\Currency::all() as $currency)
                                <a class="dropdown-item" href="{{ route('saller.change-currency', $currency->id) }}"><span
                                    class="align-middle">{{ $currency->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>  
                @endif

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>
                @include('dashboard.layouts.notifications')

                
                @if (app()->getLocale() == 'ar')
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <a href="{{ route('language', 'en') }}"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle  shadow-none">
                            <img style="width: 30px;" src="{{ URL::asset('img/flags/us_flag.jpg') }}" alt="img">
                        </a>
                    </div>
                @else
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <a href="{{ route('language', 'ar') }}"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none">
                            <img style="width: 30px;" src="{{ URL::asset('img/flags/germany_flag.jpg') }}"
                                alt="img">
                        </a>
                    </div>
                @endif

                @if (auth('admin')->check())

                    @if (auth('admin')->user()->type == 'saller')

                        <div class="ms-1 header-item d-none d-sm-flex cart" id="cart">
                            <a type="button" href="{{ route('saller.cart.index') }}"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none">
                                <i class="ri-shopping-cart-2-line fs-22"></i>
                                <span>{{$saller_cart_items_count}}</span>
                            </a>
                        </div>
                    @else

                        <div class="ms-1 header-item d-none d-sm-flex cart" id="cart">
                            <a type="button" href="{{ route('admin.cart.index') }}"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none">
                                <i class="ri-shopping-cart-2-line fs-22"></i>
                                <span>{{$admin_cart_items_count}}</span>
                            </a>
                        </div>
                    @endif
                @endif
                <div class="dropdown ms-sm-3 header-item  ">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown "
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center ">
                            @if (auth('admin')->check())
                                <img class="rounded-circle header-profile-user"
                                    src="{{ auth('admin')->user()->img ? asset('storage/' . auth('admin')->user()->img) : asset('storage/admins/1.png') }} " alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth('admin')->user()->name }}</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ auth('admin')->user()->type == 'admin' ?  __('models.admins') :  __('models.sallers')}}</span>
                                </span>
                            @elseif(auth()->check())

                                <img class="rounded-circle header-profile-user"
                                src="{{ auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('storage/admins/1.png') }} " alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user()->name }}</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ __('models.users') }}</span>
                                </span>

                            @endif
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        @if (auth('admin')->check())
                                <h6 class="dropdown-header">Welcome {{  auth('admin')->user()->name }}!</h6>

                            @elseif(auth()->check())
                                <h6 class="dropdown-header">Welcome {{ auth()->user()->name}}!</h6>
                        @endif
                        <div class="dropdown-divider"></div>
                            @if (auth('admin')->check())
                                @if (auth('admin')->user()->type == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.admins.edit' , auth('admin')->user()->id ) }}"><i
                                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">{{ __('models.profile') }}</span></a>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">{{ __('models.logout') }}</span>
                                    </a>
                                @elseif(auth('admin')->user()->type == 'saller')
                                  <a class="dropdown-item" href="{{ route('saller.profile') }}"><i
                                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">{{ __('models.profile') }}</span></a>
                                    <a class="dropdown-item" href="{{ route('saller.logout') }}"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">{{ __('models.logout') }}</span>
                                    </a>
                                @endif
                            @elseif(auth()->check())

                                    <a class="dropdown-item" href="{{ route('user.logout') }}"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">{{ __('models.logout') }}</span>
                                    </a>

                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

