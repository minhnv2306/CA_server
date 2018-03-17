<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function cert()
    {
        return $this->belongsTo('App\Cert');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
