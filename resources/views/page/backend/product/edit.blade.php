<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('product.edit', ['unique_key' => $Productdatas['unique_key']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Category <span style="color: red;">*</span></label>
                              <select class="form-control  select productcategory_id" name="category_id" id="category_id" required>
                                    <option value="" disabled selected hiddden>Select Category</option>
                                    @foreach ($category as $categores)
                                        <option value="{{ $categores->id }}"@if ($categores->id === $Productdatas['category_id']) selected='selected' @endif>{{ $categores->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Product Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" placeholder="Enter Product name" class="product_name" value="{{ $Productdatas['name'] }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Price<span style="color: red;">*</span></label>
                            <input type="text" name="price" placeholder="Enter Product Price" value="{{ $Productdatas['price'] }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Note</label>
                            <textarea type="text" name="note" placeholder="Enter note" >{{ $Productdatas['note'] }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Image<span style="color: red;">*</span></label>
                            <input type="file" id="" class="form-control" name="productimage"><br/><br/>
                            @if ($Productdatas['image'] != "")
                            <img src="{{ asset('assets/product/' .$Productdatas['image']) }}" alt="" width="150" height="100">
                            @endif
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
