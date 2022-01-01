<x-admin-component>
@section('title')
Add bill
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
         <h3><strong>Add bill</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add bill</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addbill" method="post" action="{{route('bill.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="order">Select Order</label>
                    <select  id="orderID" name="orderID" class="form-control js-example-basic-single" style="width: 100%;"  required>
                     @foreach($orders as $order)
                    <option value="{{$order->id}}" >{{$order->id}}</option>
                    @endforeach
                  </select>
                  </div>

                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Status">Status</label>
                    <select  id="status" name="status" class="form-control " style="width: 100%;" required>
                    <option value="Paid" selected="selected">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Cancelled">Cancelled</option>
                  </select>
                  </div>
                  
                 </div>
                   <!-- Row End-->
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-12">
                    <label for="Description">bill Description</label>
                    <textarea name="description" class="form-control" id="Description" rows="3"></textarea>
                  </div>
                  
                 <!-- Row End-->
                </div> 

                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="billDate">bill Date</label>
                    <input type="date" name="date" id="billDate" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="dueDate">Due Date</label>
                    <input type="date" name="dueDate" id="dueDate" required>
                  </div>
                  
                 <!-- Row End-->
                </div> 

                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-12" >
                    <label for="Status">bill Products</label>
                    <table class="table table-hover text-nowrap" id="{{$order->id}}" >
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
                          
                        </tbody>
                    </table>  
              </div>
            </div>
            <div class="form-row">
                        <!-- Row Start-->
                      <div class="form-group col-lg-6">
                        
                      </div>
                      <div class="form-group col-lg-6">
                         <table class="table table-hover text-nowrap" id="orderTable">
                           
                           
                        </table>
                      </div>
                 </div>  
                 </div>
         </div>
                 <!-- Row End-->  
                 
                 <!-- Row End--> 
                  
                </div> 
                <!-- /.card-body -->

                <div class="card-footer" >
                  <button type="submit" class="btn btn-primary">Add bill</button>
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

$("#orderID").on("change", function(){
    $.ajax({
      method:"GET",
      url:"get/"+this.value,
      success: function(data,status,xhr){
          var order=data.order;
          var orderItems=data.orderItems;
          var itemsProduct=data.itemProduct;
          //Create Order Items Table
          var html="";
         $( "#orderItem" ).empty();
         $( "#orderTable" ).empty();

         for(var i=0 ; i<orderItems.length ;i++){
             html+="<tr>";
             html+='<td>'+itemsProduct[i]+'</td>';
             html+='<td>'+orderItems[i].quantity+'</td>';
             html+='<td>$'+orderItems[i].price+'</td>$'
             html+='<td>'+orderItems[i].discount+'</td>'
             html+='<td>$'+orderItems[i].subtotal+'</td>$';
             html+="</tr>";
         }
         $( "#orderItem" ).append(html);
         //Create Order Table;
         var orderHTML="<tr><th><strong>Subtotal:</strong></th><td>$"+order.subtotal+"</td></tr>";
         orderHTML+="<tr><th><strong>Shipping:</strong></th><td>$"+order.shipping+"</td></tr>";
         orderHTML+="<tr><th><strong>Total:</strong></th><td>$"+order.total+"</td></tr>";
        $( "#orderTable" ).append(orderHTML);
      },
      error: function(xhr,status,error){
         console.log(xhr);
         console.log(status);
         console.log(error);
      },
      complete: function(xhr,status){
         console.log(xhr);
         console.log(status);
      }
    })
})

$(document).ready(function() {
  var id=$("#orderID").find(":selected").text();
    $.ajax({
      method:"GET",
      url:"get/"+id,
      success: function(data,status,xhr){
          var order=data.order;
          var orderItems=data.orderItems;
          var itemsProduct=data.itemProduct;
          var html="";
         $( "#orderItem" ).empty();
         $( "#orderTable" ).empty();
         for(var i=0 ; i<orderItems.length ;i++){
             html+="<tr>";
             html+='<td>'+itemsProduct[i]+'</td>';
             html+='<td>'+orderItems[i].quantity+'</td>';
             html+='<td>$'+orderItems[i].price+'</td>'
             html+='<td>'+orderItems[i].discount+'</td>'
             html+='<td>$'+orderItems[i].subtotal+'</td>';
             html+="</tr>";
         }
         $( "#orderItem" ).append(html);

          //Create Order Table;
         var orderHTML="<tr><th><strong>Subtotal:</strong></th><td>$"+order.subtotal+"</td></tr>";
         orderHTML+="<tr><th><strong>Shipping:</strong></th><td>$"+order.shipping+"</td></tr>";
         orderHTML+="<tr><th><strong>Total:</strong></th><td>$"+order.total+"</td></tr>";
        $( "#orderTable" ).append(orderHTML);
         
      },
      error: function(xhr,status,error){
         console.log(xhr);
         console.log(status);
         console.log(error);
      },
      complete: function(xhr,status){
         console.log(xhr);
         console.log(status);
      }
    })
});

document.getElementById("billDate").onchange = function () {
    var input = document.getElementById("dueDate");
    input.setAttribute("min", this.value);
}


</script>
@stop
</x-admin-component>
