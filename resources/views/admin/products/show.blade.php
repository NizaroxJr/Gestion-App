<x-admin-component>
@section('title')
{{$product->name}}:: Product Details
@stop



@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>{{$product->name}}</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

            <div class="card mb-3" >
               <div class="row no-gutters">
                 <div class="col-lg-4 col-md-12">
                   <img width="300px" src="/images/{{$product->img}}" >
                 </div>
                 <div class="col-lg-8 col-md-12">
                   <div class="card-body">
                     <p class="card-text">
                       <span><strong>Product ID:</strong></span>
                       <span>{{$product->id}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Tags::</strong></span>
                       <span>{{$product->tags}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Quantity:</strong></span>
                       <span>{{$product->quantity}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Price:</strong></span>
                       <span>{{$product->price}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Supplier:</strong></span>
                       <span>{{$supplier->name}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Category:</strong></span>
                       <span>{{$category->name}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Status:</strong></span>
                       @if($product->status == "In Stock")
                       <span class="badge badge-success">{{$product->status}}</span>
                       
                       @else
                         <span class="badge badge-danger">{{$product->status}}</span>
                       
                      
                       @endif
                    </p>
                    <p class="card-text">
                       <span><strong>Description:</strong></span>
                       <span>{{$product->description}}</span>
                    </p>
                   </div>
                 </div>
               </div>
             </div>
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

