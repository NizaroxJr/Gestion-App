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
         <h3><strong>Edit Role</strong></h3>
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

              <div class="card-body">
                   <h1>Update the Role</h1>
                   
                   @if ($errors->any())
                       <div class="alert alert-danger" role="alert">
                           <ul>
                               @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li> 
                               @endforeach
                           </ul>
                       </div>
                   @endif
                   
                   <form method="POST" action="/roles/{{$role->id}}">
                       @csrf
                       @method('PATCH')
                       
                       <div class="form-group">
                           <label for="role_name">Role name</label>
                           <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Role name..." value="{{$role->name}}" required>
                       </div>
                       <div class="form-group">
                           <label for="role_slug">Role Slug</label>
                           <input type="text" name="role_slug" tag="role_slug" class="form-control" id="role_slug" placeholder="Role Slug..." value="{{$role->slug}}" required>
                       </div>
                         <div class="form-group" >
                           <label for="permissionTable">Permissions</label>
                           <table id="permissionTable" class="table table-bordered role-table mb-0"><colgroup><col> <col style="background: #fcfcfc;"></colgroup>
                              <thead>
                                  <tr>
                                      <td style="min-width:220px;"></td> 
                                      <td >Full Access</td> 
                                      <td style="min-width:220px;"></td> 
                                      <td >Full Access</td> 
                                      <td style="min-width:220px;"></td> 
                                      <td >Full Access</td> 
                                      
                                  </tr>
                              </thead>
                               <tbody> 
                                   <tr>
                                       <td>Products</td>
                                       <td><div class="form-check"><input id="products-full" name="permissions[]" value="products-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Categories</td>
                                       <td><div class="form-check"><input id="caetgory-full" name="permissions[]" value="caetgory-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Warehouses</td>
                                       <td><div class="form-check"><input id="warehouse-full" name="permissions[]" value="warehouse-full" class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                    </tr>
                                    <tr>
                                       <td>Sales Orders</td>
                                       <td><div class="form-check"><input id="sales-full" name="permissions[]" value="sales-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Invoices</td>
                                       <td><div class="form-check"><input id="invoices-full" name="permissions[]" value="invoices-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Clients</td>
                                       <td><div class="form-check"><input id="clients-full" name="permissions[]" value="clients-full" class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                    </tr>
                                    <tr>
                                       <td>Purcahase Orders</td>
                                       <td><div class="form-check"><input id="purchase-full" name="permissions[]" value="purchase-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Bills</td>
                                       <td><div class="form-check"><input id="bills-full" name="permissions[]" value="bills-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Suppliers</td>
                                       <td><div class="form-check"><input id="suppliers-full" name="permissions[]" value="suppliers-full" class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                    </tr>
                                    <tr>
                                       <td>Roles</td>
                                       <td><div class="form-check"><input id="role-full" name="permissions[]" value="role-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td>Users</td>
                                       <td><div class="form-check"><input id="user-full" name="permissions[]" value="user-full"  class="ember-checkbox ember-view form-check-input position-static" type="checkbox"></div></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                               </tbody>
                            </table>
                       </div> 
                       <div class="form-group pt-2">
                           <input class="btn btn-primary" type="submit" value="Submit">
                       </div>
                   </form>
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
$(document).ready(function(){
            $('#role_name').keyup(function(e){
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
              var permissions={!! json_encode($permissions->toArray()) !!};
              permissions.forEach(function(permission){
                  console.log();
                  id=permission.slug;
                  id='#'+id+'';
                  $(id).prop('checked', true);
              });    
            });
</script>
@stop
</x-admin-component>
