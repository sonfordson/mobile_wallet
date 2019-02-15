<?php

use Illuminate\Database\Seeder;

use App\Tbl_mobile_wallet_detail;

class MobileWalletDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $wallet1 = Tbl_mobile_wallet_detail::create([
            'username' => 'Risper',
            'firstname' => 'Onyango',
            'secondname' => 'Otieno',
            'status' => 'true',
            'account_balance' => '7000',
            'reg_date' => date('Y-m-d H:i:s'),
            'last_activity' => 'Transaction actiivty',
            'phone_number' => '0742074587',
            'pin' => '2345'

        ]);

        $wallet2 = Tbl_mobile_wallet_detail::create([
            'username' => 'Derth',
            'firstname' => 'Veder',
            'secondname' => 'Derth',
            'status' => 'false',
            'account_balance' => '3000',
            'reg_date' => date('Y-m-d H:i:s'),
            'last_activity' => 'Login actiivty',
            'phone_number' => '0762074587',
            'pin' => '3345'

        ]);

        $wallet3 = Tbl_mobile_wallet_detail::create([
            'username' => 'Atieno',
            'firstname' => 'Onyango',
            'secondname' => 'Seth',
            'status' => 'true',
            'account_balance' => '3000.40',
            'reg_date' => date('Y-m-d H:i:s'),
            'last_activity' => 'Transaction actiivty',
            'phone_number' => '0752074587',
            'pin' => '9345'

        ]);

        $wallet4 = Tbl_mobile_wallet_detail::create([
            'username' => 'Ken',
            'firstname' => 'Onyango',
            'secondname' => 'Mike',
            'status' => 'true',
            'account_balance' => '100000',
            'reg_date' => date('Y-m-d H:i:s'),
            'last_activity' => 'Transaction actiivty',
            'phone_number' => '0752074587',
            'pin' => '6345'

        ]);

        $wallet5 = Tbl_mobile_wallet_detail::create([
            'username' => 'Nas',
            'firstname' => 'Ben',
            'secondname' => 'Otieno',
            'status' => 'true',
            'account_balance' => '36700',
            'reg_date' => date('Y-m-d H:i:s'),
            'last_activity' => 'Transaction actiivty',
            'phone_number' => '0742074587',
            'pin' => '3345'

        ]);


    }
}
