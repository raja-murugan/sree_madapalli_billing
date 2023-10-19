<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Check Leave - ({{$date}})</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('emp_attendance.dayedit', ['date' => $date]) }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Leave <span style="color: red;">*</span></label>
                                                <div style="display: flex">
                                                    <div class="input-group" style="margin-right: 5px;">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="1" id="checkleave" name="checkleave"
                                                                aria-label="Radio button for following text input" >
                                                        </div>
                                                        <input type="text" class="form-control" value="Yes" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 5px;" hidden>
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="0" id="checkleave" name="checkleave"
                                                                aria-label="Radio button for following text input">
                                                        </div>
                                                        <input type="text" class="form-control" value="No" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                </div>
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
