<?php

use Illuminate\Database\Seeder;
use Modules\Order\Database\Seeders\StatusTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableSeeder::class);
    }
}
