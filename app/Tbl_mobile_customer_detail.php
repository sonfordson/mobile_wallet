<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

use App\Tbl_mobile_wallet_detail;
use App\Tbl_main_transaction;
use App\Tbl_subtransaction_detail;

class Tbl_mobile_customer_detail extends Model implements Wallet
{
    use HasWallet;

    protected $fillable = [
        'username', 'first_name', 'second_name', 'reg_date', 'id_number',  'phone_number', 'status',
    ];


    public function mobile_wallet()
    {
        return $this->hasOne(Tbl_mobile_wallet_detail::class);
    }

    public function maintransaction()
    {
        return $this->hasMany(Tbl_main_transaction::class);
    }

    public function subtransaction()
    {
        return $this->hasMany(Tbl_subtransaction_detail::class);
    }
}
