<div class="modal-dialog modal-x">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">

<form autocomplete="off" method="POST" action="{{ route('dinomination.edit', ['unique_key' => $datas['unique_key']]) }}">
                @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   
                   <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $datas['date'] }}" required>
                            </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $datas['time'] }}" required>
                            </div>
                      </div>
                   </div>
                   <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <label>Rupee</label>
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <label>Count</label>
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <label>Amount</label>
                         </div>
                      </div>

                   @foreach ($datas['terms'] as $index => $term_arr)
                     @if ($term_arr['determination_id'] == $datas['id'])
                      <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="form-group">
                            <input type="text" class="rupee" name="rupee[]" id="rupee{{$term_arr['determination_id']}}{{$term_arr['id']}}" value="{{$term_arr['rupee']}}" readonly style="background: bisque;">
                         </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3">
                         <div class="form-group">
                            <input type="text" class="count" name="count[]" id="count{{$term_arr['determination_id']}}{{$term_arr['id']}}" value="{{$term_arr['count']}}">
                         </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationamount{{$term_arr['determination_id']}}" name="amount[]" id="amount{{$term_arr['determination_id']}}{{$term_arr['id']}}" value="{{$term_arr['amount']}}" readonly style="background: #97a2d236;">
                         </div>
                      </div>


                      <script> 
                    $(document).ready(function() {
                        $('.determinationedit' + {{ $term_arr['determination_id'] }}).each(function() {
                            $(this).on('click', function(e) {
                                
                                e.preventDefault();
                                var $this = $(this),
                                outdoor_id = $this.attr('data-id');
                                //alert(booking_id);


                                $(document).on("keyup", '#count' + {{ $term_arr['determination_id'] }}{{ $term_arr['id'] }}, function() {
                                    var count = $(this).val();
                                    
                                    var rupee = $('#rupee' + {{ $term_arr['determination_id'] }}{{ $term_arr['id'] }}).val();
                                    console.log(rupee);

                                    var total = count * rupee;
                                    $('#amount' + {{ $term_arr['determination_id'] }}{{ $term_arr['id'] }}).val(total);


                                    var sum = 0;
                                    $('.determinationamount' + {{ $term_arr['determination_id'] }}).each(function(){
                                          sum += +$(this).val();
                                    });

                                    $('#total_amount' + {{ $datas['id'] }}).val(sum);
                                });
                            });
                        });
                    });
                </script>
                      @endif
                    @endforeach



                    






                      
                      <div class="col-lg-12 col-md-12 col-sm-5">
                         <div class="form-group">
                            <input type="text" class="determinationtotal_amount" name="total_amount" value="{{$datas['total_amount']}}" id="total_amount{{$datas['id']}}" readonly style="background: #e9e549c7;text-align:right">
                         </div>
                      </div>
                      
                   </div>


                   <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit">Save</button>
                        <a href="{{ route('dinomination.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
             </div>
          </div>
       </div>
    </form>

    
    </div>
    </div>
</div>