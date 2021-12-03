<x-admin-component>
@section('title')
Add product
@stop

@section('CustomStyles')
<link href="{{asset('plugins/tags/tagsinput.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Add product</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addproduct" method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="productName">product Name*</label>
                    <input type="text" name="name" class="form-control" id="productName" placeholder="Enter product Name"  required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Quantity">Quantity</label>
                    <input type="number" name="quantity"  class="form-control" id="Quantity" placeholder="" required>
                  </div>
                 <!-- Row End-->
                </div> 
                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Price">Price</label>
                    <input type="number" name="price"  class="form-control" id="Price" placeholder="" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Status">Status</label>
                    <select  id="status" name="status" class="form-control select2" style="width: 100%;" required>
                    <option value="In Stock" selected="selected">In Stock</option>
                    <option value="Out Of Stock">Out Of Stock</option>
                  </select>
                  </div>
                </div>
                 <!-- Row End-->  
                 <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="tag">Tags</label>
                    <input data-role="tagsinput" type="text" name="tags"  class="form-control" id="tag" placeholder="" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                  <label for="supplier">Supplier</label>
                  <select  id="supplier" name="supplier" class="form-control js-example-basic-single " style="width: 100%;" required>
                    @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
                 <!-- Row End-->  
                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="img">Add Image</label>
                    <input type="file" id="img" name="img" accept="image/png, image/jpeg" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                  <label for="category">Category</label>
                  <select  id="category" name="category" class="form-control js-example-basic-single " style="width: 100%;" required>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                  
                </div>
                 <!-- Row End--> 
                  <div class="form-group">
                    <label for="Description">product Description</label>
                    <textarea name="description" class="form-control" id="Description" rows="3"></textarea>
                  </div>
                </div> 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add product</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
@stop

@section('CustomScripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"

        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"

        crossorigin="anonymous">

</script>

<script src="{{asset('plugins/tags/tagsinput.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@stop

</x-admin-component>
