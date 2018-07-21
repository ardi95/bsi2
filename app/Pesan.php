<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = [
        'jumlah', 'product_id', 'user_id','status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
