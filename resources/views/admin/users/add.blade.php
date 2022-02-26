<x-admin-component>
@section('title')
Add user
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
         <h3><strong>Add user</strong></h3>
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
              <div class="card-body">
              <!-- /.card-header -->
              <!-- form start -->
                    <form method="POST" action="/users" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">User name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password..." required minlength="8">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirm</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label for="role">Select Role</label>
                    
                            <select class="role form-control js-example-basic-single" name="role" id="role">
                                <option value="">Select Role...</option>
                                @foreach ($roles as $role)
                                <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="parent" class="form-control" id="parent" placeholder="Name..." value="{{ Auth::user()->id}}" hidden>
                        </div>
                        <div id="permissions_box" > 
                            <label for="roles">Permissions</label>
                            <div id="permissions_ckeckbox_list">
                            </div>
                        </div>     
                    
                        <div class="form-group pt-2">
                            <input class="btn btn-primary" type="submit" value="Add User">
                        </div>
                    </form>    
              </div>
            </div>
          </div>
                 <!-- Row End-->  
                 
                 <!-- Row End--> 
                  
                </div> 
                <!-- /.card-body -->
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
                            '<div class="custom-control">'+                         
                                '<input  type="text" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'" hidden>' +
                                '<label  for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );
                    });
                });
            });
            $('.js-example-basic-single').select2();
        });
</script>
@stop
</x-admin-component>
