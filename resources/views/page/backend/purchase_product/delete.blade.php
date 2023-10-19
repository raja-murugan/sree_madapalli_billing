<div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="productdeleteLargeModalLabel{{ $Purchaseproduct_data->unique_key }}">
                Delete</h5>
        </div>
        <div class="modal-body px-4 py-5 text-center">
            <h5>Are your Sure ?</h5>
            <p class="text-muted font-size-16 mb-4">You won't be able to revert this!</p>

            <div class="hstack gap-2 justify-content-center mb-0">
                <form autocomplete="off" method="POST"
                    action="{{ route('purchase_product.delete', ['unique_key' => $Purchaseproduct_data->unique_key]) }}">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                </form>
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
