<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  
  <!-- DataTables  -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Bootstrap Tempus  -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Custom Style -->
  @yield('CustomStyles')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  
</head>
<body class="hold-transition sidebar-mini">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  Date:{{$bill->Date}}
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{$user->name}}</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: {{$user->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$supplier->name}}</strong><br>
                    {{$supplier->Adresse}}<br>
                    Phone: {{$supplier->tel}}<br>
                    Email: {{$supplier->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Order ID:</b>{{$bill->order->id}}<br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th><strong>Product</strong></th>
                      <th><strong>Qty</strong></th>
                      <th><strong>Price</strong></th>
                      <th><strong>Discount %</strong></th>
                      <th><strong>Subtotal</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                    <tr>
                      <td>{{$item->product->name}}</td>
                      <td>{{$item->quantity}}</td>
                      <td>${{$item->price}}</td>
                      <td>{{$item->discount}}</td>
                      <td>${{$item->subtotal}}</td>
                    </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                     <p class="lead">Amount Due {{$bill->dueDate}}</p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%"><strong>Subtotal:</strong></th>
                        <td>${{$bill->order->subtotal}}</td>
                      </tr>
                      <tr>
                        <th><strong>Shipping:</strong></th>
                        <td>${{$bill->order->shipping}}</td>
                      </tr>
                      <tr>
                        <th><strong>Total:</strong></th>
                        <td>${{$bill->order->total}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  </body>
</html>
