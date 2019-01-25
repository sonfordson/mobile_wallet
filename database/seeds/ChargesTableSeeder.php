<?php

use Illuminate\Database\Seeder;

use App\Tbl_charge;

class ChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charge1 = Tbl_charge::create([
            'min' => '0',
            'max' => '1000',
            'withdraw_charges' => '0',
            'unregistered_user' => '0',
            'registered_user' => '0',
        ]);

        $charge2 = Tbl_charge::create([
            'min' => '1001',
            'max' => '10000',
            'withdraw_charges' => '112',
            'unregistered_user' => '205',
            'registered_user' => '87',
        ]);

        $charge3 = Tbl_charge::create([
            'min' => '10001',
            'max' => '30000',
            'withdraw_charges' => '180',
            'unregistered_user' => '288',
            'registered_user' => '102',
        ]);

        $charge4 = Tbl_charge::create([
            'min' => '30001',
            'max' => '50000',
            'withdraw_charges' => '270',
            'unregistered_user' => 'NA',
            'registered_user' => '150',
        ]);

        $charge5 = Tbl_charge::create([
            'min' => '50001',
            'max' => '7000',
            'withdraw_charges' => '300',
            'unregistered_user' => 'NA',
            'registered_user' => '150',
        ]);
    }
}
