<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_charge extends Model
{
    protected $fillable = [
        'min', 'max', 'withdraw_charges', 'send_to_unregistered_user', 'send_to_registered_user',
    ];

}
