<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\Permission;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Plans;

use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Inventory
        Gate::define('canProduct', function ($user){
            return $user->hasAccess(['products-full']);
        });
        Gate::define('canAddProduct', function ($user){
            $ProductNumber=Product::all()->count();
            $planID=Auth::user()->subscription('default')->stripe_price;
            $plan=Plans::where("stripe_id","=",$planID)->get();
            $planNumey=$plan[0]->productsNumber;
            if($ProductNumber <=  $planNumey){
               return true;
            }
            else{   
                return Response::deny("You Can Only Add : $planNumey Products Upgrade You Plan To Get More");
            }               
        });
        Gate::define('canWarehouse', function ($user){
            return $user->hasAccess(['warehouse-full']);
        });
        Gate::define('canAddWarehouse', function ($user){
            $warehouseNumber=Warehouse::all()->count();
            $planID=Auth::user()->subscription('default')->stripe_price;
            $plan=Plans::where("stripe_id","=",$planID)->get();
            $planNumey=$plan[0]->warehousesNumber;
            if($warehouseNumber <=  $planNumey){
               return true;
            }
            else{   
                return Response::deny("You Can Only Add : $planNumey Warehouses Upgrade You Plan To Get More");
            }               
        });
        Gate::define('canCategory', function ($user){
            return $user->hasAccess(['caetgory-full']);
        });

        //Sales
        Gate::define('canSales', function ($user){
            return $user->hasAccess(['sales-full']);
        });
        Gate::define('canInvoice', function ($user){
            return $user->hasAccess(['invoices-full']);
        });
        Gate::define('canClient', function ($user){
            return $user->hasAccess(['clients-full']);
        });

        //Purchases
        Gate::define('canPurchase', function ($user){
            return $user->hasAccess(['purchase-full']);
        });
        Gate::define('canBill', function ($user){
            return $user->hasAccess(['bills-full']);
        });
        Gate::define('canSupplier', function ($user){
            return $user->hasAccess(['suppliers-full']);
        });
        Gate::define('canAddSupplier', function ($user){
            $SupplierNumber=Supplier::all()->count();
            $planID=Auth::user()->subscription('default')->stripe_price;
            $plan=Plans::where("stripe_id","=",$planID)->get();
            $planNumey=$plan[0]->suppliersNumber;
            if($SupplierNumber <=  $planNumey){
               return true;
            }
            else{   
                return Response::deny("You Can Only Add : $planNumey Suppliers Upgrade You Plan To Get More");
            }               
        });
        //Roles/Users
        Gate::define('canRole', function ($user){
            return $user->hasAccess(['role-full']);
        });
        Gate::define('canUser', function ($user){
            return $user->hasAccess(['user-full']);
        });
        Gate::define('canAddUser', function ($user){
            $UserNumber=User::all()->count();
            $planID=Auth::user()->subscription('default')->stripe_price;
            $plan=Plans::where("stripe_id","=",$planID)->get();
            $planNumey=$plan[0]->usersNumber;
            if($UserNumber <=  $planNumey){
               return true;
            }
            else{   
                return Response::deny("You Can Only Add : $planNumey Users Upgrade You Plan To Get More");
            }               
        });
        Gate::define('canSubscribe', function ($user){
            if(!$user->parent()->get()->count()){
               return true;
            }
            return false;
        });   
    }
}
