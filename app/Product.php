<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'nama', 'harga', 'deskripsi', 'foto'
    ];

    public function pesans()
    {
        return $this->hasMany('App\Pesan');
    }
}
