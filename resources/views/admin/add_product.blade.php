<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            @if(Session::has('meg'))
            <p class="alert alert-success">{{ Session::get('meg') }}</p>
            @endif
            <div class="card pd-20 pd-sm-40">
            
                      <h6 class="card-body-title" style="color: white">Add New Products</h6>
                      <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-layout">
                        <div class="row mg-b-25">
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" style="color: white">Product title: <span class="tx-danger">*</span></label>
                              <input class="form-control  @error('product_name')is-invalid @enderror" type="text" name="title" value="{{ old('product_name') }}"  placeholder="Product Title" style="color: white">
                              
                                @error('product_name')
                                  <span class="text-danger"></span> 
                                 @enderror
                            
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" style="color: white">Description <span class="tx-danger">*</span></label>
<<<<<<< HEAD
                              <input class="form-control @error('product_code')is-invalid @enderror" type="text" name="description" value="{{ old('product_code') }}" placeholder="Product Code" style="color: white">
=======
                              <input class="form-control @error('product_code')is-invalid @enderror" type="text" name="description" value="{{ old('product_code') }}" placeholder="Product discription" style="color: white">
>>>>>>> 99ac388 (Update code with latest changes)
                              @error('product_code')
                              <span class="text-danger"></span> 
                             @enderror
                        
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" style="color: white"> Price: <span class="tx-danger">*</span></label>
                              <input class="form-control @error('price')is-invalid @enderror" type="text" name="price" value="{{ old('price') }}"  placeholder="Product Price">
                              @error('price')
                              <span class="text-danger"></span> 
                             @enderror
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" style="color: white"> Quantity: <span class="tx-danger">*</span></label>
                              <input class="form-control @error('product_quantity')is-invalid @enderror" type="number" name="quantity" value="{{ old('product_quantity') }}"  placeholder="Product Quantity">
                              @error('product_quantity')
                              <span class="text-danger"></span> 
                              @enderror
                            </div>
                          </div><!-- col-4 -->
                         
                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                              <label class="form-control-label " style="color: white">Product Category <span class="tx-danger">*</span></label>
                            
                               
                          
                             
                              <select class="form-control select2 @error('category_id')is-invalid @enderror" name="category" placeholder="Choose Category" required>
                                
                               
                                  @foreach ( $category as  $category )
                                  <option style="color: black" value="{{$category->category_name }}">{{  $category->category_name }}</option>
                                  @endforeach
                               
                             
                               
                                
                              </select>
                             
                              <span class="text-danger"></span> 
                              
                            </div>
                          
                          
                          </div><!-- col-12 -->
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" style="color: white">Product image<span class="tx-danger">*</span></label>
                              <input class="form-control" type="file" name="image"  >
                             
                              <span class="text-danger"></span> 
                             
                            </div>
                          </div><!-- col-4 -->
                          
                        </div><!-- row -->
            
            
                        <div class="form-layout-footer">
                          <button class="btn btn-info mg-r-5">Add Product</button>
                         
                        </div><!-- form-layout-footer -->
                      </div><!-- form-layout -->
                    </div>
                  </form>
                  </div>
                
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.footer')
  </body>
</html>