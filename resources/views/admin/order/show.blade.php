<x-admin-component>
@section('title')
{{$order->name}}:: order Details
@stop



@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
         <h3><strong>{{$order->Name}}</strong></h3>
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

            <div class="card mb-3" >
               <div class="row no-gutters">
                 <div class="col-lg-12 ">
                   <div class="card-body text-center">
                     <p class="card-text ">
                       <span><strong>order ID:</strong></span>
                       <span>{{$order->id}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Quantity:</strong></span>
                       <span>{{$order->quantity}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Price:</strong></span>
                       <span>{{$order->price}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>Status:</strong></span>
                       @if($order->status == "Shipped")
                       <span class="badge badge-success">{{$order->status}}</span>
                       
                       @else
                         <span class="badge badge-danger">{{$order->status}}</span>
                       
                      
                       @endif
                    </p>
                    <p class="card-text">
                       <span><strong>Description:</strong></span>
                       <span>{{$order->description}}</span>
                    </p>
                   </div>
                 </div>
               </div>
             </div>

             <!-- CLient -->
             <div class="card mb-3" >
               <div class="row no-gutters">
                 <div class="col-lg-4 col-md-12">
                   <img width="300px" src="{{$product->img}}" >
                 </div>
                 <div class="col-lg-8 col-md-12">
                   <div class="card-body">
                     <p class="card-text">
                       <span><strong>client ID:</strong></span>
                       <span>{{$client->id}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>client Name:</strong></span>
                       <span>{{$client->Name}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>client Company:</strong></span>
                       <span>{{$client->CompanyName}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>client Adresse:</strong></span>
                       <span>{{$client->Adresse}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>client phone:</strong></span>
                       <span>{{$client->phone}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>client email:</strong></span>
                       <span>{{$client->email}}</span>
                    </p>
                   </div>
                 </div>
               </div>
             </div>

            <!-- Product --> 
             <div class="card mb-3" >
               <div class="row no-gutters">
                 <div class="col-lg-4 col-md-12">
                   <img width="300px" src="{{$product->img}}" >
                 </div>
                 <div class="col-lg-8 col-md-12">
                   <div class="card-body">
                     <p class="card-text">
                       <span><strong>product ID:</strong></span>
                       <span>{{$product->id}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>product Name:</strong></span>
                       <span>{{$product->name}}</span>
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
                       <span><strong>supplier:</strong></span>
                       <span>{{$product->supplier}}</span>
                    </p>
                    <p class="card-text">
                       <span><strong>tags:</strong></span>
                       <span>{{$product->tags}}</span>
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

