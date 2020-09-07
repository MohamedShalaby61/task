<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        DB::table('order_statuses')->insert([
            'status' => 'pending',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'processing',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'shipping',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'delivered',
        ]);

        DB::table('order_statuses')->insert([
            'status' =>'returned',
        ]);

        // $this->call("OthersTableSeeder");
    }
}
