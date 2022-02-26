<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $stripeStandard=$this->stripe->products->create([
            'name' => 'Standard',
        ]);

        $stripeStandardCreation=$this->stripe->plans->create([
            'amount' => 10,
            'currency' => 'usd',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeStandard->id,
        ]);

        Plan::create(['name'=>'Standard',
                      'slug'=>'standard',
                      'cost'=>'10',
                      'stripe_plan'=>$stripeStandardCreation->id,
                      'usersNumber'=>'3',
                      'warehousesNumber'=>'2',
                      'productsNumber'=>'100',
                      'suppliersNumber'=>'10'
        ]);

        $stripeProfessional=$this->stripe->products->create([
            'name' => 'Professional',
        ]);

        $stripeProfessionalCreation=$this->stripe->plans->create([
            'amount' => 20,
            'currency' => 'usd',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeProfessional->id,
        ]);

        Plan::create(['name'=>'Professional',
                      'slug'=>'professional',
                      'cost'=>'20',
                      'stripe_plan'=>$stripeProfessionalCreation->id,
                      'usersNumber'=>'6',
                      'warehousesNumber'=>'4',
                      'productsNumber'=>'200',
                      'suppliersNumber'=>'20'
        ]);
        
        $stripePremium=$this->stripe->products->create([
            'name' => 'Premium',
        ]);

        $stripePremiumCreation=$this->stripe->plans->create([
            'amount' => 40,
            'currency' => 'usd',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripePremium->id,
        ]);

        Plan::create(['name'=>'Premium',
                      'slug'=>'premium',
                      'cost'=>'40',
                      'stripe_plan'=>$stripePremiumCreation->id,
                      'usersNumber'=>'12',
                      'warehousesNumber'=>'8',
                      'productsNumber'=>'400',
                      'suppliersNumber'=>'40'
        ]);
    }
}