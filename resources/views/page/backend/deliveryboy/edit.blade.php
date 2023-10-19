<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('delivery.boy.edit', ['unique_key' => $deliveryboydata->unique_key]) }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" placeholder="Enter name" required value="{{ $deliveryboydata->name }}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone Number <span style="color: red;">*</span></label>
                            <input type="text" name="phone_number" placeholder="Enter phone number" required value="{{ $deliveryboydata->phone_number }}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Delivery Area <span style="color: red;">*</span></label>
                            <select class="select" name="delivery_area_id" required>
                                <option value="" disabled selected hidden>
                                    Choose Delivery Area</option>
                                @foreach ($deliveryarea as $deliveryareas)
                                    <option value="{{ $deliveryareas->id }}" @if ($deliveryareas->id === $deliveryboydata->delivery_area_id) selected='selected' @endif>{{ $deliveryareas->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea type="text" name="address" placeholder="Enter address">{{ $deliveryboydata->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Per Shift Salary <span style="color: red;">*</span></label>
                            <input type="text" name="pershiftsalary" placeholder="Per Shift Salary " required value="{{ $deliveryboydata->pershiftsalary }}">
                        </div>
                    </div>
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
