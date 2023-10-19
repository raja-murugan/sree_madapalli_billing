<form autocomplete="off" method="POST" action="{{ route('outdoor_product.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                  
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="name" placeholder="Enter Product Name">
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