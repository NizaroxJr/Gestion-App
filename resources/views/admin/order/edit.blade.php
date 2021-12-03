<x-admin-component>
@section('title')
Edit order
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
         <h3><strong>Edit order</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Order</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="Editorder" method="post" action="{{route('order.update',$order->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Price">Price</label>
                    <input type="number" name="price"  class="form-control" id="Price" value="{{$order->price}}" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Quantity">Quantity</label>
                    <input type="number" name="quantity"  class="form-control" id="Quantity" value="{{$order->quantity}}" required>
                  </div>
                 <!-- Row End-->
                </div> 
                <div class="form-row">
                     <!-- Row Start-->
                  
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Status">Status</label>
                    <select  id="status" name="status" class="form-control select2" style="width: 100%;" required>
                    @if($order->status == "Shipped")
                    <option value="Shipped" selected="selected">Shipped</option>
                    <option value="Not Shipped">Out Of Stock</option>
                    <option value="Cancelled">Cancelled</option>
                     @elseif($order->status == "Not Shipped")
                    <option value="Shipped" >Shipped</option>
                    <option value="Not Shipped" selected="selected">Out Of Stock</option>
                    <option value="Cancelled">Cancelled</option>
                    @else
                    <option value="Shipped" selected="selected">Shipped</option>
                    <option value="Not Shipped">Out Of Stock</option>
                    <option value="Cancelled" selected="selected">Cancelled</option>
                    @endif  
                </select>
                  </div>
                </div>
                 <!-- Row End-->  
                 <div class="form-row">
                     <!-- Row Start-->
                  
                  <div class="form-group col-lg-6 col-md-12">
                  <label for="product">Product</label>
                  <select  id="product" name="product" class="form-control js-example-basic-single" style="width: 100%;" required>
                    @foreach($products as $product)
                    @if( $product->name == $order->product->name)
                    <option value="{{$product->id}}" selected>{{$product->name}}</option>
                    @else
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                  <div class="form-group col-lg-6 col-md-12">
                  <label for="client">Client</label>
                  <select  id="client" name="client" class="form-control js-example-basic-single" style="width: 100%;" required>
                    @foreach($clients as $client)
                    @if( $client->Name == $order->client->Name)
                    <option value="{{$client->id}}" selected>{{$client->Name}}</option>
                    @else
                    <option value="{{$client->id}}">{{$client->Name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
                 <!-- Row End-->  
                <div class="form-row">
                     <!-- Row Start-->
                
                 <!-- Row End--> 
                  <div class="form-group col-lg-12">
                    <label for="Description">Order Description</label>
                    <textarea name="description" class="form-control" id="Description"  rows="5">{{$order->description}}</textarea>
                  </div>
                </div> 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Edit order</button>
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
