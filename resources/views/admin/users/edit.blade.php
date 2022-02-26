<x-admin-component>
@section('title')
Add order
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
         <h3><strong>Add User</strong></h3>
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
                  <h3 class="card-title">Add User</h3>
                </div>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf()
                  
                  <div class="form-group">
                      <label for="name">User name</label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ $user->name }}" required>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ $user->email }}">
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password..." minlength="8">
                  </div>
                  <div class="form-group">
                      <label for="password_confirmation">Password Confirm</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
                  </div>
                  
                  <div class="form-group">
                      <label for="role">Select Role</label>
                      <select class="role form-control" name="role" id="role">
                          <option value="">Select Role...</option>
                          @foreach ($roles as $role)
                              <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>                
                          @endforeach
                      </select>          
                  </div>
              
                  <div id="permissions_box" >
                      <label for="roles">Select Permissions</label>        
                      <div id="permissions_ckeckbox_list">                    
                      </div>
                  </div>   
              
                  @if($user->permissions->isNotEmpty())
                      @if($rolePermissions != null)
                          <div id="user_permissions_box" >
                              <label for="roles">User Permissions</label>
                              <div id="user_permissions_ckeckbox_list">                    
                                  @foreach ($rolePermissions as $permission)
                                  <div class="custom-control custom-checkbox">                         
                                      <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                                      <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                      @endif
                  @endif
              
              
                  <div class="form-group pt-2">
                      <input class="btn btn-primary" type="submit" value="Submit">
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
$(document).ready(function(){
            var permissions_box = $('#permissions_box');
            var permissions_ckeckbox_list = $('#permissions_ckeckbox_list');
            permissions_box.hide(); // hide all boxes
            $('#role').on('change', function() {
                var role = $(this).find(':selected');    
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');
                permissions_ckeckbox_list.empty();
                $.ajax({
                    url: "/users/create",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    
                    console.log(data);
                    
                    permissions_box.show();                        
                    // permissions_ckeckbox_list.empty();
                    $.each(data, function(index, element){
                        $(permissions_ckeckbox_list).append(       
                            '<div class="custom-control custom-checkbox">'+                         
                                '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'">' +
                                '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );
                    });
                });
            });
        });


</script>
@stop
</x-admin-component>
