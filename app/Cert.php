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
    public static function getAllCerts()
    {
        return self::orderBy('id', 'desc')
            ->get();
    }
}
