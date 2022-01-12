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
         <h3><strong>Show Role</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3>Name: {{$role['name']}}</h3>  
                <h4>Slug: {{$role['slug']}}</h4>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                   <h5 class="card-title">Permissions</h5>
                   <p class="card-text">
                        @if ($role->permissions != null)                       
                            @foreach ($role->permissions as $permission)
                            <span class="badge badge-secondary">
                                {{ $permission->name }}                                    
                            </span>
                            @endforeach               
                        @endif
                   </p>
              </div>

              <div class="card-footer">
                  <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
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

</script>
@stop
</x-admin-component>
