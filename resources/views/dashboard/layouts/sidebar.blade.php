<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <h1>
                    EDR<span>O</span>BS
                </h1>
                </>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <h1>
                    EDR<span>O</span>BS
                </h1>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">




                @if (auth('admin')->check())

                    @if (auth('admin')->user()->type == 'admin')

                        {{--  dashboard  --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="mdi mdi-speedometer"></i> <span
                                    data-key="t-dashboards">{{ __('models.home') }}</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.home') }}" class="nav-link" data-key="t-analytics">
                                            {{ __('models.home') }} </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        @if (auth('admin')->user()->hasPermission('roles-read'))
                            {{--  roles  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#roles" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="roles">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.roles') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="roles">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.roles.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.roles') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('roles-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.roles.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_role') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('admins-read'))
                            {{--  admins  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#admins" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="admins">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.admins') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="admins">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.admins.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.admins') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('admins-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.admins.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_admin') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('countries-read'))
                            {{--  countries  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#countries" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="countries">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.countries') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="countries">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.countries.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.countries') }} </a>
                                        </li>

                                        @if (auth('admin')->user()->hasPermission('countries-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.countries.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_country') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('cities-read'))
                            {{--  cities  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#cities" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="cities">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.cities') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="cities">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.cities.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.cities') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('cities-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.cities.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_city') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('currencies-read'))
                            {{--  currencies  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#currencies" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="currencies">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.currencies') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="currencies">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.currencies.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.currencies') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('currencies-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.currencies.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_currency') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('stocks-read'))
                            {{--  stocks  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#stocks" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="stocks">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.stocks') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="stocks">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.stocks.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.stocks') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('stocks-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.stocks.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_stock') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('sallers-read'))
                            {{--  sallers  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sallers" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sallers">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.sallers') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="sallers">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.sallers.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.sallers') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('sallers-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.sallers.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_saller') }} </a>
                                            </li>
                                        @endif


                                        <li class="nav-item">
                                            <a href="{{ route('admin.new-sallers') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.new_sallers') }} </a>
                                        </li>

                                        @if (auth('admin')->user()->hasPermission('profits-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.profits.index') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.profits') }} </a>
                                            </li>
                                        @endif


                                        @if (auth('admin')->user()->hasPermission('pulls-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.pulls.index') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.pulls') }} </a>
                                            </li>
                                        @endif


                                        @if (auth('admin')->user()->hasPermission('payout_requests-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.payouts.index') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.payouts') }} </a>
                                            </li>
                                        @endif


                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('users-read'))
                            {{--  users  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#users" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="users">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.users') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="users">
                                    <ul class="nav nav-sm flex-column">
                                        @if (auth('admin')->user()->hasPermission('users-read'))

                                            <li class="nav-item">
                                                <a href="{{ route('admin.users.index') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.users') }} </a>
                                            </li>
                                        @endif

                                        @if (auth('admin')->user()->hasPermission('users-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.users.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_user') }} </a>
                                            </li>
                                        @endif
                                        @if (auth('admin')->user()->hasPermission('users-read'))

                                            <li class="nav-item">
                                                <a href="{{ route('admin.new-users') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.new_users') }} </a>
                                            </li>
                                        @endif


                                        @if (auth('admin')->user()->hasPermission('profits-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.user-profits') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.profits') }} </a>
                                            </li>
                                        @endif


                                        @if (auth('admin')->user()->hasPermission('pulls-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.user-pulls') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.pulls') }} </a>
                                            </li>
                                        @endif


                                        @if (auth('admin')->user()->hasPermission('payout_requests-read'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.user-payouts') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.payouts') }} </a>
                                            </li>
                                        @endif



                                    </ul>
                                </div>
                            </li>
                        @endif


                        @if (auth('admin')->user()->hasPermission('categories-read'))
                            {{--  categories  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#categories" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="categories">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.categories') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="categories">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.categories.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.categories') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('categories-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.categories.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_category') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('brands-read'))
                            {{--  brands  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#brands" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="brands">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.brands') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="brands">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.brands.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.brands') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('categories-create'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.brands.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_brand') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('products-read'))

                            {{--  products  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#products" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="products">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.products') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="products">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.new-products') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.new_products') }} </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('admin.products.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.products') }} </a>
                                        </li>
                                        @if (auth('admin')->user()->hasPermission('products-created'))
                                            <li class="nav-item">
                                                <a href="{{ route('admin.products.create') }}" class="nav-link"
                                                    data-key="t-starter"> {{ __('models.add_product') }} </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif


                        @if (auth('admin')->user()->hasPermission('banners-read'))
                            {{--  banners  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#banners" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="banners">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.banners') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="banners">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.banners.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.banners') }} </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('admin.banners.create') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.add_banner') }} </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('news-read'))
                            {{--  news  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#news" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="news">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.news') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="news">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.news.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.news') }} </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('admin.news.create') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.add_new') }} </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('orders-read'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#orders" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="orders">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.orders') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="orders">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.orders.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.orders') }} </a>
                                        </li>



                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('rates-read'))
                            {{--  rates  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#rates" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="rates">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.rates') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="rates">
                                    <ul class="nav nav-sm flex-column">



                                        <li class="nav-item">
                                            <a href="{{ route('admin.rates.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.rates') }} </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('admin.rates.create') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.add_rate') }} </a>
                                        </li>



                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth('admin')->user()->hasPermission('contact_us-read'))
                            {{--  contacts  --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#contacts" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="contacts">
                                    <i class="mdi mdi-sticker-text-outline"></i> <span
                                        data-key="t-pages">{{ __('models.contacts') }}</span>
                                </a>

                                <div class="collapse menu-dropdown" id="contacts">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a href="{{ route('admin.contacts.index') }}" class="nav-link"
                                                data-key="t-starter"> {{ __('models.contacts') }} </a>
                                        </li>



                                    </ul>
                                </div>
                            </li>
                        @endif



                        {{--  setting  --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#setting" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="setting">
                                <i class="mdi mdi-sticker-text-outline"></i> <span
                                    data-key="t-pages">{{ __('models.setting') }}</span>
                            </a>

                            <div class="collapse menu-dropdown" id="setting">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{ route('admin.steps.index') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.steps') }} </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.feautures.index') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.feautures') }} </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.statics.index') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.statics') }} </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.contents.index') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.contents') }} </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.asks.index') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.asks') }} </a>
                                    </li>




                                    <li class="nav-item">
                                        <a href="{{ route('admin.setting') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.setting') }} </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{ route('admin.profits-app.index') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.profit_app') }} </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.reports') }}" class="nav-link"
                                            data-key="t-starter"> {{ __('models.reports') }} </a>
                                    </li>




                                </ul>
                            </div>
                        </li>
                    @elseif(auth('admin')->user()->type == 'saller')
                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-home-account"></span>

                                <a href="{{ route('saller.home') }}" class="nav-link" data-key="t-analytics">
                                    {{ __('models.home') }} </a>

                            </li>

                        </ul>



                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-account"></span>

                                <a href="{{ route('saller.edit-profile') }}" class="nav-link" data-key="t-starter">
                                    {{ __('models.update_profile') }} </a>
                            </li>
                        </ul>



                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-cog-box"></span>

                                <a href="{{ route('saller.products-catalog') }}" class="nav-link"
                                    data-key="t-starter"> {{ __('models.products_catalog') }} </a>
                            </li>
                        </ul>



                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-heart-box"></span>
                                <a href="{{ route('saller.products') }}" class="nav-link" data-key="t-starter">
                                    {{ __('models.my_products') }} </a>
                            </li>
                        </ul>

                        {{--  orders  --}}

                        <ul class="nav nav-sm flex-column dash2">

                            <li class="nav-item">
                                <span class="mdi mdi-format-list-checks"></span>

                                <a href="{{ route('saller.orders.index') }}" class="nav-link" data-key="t-starter">
                                    {{ __('models.orders') }} </a>
                            </li>

                        </ul>


                        {{--  رفع مجموعة طلبات  --}}

                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-inbox-arrow-up"></span>

                                <a href="{{ route('saller.bulkUploadOrders.index') }}" class="nav-link"
                                    data-key="t-starter"> رفع مجموعة طلبات </a>
                            </li>
                        </ul>



                        {{-- =====================================================================  --}}

                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-heart-box"></span>
                                <a href="{{ route('saller.profits') }}" class="nav-link" data-key="t-starter">
                                    {{ __('models.profits') }} </a>
                            </li>
                        </ul>


                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-heart-box"></span>
                                <a href="{{ route('saller.pulls') }}" class="nav-link" data-key="t-starter">
                                    {{ __('models.pulls') }} </a>
                            </li>
                        </ul>


                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-heart-box"></span>
                                <a href="{{ route('saller.payouts') }}" class="nav-link" data-key="t-starter">
                                    {{ __('models.payouts') }} </a>
                            </li>
                        </ul>


                        <ul class="nav nav-sm flex-column dash2">
                            <li class="nav-item">
                                <span class="mdi mdi-heart-box"></span>
                                <a href="{{ route('saller.wallet.index') }}" class="nav-link" data-key="t-starter">
                                    المحفظة المالية </a>
                            </li>
                        </ul>

                    @endif
                @elseif(auth()->check())


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.home') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.home') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.edit-profile') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.update_profile') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.stocks') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.stocks') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.categories') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.categories') }} </a>
                        </li>
                    </ul>

                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.brands') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.brands') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.products.index') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.products') }} </a>
                        </li>
                    </ul>

                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.new-products') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.new_products') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.user-profits') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.profits') }} </a>
                        </li>
                    </ul>

                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.user-pulls') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.pulls') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-account"></span>

                            <a href="{{ route('user.user-payouts') }}" class="nav-link" data-key="t-starter">
                                {{ __('models.payouts') }} </a>
                        </li>
                    </ul>


                    <ul class="nav nav-sm flex-column dash2">
                        <li class="nav-item">
                            <span class="mdi mdi-heart-box"></span>
                            <a href="{{ route('user.wallet.index') }}" class="nav-link" data-key="t-starter">
                                المحفظة المالية </a>
                        </li>
                    </ul>







                @endif













            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
