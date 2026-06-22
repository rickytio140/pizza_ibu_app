<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu_category_id',
        'nama',
        'harga',
        'harga_small',
        'harga_medium',
        'harga_large',
        'gambar',
        'is_available',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
