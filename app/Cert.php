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
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public static function getAllCerts()
    {
        return self::orderBy('id', 'desc')
            ->get();
    }
    public static function getStatus()
    {
        return array(
            '0' => 'Hết hạn',
            '1' => 'Còn hạn'
        );
    }
    public static function getDetailStatus($key)
    {
        $status = self::getStatus();
        if (!empty($status)) {
            return $status[$key];
        }
        return '';
    }
    public static function getCertBetweenDay($start_day, $end_day)
    {
        return Cert::where([
            ['created_at', '>=', $start_day],
            ['created_at', '<=', $end_day],
        ])->get();
    }
}
