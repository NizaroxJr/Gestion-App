<x-admin-component>
@section('title')
Orders
@stop



@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Purchase Orders</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <a href="{{route('purchaseOrder.create')}}"><button class="btn btn-primary"><i class="fas fa-plus"></i>Add Order</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Supplier Name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->supplier->name}}</td>
                    <td>{{$order->total}}</td>
                    @if($order->Status == "Shipped")
                    <td><span class="badge badge-success">{{$order->Status}}</span></td>
                    @else
                    <td><span class="badge badge-danger">{{$order->Status}}</span></td>                    
                    @endif
                    @if($order->PaymentStatus == "Paid")
                    <td><span class="badge badge-success">{{$order->PaymentStatus}}</span></td>                    
                    @else
                    <td><span class="badge badge-danger">{{$order->PaymentStatus}}</span></td>                   
                    @endif
                    <td>
                      <a style="margin-right:20px" title="Order Details" href="{{route('purchaseOrder.show',$order->id)}}"><i class="far fa-eye"></i></a>
                      <a style="margin-right:20px" title="Edit Order" href="{{route('purchaseOrder.edit',$order->id)}}"><i class="fas fa-edit"></i></a>
                      <form  method="post" action="{{route('purchaseOrder.store')}}" title="Clone Order" style="display:inline-block;" enctype="multipart/form-data">
                        @csrf
                        <input  name="id" type="hidden" value="{{$order->id}}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-copy"></i></button>
                      </form>
                      <form method="post" action="{{route('purchaseOrder.destroy',$order->id)}}" title="Delete Order" style="display:inline-block;"  enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop

@section('CustomScripts')
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
 $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy","csv", "excel", "pdf","print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> 
@stop 

</x-admin-component>

