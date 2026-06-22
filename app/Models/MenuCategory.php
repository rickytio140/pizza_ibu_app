<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
