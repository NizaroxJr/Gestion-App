<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;

class SubscriptionsPaymentController extends Controller
{
     public function index() {
        $this->authorize('canSubscribe');
        $data = [
            'intent' => auth()->user()->createSetupIntent()
        ];

        return view('admin.subscription.payments')->with($data);
    }

    public function store(Request $request) {
        $this->authorize('canSubscribe');
        $this->validate($request, [
            'token' => 'required'
        ]);

        $plan = Plans::where('identifier', $request->plan)
            ->orWhere('identifier', 'basic')
            ->first();
        
        $request->user()->newSubscription('default', $plan->stripe_id)->create($request->token);

        return back()->with('success','Subscription is completed.');
        
    }

    
}
