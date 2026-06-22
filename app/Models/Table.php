<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['nomor_meja', 'kode_qr'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
