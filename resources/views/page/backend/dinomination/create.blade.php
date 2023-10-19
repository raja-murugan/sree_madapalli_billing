<form autocomplete="off" method="POST" action="{{ route('dinomination.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   
                   <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required>
                            </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $timenow }}" required>
                            </div>
                      </div>
                   </div>
                   <div class="row">


                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <label>Rupee</label>
                            <input type="text" class="rupee" name="rupee[]" id="rupee1" Value="2000" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <label>Count</label>
                            <input type="text" class="count" name="count[]" id="count1">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="determinationamount" name="amount[]" id="amount1" readonly style="background: #97a2d236;">
                         </div>
                      </div>



                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee2" Value="500" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count2">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount2" readonly style="background: #97a2d236;">
                         </div>
                      </div>



                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee3" Value="200" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count3">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount3" readonly style="background: #97a2d236;">
                         </div>
                      </div>



                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee4" Value="100" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count4">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount4" readonly style="background: #97a2d236;">
                         </div>
                      </div>




                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee5" Value="50" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count5">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount5" readonly style="background: #97a2d236;">
                         </div>
                      </div>




                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee6" Value="20" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count6">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount6" readonly style="background: #97a2d236;">
                         </div>
                      </div>




                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee7" Value="10" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count7">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount7" readonly style="background: #97a2d236;">
                         </div>
                      </div>




                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee8" Value="5" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count8">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount8" readonly style="background: #97a2d236;">
                         </div>
                      </div>





                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee9" Value="2" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count9">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount9" readonly style="background: #97a2d236;">
                         </div>
                      </div>



                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee10" Value="1" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count10">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount" name="amount[]" id="amount10" readonly style="background: #97a2d236;"> 
                         </div>
                      </div>




                      
                      <div class="col-lg-12 col-md-12 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationtotal_amount" name="total_amount" id="total_amount1" readonly style="background: #e9e549c7;text-align:right">
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