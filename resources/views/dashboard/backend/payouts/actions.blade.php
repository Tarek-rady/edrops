
@php
    $payout = App\Models\PayoutRequest::where('id' , $id)->first();
@endphp

@if ($payout->status != 'accept')

    <td>
        <a href="#" class="ri-settings-4-line icon1" data-bs-toggle="modal" data-bs-target="#update_status{{ $id }}"><i class="ri-show-2-line"></i></a>

    </td>
@endif


<div class="modal fade" id="update_status{{ $id }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">{{ __('models.updated_status') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.payouts.update' , $payout->id) }}" method="POST">
                    @method('PUT')
                    @csrf


                    <div class="row g-3">


                        <div class="col-xxl-12">
                            <div>

                                <select class="form-control js-example-basic-multiple"  id="status" name="status">
                                    <option value="{{ $payout->status }}" >{{ $payout->status }}</option>
                                    <option value="" disabled>{{ __('models.status') }}</option>
                                    <option value="accept">accept</option>
                                    <option value="rejection">rejection</option>

                                </select>



                            </div>
                        </div>




                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('models.close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('models.save') }}</button>
                            </div>
                        </div><!--end col-->



                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

