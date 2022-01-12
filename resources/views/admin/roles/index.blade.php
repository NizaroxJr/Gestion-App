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
         <h3><strong>Roles List</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                 <a href="{{route('roles.create')}}"><button class="btn btn-success"><i class="fas fa-plus"></i>Add Role</button></a>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                           <tr>
                               <th>Id</th>
                               <th>Role</th>
                               <th>Slug</th>
                               <th>Permissions</th>
                               <th>Tools</th>
                           </tr>
                           </thead>
                           <tbody>
                               @foreach ($roles as $role)
                                   <tr>
                                       <td>{{ $role['id'] }}</td>
                                       <td>{{ $role['name'] }}</td>
                                       <td>{{ $role['slug'] }}</td>
                                       <td>
                                           @if ($role->permissions != null)
                                                   
                                               @foreach ($role->permissions as $permission)
                                               <span class="badge badge-secondary">
                                                   {{ $permission->name }}                                    
                                               </span>
                                               @endforeach
                                           
                                           @endif
                                       </td>
                                       <td>
                                           <a href="{{route('roles.show',$role->id)}}"><i class="fa fa-eye"></i></a>
                                           <a href="/roles/{{ $role['id'] }}/edit"><i class="fa fa-edit"></i></a>
                                           <a href="#" data-toggle="modal" data-target="#deleteModal" data-roleid="{{$role['id']}}"><i class="fas fa-trash-alt"></i></a>
                                       </td>
                                   </tr>
                               @endforeach
                           </tbody>
                       </table>
              </div>
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
                      <div class="modal-body">Select "delete" If you realy want to delete this role.</div>
                      <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <form method="POST" action="">
                          @method('DELETE')
                          @csrf
                          {{-- <input type="hidden" id="role_id" name="role_id" value=""> --}}
                          <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                      </form>
                      </div>
                  </div>
                  </div>
              </div>
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
 $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var role_id = button.data('roleid') 
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action','/roles/' + role_id);
    })
</script>
@stop
</x-admin-component>
