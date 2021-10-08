<x-admin-component>
@section('title')
Category
@stop

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Edit Category</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          
          <section class="content" style="padding:20px 30%;">
              <div class="row">
                  <div class="col-md-12">
                      <div class="box box-primary">
                          <form  method="POST" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              <div class="box-body">
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Category name*</label>
                                              <input type="text" name="name" class="form-control" placeholder="Category name" value="{{$category->name}}" required />
                                          </div>
                                      </div>
          
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Category Slug*</label>
                                              <input type="text" name="slug" class="form-control" placeholder="Category Slug" value="{{$category->slug}}" required />
                                          </div>
                                      </div>
                                      
                                      
                                      <div class="form-group col-lg-6 col-md-12">
                                        <label for="status">Status</label>
                                        <select  id="status" name="status" class="form-control js-example-basic-single " style="width: 100%;" required>
                                        @if($category->status == "Active")
                                          <option value="Active" selected>Active</option>
                                          <option value="Inctive">Inactive</option>
                                        @else
                                          <option value="Active" >Active</option>
                                          <option value="Inactive" selected>Inactive</option>
                                        @endif
                                        </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="box-footer">
                                  <button type="submit" class="btn btn-primary">Edit Category</button>
          
                              </div>
                          </form>
                      </div>
                  </div>
              </div>

          </section>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop

@section('CustomScripts')

@stop
</x-admin-component>