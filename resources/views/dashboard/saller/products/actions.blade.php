<td>
    <div class="hstack gap-2 flex-wrap">
        <a href="{{ route('saller.products.show' , $id) }}" class="link-info fs-15 icon2"><i class="ri-eye-2-line"></i></a>
        <a href="#" class="link-info fs-15 icon2" onclick="add_cart('{{$id}}')"><i class="ri-shopping-cart-2-line"></i></a>
        <a href="#" class="link-danger fs-15 icon4" data-bs-toggle="modal" data-bs-target="#deleteRecordModal{{ $id }}"><i class="ri-delete-bin-line"></i></a>

    </div>
</td>


@php
    $product_saller = App\Models\SallerProduct::where('id' , $id)->where('type' , 'fav')->first();

@endphp


<!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal{{ $id }}" tabindex="-1" aria-hidden="true">
        <form action="{{ route('saller.delete-product' , $id) }}" method="POST">
            @method('GET')

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
                                <h5 >{{ __('models.delete_record') }}  </h5>
                                <p class="text-muted mx-4 mb-0"></p>
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

