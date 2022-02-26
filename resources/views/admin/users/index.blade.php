<x-admin-component>
@section('title')
users
@stop



@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>users</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <a href="{{route('users.create')}}"><button class="btn btn-primary"><i class="fas fa-plus"></i>Add user</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-busered" id="example1" width="100%" cellspacing="0">
                       <thead>
                       <tr>
                           <th>Id</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th>Permissions</th>
                           <th>Tools</th>
                       </tr>
                       </thead>
                       <tbody>
                           @foreach ($users as $user)                                
                           <tr>
                               <td>{{$user['id']}}</td>
                               <td>{{$user['name']}}</td>
                               <td>{{$user['email']}}</td>
                               <td>
                                       @foreach ($user->roles as $role)
                                           <span class="badge badge-secondary">
                                               {{ $role->name }}
                                           </span>
                                       @endforeach
                               </td>
                               <td>             
                                       @foreach ($user->permissions as $permission)
                                           <span class="badge badge-secondary">
                                               {{ $permission->name }}                                    
                                           </span>
                                       @endforeach
                               </td>
                               <td>
                                   <a href="/users/{{ $user['id'] }}"><i class="fa fa-eye"></i></a>
                                   <a href="/users/{{ $user['id'] }}/edit"><i class="fa fa-edit"></i></a>
                                   <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user['id']}}"><i class="fas fa-trash-alt"></i></a>
                               </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
              <!-- /.card-body -->
              <!-- delete Modal-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you shure you want to delete this?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">Select "delete" If you realy want to delete this user.</div>
                    <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="">
                        @method('DELETE')
                        @csrf
                        {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                        <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                    </form>
                    </div>
                </div>
                </div>
            </div>
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
      "usering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var user_id = button.data('userid') 
            
            var modal = $(this)
            // modal.find('.modal-footer #user_id').val(user_id)
            modal.find('form').attr('action','/users/' + user_id);
        })
</script> 
@stop 

</x-admin-component>

