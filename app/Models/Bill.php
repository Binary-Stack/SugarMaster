<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [ 
        'bills',
        'consumer_id',
        'kgg',
        'kg',
    ];
    public function consumer(){
        return $this->belongsTo(Consumer::class);
    }

    //
}
