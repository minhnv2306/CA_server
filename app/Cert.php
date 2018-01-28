<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cert extends Model
{
    protected $guarded = ['price'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
