<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('productsession.edit', ['id' => $Productdatas['id']]) }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Product <span style="color: red;">*</span></label>
                            <select class="form-control  select product_id" name="product_id" id="product_id" disabled>
                                    <option value="" disabled selected hiddden>Select Product</option>
                                    @foreach ($Product as $Products)
                                        <option value="{{ $Products->id }}"@if ($Products->id === $Productdatas['id']) selected='selected' @endif>{{ $Products->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    

                       
                        <div class="col-lg-12 col-sm-12 col-12">
                        <label>Session <span style="color: red;">*</span></label>
                            <div style="display: flex;margin-bottom: 34px;">
                                @foreach ($Productdatas['terms'] as $index => $terms_array)
                                    @if ($terms_array['product_id'] == $Productdatas['id'])

                                        
                                        <div class="input-group produtseesiondiv" style="margin-right: 5px;height: 37px;">
                                            <div class="input-group-text" style="background: #dc3545;padding: 0px;">
                                                <button style="width: 10px;" class="text-white py-1 font-medium rounded-lg text-sm  text-center btn btn-danger remove-produtseesiondiv" type="button" >-</button>
                                                <input type="hidden" name="productsession_id[]" id="productsession_id" value="{{$terms_array['id']}}" />
                                            </div>
                                            <select class="form-control  select session_id" name="session_id[]" id="session_id" >
                                                <option value="" disabled selected hiddden>Select Session</option>
                                                @foreach ($session as $sessions)
                                                    <option value="{{ $sessions->id }}"@if ($sessions->id === $terms_array['session_id']) selected='selected' @endif>{{ $sessions->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach

                               
                                        <div class="input-group produtseesiondiv" style="margin-right: 5px;height: 37px;">
                                        
                                            <div class="input-group-text" style="background: #dc3545;padding: 0px;">
                                            <button style="width: 10px;" class="text-white py-1 font-medium rounded-lg text-sm  text-center btn btn-danger remove-produtseesiondiv" type="button" >-</button>
                                            <input type="hidden" name="productsession_id[]" id="productsession_id" value="" />
                                            </div>
                                            <select class="form-control  select session_id" name="session_id[]" id="session_id" >
                                                <option value="" disabled selected hiddden>Select Session</option>
                                                @foreach ($session as $sessions)
                                                    <option value="{{ $sessions->id }}">{{ $sessions->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                               
                            </div>
                        </div>

                       <br/><br/><br/>
                       
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
