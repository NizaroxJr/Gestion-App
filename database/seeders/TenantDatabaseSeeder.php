<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //$this->call(ProductSeeder::class);
       $this->call(SupplierSeeder::class);
       //$this->call(ClientSeeder::class);
    }
}
