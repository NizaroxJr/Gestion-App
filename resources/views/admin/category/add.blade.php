<x-admin-component>
@section('title')
Category
@stop

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Add Category</strong></h3>
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
                          
                          
                          <form role="form" method="post" action="{{route('category.store')}}">
                              @csrf
                              <div class="box-body">
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Category name*</label>
                                              <input type="text" name="name" class="form-control" placeholder="Category name" value="{{old('name')}}" required />
                                          </div>
                                      </div>
          
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Category Slug*</label>
                                              <input type="text" name="slug" class="form-control" placeholder="Category name" value="{{old('slug')}}" required />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group col-lg-6 col-md-12">
                                        <label for="status">Status</label>
                                        <select  id="status" name="status" class="form-control js-example-basic-single " style="width: 100%;" required>
                                          <option value="Active" selected>Active</option>
                                          <option value="Inctive">Inactive</option>
                                        </select>
                                      </div>

                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Select parent category*</label>
                                              <select type="text" name="parent_id" class="form-control ">
                                                  <option value="">None</option>
                                                  @if($categories)
                                                      @foreach($categories as $category)
                                                          <?php $dash=''; ?>
                                                          <option value="{{$category->id}}">{{$category->name}}</option>
                                                          @if(count($category->subcategory))
                                                              @include('admin.category.subcategory',['subcategories' => $category->subcategory])
                                                          @endif
                                                      @endforeach
                                                  @endif
                                              </select>
                                          </div>
                                      </div>

                                      
          
                                  </div>
                              </div>
                              <div class="box-footer">
                                  <button type="submit" class="btn btn-primary">Create</button>
          
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