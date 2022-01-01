<x-admin-component>
@section('title')
invoices
@stop



@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Invoices</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <a href="{{route('invoice.create')}}"><button class="btn btn-primary"><i class="fas fa-plus"></i>Add invoice</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-binvoiceed table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($invoices as $invoice)
                  <tr>
                    <td>{{$invoice->id}}</td>
                    <td>{{$invoice->order->client->Name}}</td>
                    <td>{{$invoice->order->total}}$</td>
                    @if($invoice->Status == "Accepted")
                    <td><span class="badge badge-success">{{$invoice->Status}}</span></td>
                    @else
                    <td><span class="badge badge-danger">{{$invoice->Status}}</span></td>                    
                    @endif
                    @if($invoice->PaymentStatus == "Paid")
                   <td><span class="badge badge-success">{{$invoice->PaymentStatus}}</span></td>                    
                    @else
                    <td><span class="badge badge-danger">{{$invoice->PaymentStatus}}</span></td> 
                    @endif
                    <td>
                      <a style="margin-right:20px" title="invoice Details" href="{{route('invoice.show',$invoice->id)}}"><i class="far fa-eye"></i></a>
                      <a style="margin-right:20px" title="Edit invoice" href="{{route('invoice.edit',$invoice->id)}}"><i class="fas fa-edit"></i></a>
                      <form  method="post" action="{{route('invoice.store')}}" title="Clone invoice" style="display:inline-block;" enctype="multipart/form-data">
                        @csrf
                        <input  name="id" type="hidden" value="{{$invoice->id}}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-copy"></i></button>
                      </form>
                      <form method="post" action="{{route('invoice.destroy',$invoice->id)}}" title="Delete invoice" style="display:inline-block;"  enctype="multipart/form-data">
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
      "invoiceing": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> 
@stop 

</x-admin-component>

