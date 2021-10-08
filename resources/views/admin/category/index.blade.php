<x-admin-component>
@section('title')
Categories
@stop



@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>Categories</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <a href="{{route('category.create')}}"><button class="btn btn-primary"><i class="fas fa-plus"></i>Add category</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="form-group">
                        <select type="text" onchange="select()" id="selectCategory" class="form-control ">
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Parent Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                  <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    @if($category->parent_id == NULL)
                    <td>NULL</td>
                    @else
                    <td>{{$category->parent->name}}</td>
                    @endif
                    @if($category->status == "Active")
                    <td><span class="badge badge-success">{{$category->status}}</span></td>
                    @else
                    <td><span class="badge badge-danger">{{$category->status}}</span></td>                    
                    @endif
                    <td>
                      <a style="margin-right:20px"  title="Edit category" href="{{route('category.edit',$category->id)}}"><i class="fas fa-edit"></i></a>
                      <form method="post" action="{{route('category.destroy',$category->id)}}" title="Delete category" style="display:inline-block;"  enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="Edit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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

<script>
 $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  function select(){
    var selectedCategory = $("#selectCategory option").filter(":selected").val();
    $('input').val(selectedCategory);
  }
</script>
@stop 

</x-admin-component>

