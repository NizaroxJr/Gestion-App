<x-admin-component>
@section('title')
bills
@stop

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Bills</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <a href="{{route('bill.create')}}"><button class="btn btn-primary"><i class="fas fa-plus"></i>Add bill</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bbilled table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($bills as $bill)
                  <tr>
                    <td>{{$bill->id}}</td>
                    <td>{{$bill->order->supplier->name}}</td>
                    <td>{{$bill->order->total}}$</td>
                    @if($bill->Status == "Accepted")
                    <td><span class="badge badge-success">{{$bill->Status}}</span></td>
                    @else
                    <td><span class="badge badge-danger">{{$bill->Status}}</span></td>                    
                    @endif
                    @if($bill->PaymentStatus == "Paid")
                   <td><span class="badge badge-success">{{$bill->PaymentStatus}}</span></td>                    
                    @else
                    <td><span class="badge badge-danger">{{$bill->PaymentStatus}}</span></td> 
                    @endif
                    <td>
                      <a style="margin-right:20px" title="bill Details" href="{{route('bill.show',$bill->id)}}"><i class="far fa-eye"></i></a>
                      <a style="margin-right:20px" title="Edit bill" href="{{route('bill.edit',$bill->id)}}"><i class="fas fa-edit"></i></a>
                      <form  method="post" action="{{route('bill.store')}}" title="Clone bill" style="display:inline-block;" enctype="multipart/form-data">
                        @csrf
                        <input  name="id" type="hidden" value="{{$bill->id}}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-copy"></i></button>
                      </form>
                      <form method="post" action="{{route('bill.destroy',$bill->id)}}" title="Delete bill" style="display:inline-block;"  enctype="multipart/form-data">
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
      "billing": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> 
@stop 

</x-admin-component>

