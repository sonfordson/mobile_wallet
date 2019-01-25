<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(ChargesTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(MobileWalletDetailsTableSeeder::class);
        // $this->call(BusinessAccountTableSeeder::class);

    }
}
