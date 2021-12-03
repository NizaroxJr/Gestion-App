<x-admin-component>
@section('title')
Add order
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
         <h3><strong>Add order</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add order</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addorder" method="post" action="{{route('order.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                  <label for="product">Product</label>
                  <select  id="product" name="product" class="form-control js-example-basic-single " style="width: 100%;" required>
                    @foreach($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                  </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                  <label for="client">Client</label>
                  <select  id="client" name="client" class="form-control js-example-basic-single " style="width: 100%;" required>
                    @foreach($clients as $client)
                    <option value="{{$client->id}}">{{$client->Name}}</option>
                    @endforeach
                  </select>
                </div>
                 </div>
                   <!-- Row End-->
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Description">Order Description</label>
                    <textarea name="description" class="form-control" id="Description" rows="3"></textarea>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Quantity">Quantity</label>
                    <input type="number" name="quantity"  class="form-control" id="Quantity" min="0" placeholder="" required>
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
                    <option value="Shipped" selected="selected">Shipped</option>
                    <option value="Not Shipped">Not Shipped</option>
                    <option value="Canceled">Canceled</option>
                  </select>
                  </div>
                </div>
                 <!-- Row End-->  
                 
                 <!-- Row End--> 
                  
                </div> 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add order</button>
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
