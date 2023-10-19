<form autocomplete="off" method="POST" action="{{ route('openaccount.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required>
                            </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="amount" name="amount" id="amount" placeholder="Enter Amount">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Note</label>
                            <input type="text" class="note" name="note" id="note" placeholder="Enter Notes">
                         </div>
                      </div>
                   </div>
                   <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit">Save</button>
                    </div>
             </div>
          </div>
       </div>
    </form>