<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_business_account extends Model
{
    protected $fillable = [
        'uuid', 'account_no', 'account_name', 'status', 'account_balance', 'last_activity',
    ];


}
