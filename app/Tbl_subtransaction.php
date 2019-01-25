<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tbl_mobile_customer_detail;



class Tbl_subtransaction extends Model
{
    protected $fillable = [
        'uuid', 'request_id', 'receipt', 'phone', 'amount_type', 'amount', 'transaction_type',


    ];

    public function customer_detail()
    {
        return $this->belongsTo(Tbl_mobile_customer_detail::class);
    }
}
