<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Plans;
use Stripe;
use Session;
use Exception;
use Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index() {  
        $this->authorize('canSubscribe');  
        if(!Auth::user()->subscribed('default')){
          $plans = Plans::all();
          return view('admin.subscription.plans', compact('plans'));
        }
        else{
            $planID=Auth::user()->subscription('default')->stripe_price;
            $plan=Plans::where("stripe_id","=",$planID)->get();
            $sub = Auth::user()->subscription('default')->asStripeSubscription();
            $endDate=Carbon::createFromTimeStamp($sub->current_period_end)->format('F jS, Y');
            return view('admin.subscription.plan', compact('plan','endDate'));
        }
        
    }

    public function cancel() {
        Auth::user()->subscription('default')->cancel();
        return redirect('plans');
        
    }

    public function resume(){
        Auth::user()->subscription('default')->resume();
        return redirect('plans');
        
    }
}
?>