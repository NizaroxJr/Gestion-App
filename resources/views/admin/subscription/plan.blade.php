<x-admin-component>

@section('CustomStyles')
<link href="{{asset('plugins/tags/tagsinput.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="content-wrapper">
        <div class="card-deck mb-3 text-center">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    
                    <h4 class="my-0 font-weight-normal">You're Subscribed To {{$plan[0]->title}} Plan</h4>
                </div>
                <div class="card-body">
                   <h1 style="color:#41B779;">
                       "${{$plan[0]->cost}}"
                       <small class="text-muted">/mo</small>
                    </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Users Number:<small class="text-muted">{{$plan[0]->usersNumber}}</small></li>
                        <li>Warehouses Number:<small class="text-muted">{{$plan[0]->warehousesNumber}}</small></li>
                        <li>Products Number:<small class="text-muted">{{$plan[0]->productsNumber}}</small></li>
                        <li>Suppliers Number:<small class="text-muted">{{$plan[0]->suppliersNumber}}</small></li>
                    </ul>   
            </div>
            <div class="card-footer">
                @if(Auth::user()->subscription('default')->onGracePeriod())
               <h4>Ends At:<small style="color:#41B779;">{{$endDate}}</small></h4>
               <a href="/plan/resume"><button class="btn btn-lg btn-secondary" type="submit">Resume Subscription</button></a>
               @elseif(Auth::user()->subscribed('default'))
               <a href="/plan/cancel"><button class="btn btn-lg btn-primary" type="submit">Cancel Subscription</button></a>
               @else
               <a href="/plans"><button class="btn btn-lg btn-success" type="submit">Subscribe Again</button></a>
               @endif
               
            </div>
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
