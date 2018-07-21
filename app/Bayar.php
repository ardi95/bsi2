<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $fillable = [
        'statusbayar', 'totalbayar', 'user_id','foto'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
