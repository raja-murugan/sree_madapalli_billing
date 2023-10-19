<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Create Product Session</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('productsession.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Product <span style="color: red;">*</span></label>
                            <select class="form-control  select product_id" name="product_id" id="product_id" >
                                 <option value="" disabled selected hiddden>Select Product</option>
                                 @foreach ($product_Arr as $product_Arrs)
                                    <option value="{{ $product_Arrs['id'] }}">{{ $product_Arrs['name'] }}</option>
                                 @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">

                        <div class="select-split ">
                            <div class="select-group w-100">
                            <label>Session <span style="color: red;">*</span></label>
                                <div style="display: flex">
                                    @foreach ($session as $sessions)
                                        <div class="input-group" style="margin-right: 5px;">
                                            <div class="input-group-text">
                                                <input class="form-check-input" type="checkbox" value="{{ $sessions->id }}" id="session_id"  name="session_ids[]"   aria-label="Checkbox for following text input">
                                            </div>
                                            <input type="text" class="form-control" value="{{ $sessions->name }}" readonly style="background: white;" aria-label="Text input with checkbox">

                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Save</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
