<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Create Employee</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('employee.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" placeholder="Enter Employee name" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone Number<span style="color: red;">*</span></label>
                            <input type="text" name="phone_number" class="employee_contactno" onkeyup="employeecheck(); return false;"  placeholder="Enter Phone Number" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address<span style="color: red;">*</span></label>
                            <input type="text" name="address" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>One Day Salary<span style="color: red;">*</span></label>
                            <input type="text" name="perdaysalary" placeholder="Per Day salary">
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
