<x-admin-component>
@section('title')
Add purchaseOrder
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
         <h3><strong>Add purchaseOrder</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div>
                  <h3 class="card-title">Add purchaseOrder</h3>
                </div>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="addpurchaseOrder" method="post" action="{{route('purchaseOrder.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div id="purchaseOrderType" class="form-group col-lg-6 col-md-12">
                  <label for="supplier">Supplier</label>
                  <select  id="supplier" name="supplier" class="form-control js-example-basic-single" style="width: 100%;" required>
                    @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
                  </select>
                  </div>

                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Status">Status</label>
                    <select  id="status" name="status" class="form-control" style="width: 100%;" required>
                    <option value="Shipped" selected="selected">Shipped</option>
                    <option value="Not Shipped">Not Shipped</option>
                    <option value="Canceled">Canceled</option>
                  </select>
                  </div>
                </div>
                   <!-- Row End-->
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-12">
                    <label for="Description">purchaseOrder Description</label>
                    <textarea name="description" class="form-control" id="Description" rows="3"></textarea>
                  </div>
                  
                 <!-- Row End-->
                </div> 
                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-12">
                    <label for="Status">purchaseOrder Products</label>
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
                          <tr>
                            <td >
                              <select  id="0" name="product[]" class="form-control js-example-basic-single " style="width: 100%;" required>
                                 @foreach($products as $product)
                                 <option value="{{$product->id}}">{{$product->name}}</option>
                                 @endforeach
                              </select>
                            </td>
                            <td>
                              <input type="number" name="quantity[]"  class="form-control" id="Quantity" min="0" onchange="totalCalcul()" required>
                            </td>
                            <td>
                              <input type="number" name="price[]"  class="form-control" id="price" min="0" onchange="totalCalcul()" required>
                            </td>
                            <td>
                              <input type="number" name="discount[]"  class="form-control" id="discount" min="0" max="100" onchange="totalCalcul()"  required>
                            </td>
                            <td>
                              <input type="number" name="subtotal[]"  class="form-control"  min="0" max="100" readonly required>
                            </td>
                            <td>
                              <button class="btn btn-secondary">
                                <i class="fas fa-minus-circle"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                </table>
              </div>
            </div>

                <div class="form-row">
                  <div class="form-group col-lg-8">
                        <button class="btn btn-primary" onclick="addRow()"><i class="fas fa-plus"></i></button>
                  </div>

                  <div class="form-group col-lg-4">
                      <table class="table">
                           <tr>
                             <th style="width:50%"><strong>Subtotal:</strong></th>
                             <td><input id="finalSubtotal" name="finalSubtotal" type="number" class="form-control" readonly></td>
                           </tr>
                           <tr>
                             <th><strong>Shipping:</strong></th>
                             <td><input id="shipping" name="shipping" type="number" class="form-control" onchange="ship()"></td>
                           </tr>
                           <tr>
                             <th><strong>Total:</strong></th>
                             <td><input id="total" name="total" type="number" class="form-control" readonly></td>
                           </tr>
                    </table>
                  </div>
                </div>
              </div>
                 <!-- Row End-->  
                 
                 <!-- Row End--> 
                  
                </div> 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add purchaseOrder</button>
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
function addRow() {
        var empTab = document.getElementById('invoice_table');

        var rowCnt = empTab.rows.length;    // get the number of rows.
        var tr = empTab.insertRow(rowCnt); // table row.
        
        for (var c = 0; c < 6; c++) {

        var td = document.createElement('td');          // TABLE DEFINITION.
        td = tr.insertCell(c);

              if(c==0){
                 var ele = document.createElement('select');
                 ele.setAttribute('name', 'product[]');
                 ele.setAttribute('id', rowCnt);
                 ele.setAttribute('class', 'form-control js-example-basic-single');
                 ele.innerHTML='@foreach($products as $product)<option value="{{$product->id}}">{{$product->name}}</option>@endforeach';
                 td.appendChild(ele);
              }
              else if(c==1){
                var ele = document.createElement('input');
                ele.setAttribute('name', 'quantity[]');
                ele.setAttribute('type', 'number  ');
                ele.setAttribute('class', 'form-control');
                ele.setAttribute('min', '0');
                ele.setAttribute('required', '');
                ele.setAttribute('onchange', 'totalCalcul()');
                td.appendChild(ele);
              }
              else if(c==2){
                var ele = document.createElement('input');
                ele.setAttribute('name', 'price[]');
                ele.setAttribute('type', 'number  ');
                ele.setAttribute('class', 'form-control');
                ele.setAttribute('min', '0');
                ele.setAttribute('required', '');
                ele.setAttribute('onchange', 'totalCalcul()');
                td.appendChild(ele);
              }
              else if(c==3){
                var ele = document.createElement('input');
                ele.setAttribute('name', 'discount[]');
                ele.setAttribute('type', 'number  ');
                ele.setAttribute('class', 'form-control');
                ele.setAttribute('min', '0');
                ele.setAttribute('max', '100');
                ele.setAttribute('onchange', 'totalCalcul()');
                ele.setAttribute('required', '');
                td.appendChild(ele);
              }
              else if(c==4){
                var ele = document.createElement('input');
                ele.setAttribute('name', 'subtotal[]');
                ele.setAttribute('type', 'number  ');
                ele.setAttribute('class', 'form-control');
                ele.setAttribute('readonly','');
                td.appendChild(ele);
              }
              else{
                var button = document.createElement('button');

                // set the attributes.
                button.innerHTML='<i class="fas fa-minus-circle"></i>';
                button.setAttribute('value', 'Remove');
                button.setAttribute('class','btn btn-secondary');

                // add button's "onclick" event.
                button.setAttribute('onclick', 'removeRow(this)');

                td.appendChild(button);
              }
        }
        
      $(document).ready(function() {
        $('.js-example-basic-single').select2();
      });
    }

  function removeRow(oButton) {
        var empTab = document.getElementById('invoice_table');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // buttton -> td -> tr
    }
  
  var total = 0;
  
    function ship(){
      var shipping=document.getElementById('shipping').value;
      var total=document.getElementById('finalSubtotal').value;
      var finalValue=parseInt(total)+parseInt(shipping);
      var totalElement = document.getElementById('total');
      totalElement.setAttribute('value',finalValue);
  }

  function totalCalcul(){
       var finalSubtotal=0;  
       var myTab = document.getElementById('invoice_table');
       
        // loop through each row of the table.
        for (row = 1; row < myTab.rows.length ; row++) {
            // loop through each cell in a row.
            for (c = 1; c < myTab.rows[row].cells.length; c++) {
                var quantity=myTab.rows.item(row).cells[1].children[0].value;
                var price=myTab.rows.item(row).cells[2].children[0].value;
                var discount=myTab.rows.item(row).cells[3].children[0].value;
                var subtotal=price*quantity;
                subtotal-=subtotal*discount/100;
                myTab.rows.item(row).cells[4].children[0].value=subtotal;
               
            }
             finalSubtotal+=subtotal;
        }
        
        var totalElement = document.getElementById('finalSubtotal');
        totalElement.setAttribute('value',finalSubtotal);
        
        ship();
  }
  

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


</script>
@stop
</x-admin-component>
