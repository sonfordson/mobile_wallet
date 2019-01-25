<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tbl_mobile_customer_detail;

class Tbl_main_transaction extends Model
{
    protected $fillable = [
        'uuid', 'request_id', 'receipt', 'partya', 'partyb', 'amount', 'date', 'status', 'charge',
    ];



    public function scopeUserTransfers($query, $user)
    {
        return $query->where('from', $user);
    }

    public function scopeUserReceipts($query, $user)
    {
        return $query->where('to', $user);
    }



    public function customer_wallet()
    {
        return $this->belongsTo(Tbl_mobile_customer_detail::class);
    }

}
