<x-admin-component>
@section('title')
Add invoice
@stop

@section('CustomStyles')
<link href="{{asset('plugins/tags/tagsinput.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="content-wrapper"  >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Add invoice</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Show invoice</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="order">Order:</label>
                    <span>{{$invoice->order->id}}</span>
                  </div>

                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Status">Status:</label>
                    <span>{{$invoice->Status}}</span>
                  </div>
                  
                 </div>
                   <!-- Row End-->
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-12">
                    <label for="Description">Invoice Description</label>
                    <textarea name="description" class="form-control" id="Description" rows="3" readonly>{{$invoice->description}}</textarea>
                  </div>
                  
                 <!-- Row End-->
                </div> 

                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="invoiceDate">Invoice Date</label>
                    <input type="date" name="date" id="invoiceDate" required value="{{$invoice->Date}}" readonly>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="dueDate">Due Date</label>
                    <input type="date" name="dueDate" id="dueDate" required value="{{$invoice->dueDate}}" readonly>
                  </div>
                  
                 <!-- Row End-->
                </div> 

                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-12" >
                    <label for="Status">Invoice Products</label>
                    <table class="table table-hover text-nowrap" >
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
                        <tbody id="orderItem">
                          @foreach($invoice->order->orderItems as $item)
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
                             <td>${{$invoice->order->subtotal}}</td>
                           </tr>
                           <tr>
                             <th><strong>Shipping:</strong></th>
                             <td>${{$invoice->order->shipping}}</td>
                           </tr>
                           <tr>
                             <th><strong>Total:</strong></th>
                             <td>${{$invoice->order->total}}</td>
                           </tr>
                    </table>
                      </div>
                 </div>  
                 <div class="row">
                   <div class="form-group col-lg-8">
                        <a href="{{ url('invoice/download' , $invoice->id) }}"><button type="button" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button></a>
                        <a href="{{ url('invoice/viewpdf' , $invoice->id) }}"><button type="button" class="btn btn-secondary"><i class="fas fa-eye"></i>View PDF</button></a>
                      </div>
                 </div>
            </div>
         </div>
                 <!-- Row End-->  
                 
                 <!-- Row End--> 
                  
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
<script>

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
@stop
</x-admin-component>
