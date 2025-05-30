<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTax extends Model
{
    //
    protected $fillable = [
        'order_id',
        'tax_id',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function tax()
    {
        return $this->belongsTo(BusinessSetting::class, 'tax_id');
    }
}
