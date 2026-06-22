<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'metode', 'status', 'waktu_bayar', 'nominal_bayar', 'kembalian'];

    protected $casts = [
        'waktu_bayar' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
