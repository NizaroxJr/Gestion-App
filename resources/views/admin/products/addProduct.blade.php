<x-admin-component>
@section('title')
Add Product
@stop


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Add Product</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addProduct">
                <div class="card-body">
                  <div class="form-group">
                    <label for="ProductName">Product Name*</label>
                    <input type="text" name="name" class="form-control" id="ProductName" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="Quantity">Quantity</label>
                    <input type="number" name="quantity"  class="form-control" id="Quantity" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="Price">Price</label>
                    <input type="number" name="price"  class="form-control" id="Price" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="Status">Status</label>
                    <input type="text" name="status"  class="form-control" id="Status" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="tag">Tags</label>
                    <input type="text" name="tag"  class="form-control" id="tag" placeholder="">
                  </div>
                  <div class="form-group">
                  <label for="supplier">Supplier</label>
                  <select id="supplier" name="supplier" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                  </select>
                </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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


</x-admin-component>
