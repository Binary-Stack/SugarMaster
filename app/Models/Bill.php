<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [ 
        'bills',
        'images',
        'type_branch',
        'consumer_id',
        'kgg',
        'kg',
    ];
    public function consumer(){
        return $this->belongsTo(Consumer::class);
    }

    //
}
