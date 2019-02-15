<?php

use Illuminate\Database\Seeder;


use App\Tbl_mobile_customer_detail;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer1 = Tbl_mobile_customer_detail::create([
            'username' => 'Sonford',
            'first_name' => 'Onyango',
            'second_name' => 'Otieno',
            'id_number' => '27064104',
            'status' => 'true',
            'reg_date' => date('Y-m-d H:i:s'),
            'phone_number' => '0742074587'

        ]);

        $customer2 = Tbl_mobile_customer_detail::create([
            'username' => 'Son',
            'first_name' => 'Veder',
            'second_name' => 'Derth',
            'id_number' => '37064109',
            'status' => 'false',
            'reg_date' => date('Y-m-d H:i:s'),
            'phone_number' => '0762074587'

        ]);

        $customer3 = Tbl_mobile_customer_detail::create([
            'username' => 'Timothy',
            'first_name' => 'Radier',
            'second_name' => 'Orwa',
            'id_number' => '45064104',
            'status' => 'true',
            'reg_date' => date('Y-m-d H:i:s'),
            'phone_number' => '0732074587'
        ]);

        $customer4 = Tbl_mobile_customer_detail::create([
            'username' => 'Kopiyo',
            'first_name' => 'Steve',
            'second_name' => 'Otieno',
            'id_number' => '1264104',
            'status' => 'false',
            'reg_date' => date('Y-m-d H:i:s'),
            'phone_number' => '0722074587'
        ]);

        $customer5 = Tbl_mobile_customer_detail::create([
            'username' => 'John',
            'first_name' => 'Kamau',
            'second_name' => 'Oyugi',
            'id_number' => '35064104',
            'status' => 'true',
            'reg_date' => date('Y-m-d H:i:s'),
            'phone_number' => '0712074587'
        ]);
    }
}
