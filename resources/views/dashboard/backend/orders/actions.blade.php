
@php
    $statuses = App\Models\Status::get();
    $order = App\Models\Order::where('id' , $id)->first();
@endphp
      @if ($order->status_id != 6)
        <a href="#" class="ri-settings-4-line" data-bs-toggle="modal" data-bs-target="#update_status{{ $id }}"><i class="ri-show-2-line"></i></a>
      @endif

        @if(auth('admin')->user()->hasPermission('orders-update'))
        <a href="{{ route('admin.orders.edit' , $id) }}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
        @endif
        <a href="{{ route('admin.orders.show' , $id) }}" class="link-info fs-15"><i class="ri-eye-2-line"></i></a>
        <a href="#" class="link-danger fs-15" data-bs-toggle="modal" data-bs-target="#deleteRecordModal{{ $id }}"><i class="ri-delete-bin-line"></i></a>



        <div class="modal fade" id="update_status{{ $id }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalgridLabel">{{ __('models.updated_status') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('admin.update-status' , $order->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row g-3">


                                <div class="col-xxl-12">
                                    <div>


                                        <select class="form-control js-example-basic-multiple"  id="status_id" name="status_id">
                                            <option value="{{ $order->status_id }}">{{ $order->status->name }}</option>
                                            <option value="" disabled>{{ __('models.status') }}</option>
                                            @foreach ( $statuses->whereNotIn('id' , [$order->status_id]) as $status )
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>




                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!--end col-->



                            </div><!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade zoomIn" id="deleteRecordModal{{ $id }}" tabindex="-1" aria-hidden="true">
            <form action="{{ route('admin.orders.destroy' , $id) }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h5 >Are you Sure You want to Remove this Record ? </h5>
                                    <p class="text-muted mx-4 mb-0">{{ $order->code }}</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn w-sm btn-danger">{{ __('models.Yes_delete') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end modal -->




