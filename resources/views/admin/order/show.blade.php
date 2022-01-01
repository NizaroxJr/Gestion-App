<x-admin-component>
@section('title')
Show order
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
         <h3><strong>Show order</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Order::{{$order->id}}</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                      <div class="form-group col-lg-6 col-md-12">
                      <label for="client">Client</label>
                      <input type="text" class="form-control" value="{{$order->client->Name}}" readonly>
                      </div>
    
                      <div class="form-group col-lg-6 col-md-12">
                        <label for="Status">Status</label> 
                        <input type="text" class="form-control" value="{{$order->Status}}" readonly>
                      </div>
                 </div>
                   <!-- Row End-->
                  <div class="form-row">
                     <!-- Row Start-->
                     <div class="form-group col-lg-12">
                       <label for="Description">Order Description</label>
                       <textarea name="description" class="form-control" id="Description" rows="3" placeholder="{{$order->description}}" readonly></textarea>
                     </div> 
                 <!-- Row End-->
                </div> 
                <div class="form-row">
                     <!-- Row Start-->-
                  <div class="form-group col-lg-12">
                    <label for="Status">Order Products</label>
                    <table class="table table-hover text-nowrap" id="invoice_table">
                        <thead>
                          <tr>
                            <th width="50%">Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount %</th>
                            <th>Subtotal</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($items as $item)
                          <tr>
                            <td >
                              {{$item->product->name}}
                            </td>
                            <td>
                              {{$item->quantity}}
                            </td>
                            <td>
                              {{$item->price}} $
                            </td>
                            <td>
                              {{$item->discount}}
                            </td>
                            <td>
                              {{$item->subtotal}} $
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                  </table>
                </div>
              </div>

                  <div class="form-row">
                        <!-- Row Start-->
                      <div class="form-group col-lg-8">
                        
                      </div>
                      <div class="form-group col-lg-4">
                         <table class="table">
                           <tr>
                             <th style="width:50%"><strong>Subtotal:</strong></th>
                             <td><input id="finalSubtotal" name="finalSubtotal" type="number" class="form-control" value="{{$order->subtotal}}" readonly></td>
                           </tr>
                           <tr>
                             <th><strong>Shipping:</strong></th>
                             <td><input id="shipping" name="shipping" type="number" class="form-control" value="{{$order->shipping}}" onchange="ship()" readonly></td>
                           </tr>
                           <tr>
                             <th><strong>Total:</strong></th>
                             <td><input id="total" name="total" type="number" class="form-control" value="{{$order->total}}" readonly></td>
                           </tr>
                    </table>
                      </div>
                 </div>  
                 <div class="row">
                   <div class="form-group col-lg-8">
                        <a href="{{ url('order/download' , $order->id) }}"><button type="button" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button></a>
                        <a href="{{ url('order/viewpdf' , $order->id) }}"><button type="button" class="btn btn-secondary"><i class="fas fa-eye"></i>View PDF</button></a>
                      </div>
                 </div>
              </div> 
                <!-- /.card-body -->
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

@stop
</x-admin-component>
