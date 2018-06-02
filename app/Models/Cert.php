<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cert extends Model
{
    protected $guarded = ['price'];
    protected $table = 'certs1.certs';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get base of list cert
     * @param array $param
     * @return $this
     */
    public static function getBaseList($param = array())
    {
        $query = self::select('*')
            ->orderBy('id', 'desc');
        if (isset($param['status'])) {
            $query = $query->where('status', $param['status']);
        }
        return $query;
    }

    /**
     * Get list certs with status (use or don't use)
     * @param $status
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getCertWithStatus($status, $user = null)
    {
        $param = array(
            'status' => $status
        );
        if (empty($user)) {
            return self::getBaseList($param)
                ->get();
        } else {
            return self::getBaseList($param)
                ->where('user_id', $user->id)
                ->get();
        }
    }

    /**
     * Get all cert in database
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllCerts($user = null)
    {
        if (empty($user)) {
            return self::getBaseList()
                ->get();
        } else {
            return self::getBaseList()
                ->where('user_id', $user->id)
                ->get();
        }
    }

    /**
     * Get status of cert
     * @return array
     */
    public static function getStatus()
    {
        return array(
            '0' => 'Hết hạn',
            '1' => 'Còn hạn'
        );
    }

    /**
     * Get detail of 1 status
     * @param $key
     * @return mixed|string
     */
    public static function getDetailStatus($key)
    {
        $status = self::getStatus();
        if (!empty($status)) {
            return $status[$key];
        }
        return '';
    }

    /**
     * Get list cert of between day
     * @param $start_day
     * @param $end_day
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getCertBetweenDay($start_day, $end_day)
    {
        return self::getBaseList()
            ->where([
                ['created_at', '>=', $start_day],
                ['created_at', '<=', $end_day],
            ])->get();
    }
}
