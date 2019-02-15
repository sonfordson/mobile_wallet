<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tbl_mobile_customer_detail;

class Tbl_mobile_wallet_detail extends Model
{
    protected $fillable = [
        'username', 'firstname', 'secondname', 'reg_date', 'account_balance', 'last_activity', 'phone_number', 'pin', 'status',
    ];

    public function customer_wallet()
    {
        return $this->belongsTo(Tbl_mobile_customer_detail::class);
    }

}
