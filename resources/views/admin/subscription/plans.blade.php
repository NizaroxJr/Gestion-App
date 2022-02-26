<x-admin-component>

@section('CustomStyles')
<link href="{{asset('plugins/tags/tagsinput.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="content-wrapper">
        <div class="card-deck mb-3 text-center">
            @foreach($plans as $plan)
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{$plan->title}}</h4>
                </div>
                <div class="card-body">
                   <h1 style="color:#41B779;">
                       "${{$plan->cost}}"
                       <small class="text-muted">/mo</small>
                    </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Users Number:<small class="text-muted">{{$plan->usersNumber}}</small></li>
                        <li>Warehouses Number:<small class="text-muted">{{$plan->warehousesNumber}}</small></li>
                        <li>Products Number:<small class="text-muted">{{$plan->productsNumber}}</small></li>
                        <li>Suppliers Number:<small class="text-muted">{{$plan->suppliersNumber}}</small></li>
                    </ul>   
                    <a href="{{ route('payments', ['plan' => $plan->identifier]) }}">{{$plan->title}}</a>                </div>
            </div>
            @endforeach
        </div>
</div>
@stop

@section('CustomScripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"

        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"

        crossorigin="anonymous">

</script>

<script src="{{asset('plugins/tags/tagsinput.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop
</x-admin-component>
