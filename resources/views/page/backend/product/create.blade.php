<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Create Product</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                

                                
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label>Category <span style="color: red;">*</span></label>
                                            <select class="form-control  select productcategory_id" name="category_id" id="category_id" >
                                                    <option value="" disabled selected hiddden>Select Category</option>
                                                    @foreach ($category as $categores)
                                                        <option value="{{ $categores->id }}">{{ $categores->name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label>Product Name <span style="color: red;">*</span></label>
                                            <input type="text" name="name" placeholder="Enter Product name" class="product_name" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label>Price<span style="color: red;">*</span></label>
                                            <input type="text" name="price" placeholder="Enter Product Price" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea type="text" name="note" placeholder="Enter note" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            <label>Image<span style="color: red;">*</span></label>
                                            <input type="file" id="productimage" class="form-control" name="productimage"><br/><br/>
                                            <img src="#" id="category-img-tag" width="150" height="100"/>
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
