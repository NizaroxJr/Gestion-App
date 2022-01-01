<x-admin-component>
@section('title')
Edit client
@stop

@section('CustomStyles')

@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Edit client</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

       <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$client->Name}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="Editclient" method="post" action="{{route('client.update',$client->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="clientName"> Name*</label>
                    <input type="text" name="Name" class="form-control" id="clientName" value="{{$client->Name}}"  required>
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Phone"> Phone</label>
                    <input type="text" name="phone"  class="form-control" id="Phone" value="{{$client->phone}}" required>
                  </div>
                 <!-- Row End-->
                </div> 
                <div class="form-row">
                     <!-- Row Start-->
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Email">Email</label>
                    <input type="email" name="email"  class="form-control" id="Email" value="{{$client->email}}" required>
                  </div>
  
                <div class="form-group col-lg-6 col-md-12">
                    <label for="Adresse">Adresse</label>
                    <input type="text" name="Adresse"  class="form-control" id="Adresse" value="{{$client->Adresse}}" required>
                  </div>

                  <div class="form-group col-lg-6 col-md-12">
                    <label for="Adresse">CompanyName</label>
                    <input type="text" name="CompanyName"  class="form-control" id="Adresse" value="{{$client->Adresse}}" required>
                  </div>
                  <!-- Row End-->
                </div> 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Edit client</button>
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

@stop

</x-admin-component>
