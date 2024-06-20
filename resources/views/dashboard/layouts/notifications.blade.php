

@php

        if(auth('admin')->check()){
            if(auth('admin')->user()->type == 'admin'){
                $admin_notifications= \App\Models\Notification::where('type' , 'admins')->where('read' , 0);
            }else{
                $saller = auth('admin')->user()->saller ;
                $saller_notifications= \App\Models\Notification::where('type' , 'sallers')->where('saller_id' , $saller->id)->where('read' , 0);
            }
        }else{

            $user_notifications= \App\Models\Notification::where('type' , 'users')->where('user_id' , auth()->user()->id)->where('read' , 0);
        }



@endphp



 {{--  notification  --}}
 <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <i class='bx bx-bell fs-22'></i>
        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
            @if (auth('admin')->check())

                @if (auth('admin')->user()->type == 'admin')
                    {{ $admin_notifications->count() }}
                @else
                      {{ $saller_notifications->count() }}
                @endif

            @else
              {{ $user_notifications->count() }}
            @endif
        <span class="visually-hidden">unread messages</span></span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

        <div class="dropdown-head bg-primary bg-pattern rounded-top">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                    </div>
                    <div class="col-auto dropdown-tabs">
                        <span class="badge bg-light-subtle text-body fs-13">  @if (auth('admin')->check())

                            @if (auth('admin')->user()->type == 'admin')
                                {{ $admin_notifications->count() }}
                            @else
                                  {{ $saller_notifications->count() }}
                            @endif

                        @else
                          {{ $user_notifications->count() }}
                        @endif New</span>
                    </div>
                </div>
            </div>

            <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                            All  @if (auth('admin')->check())

                            @if (auth('admin')->user()->type == 'admin')
                                {{ $admin_notifications->count() }}
                            @else
                                  {{ $saller_notifications->count() }}
                            @endif

                        @else
                          {{ $user_notifications->count() }}
                        @endif
                        </a>
                    </li>

                </ul>
            </div>

        </div>

        <div class="tab-content position-relative" id="notificationItemsTabContent">
            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">


                    @if (auth('admin')->check())

                        @if (auth('admin')->user()->type == 'admin')

                            @if ($admin_notifications->count() > 0)
                                @foreach ($admin_notifications->get() as $notification)
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $notification->product->img)}}" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="{{ route('admin.products.show' , $notification->product->id) }}" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $notification->product->name }}</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">{{ $notification->title }} 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        @else

                            @if ($saller_notifications->count() > 0)
                                @foreach ($saller_notifications->get() as $notification)
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $notification->admin->img)}}" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="{{ route('saller.orders.show' , $notification->order->id) }}" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $notification->order->code }}</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">{{ $notification->title }} 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif


                        @endif



                    @else

                        @if ($user_notifications->count() > 0)
                            @foreach ($user_notifications->get() as $notification)
                                <div class="text-reset notification-item d-block dropdown-item position-relative">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/' . $notification->product->img)}}" class="me-3 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <a href="{{ route('user.products.show' , $notification->product->id) }}" class="stretched-link">
                                                <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $notification->product->name }}</h6>
                                            </a>
                                            <div class="fs-13 text-muted">
                                                <p class="mb-1">{{ $notification->title }} 🔔.</p>
                                            </div>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-15">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                <label class="form-check-label" for="all-notification-check02"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif



                    @endif











                    <div class="my-3 text-center view-all">

                    </div>
                </div>

            </div>




            <div class="notification-actions" id="notification-actions">
                <div class="d-flex text-muted justify-content-center">
                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
