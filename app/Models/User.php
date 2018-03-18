<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone_number',
        'work',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function certs()
    {
        return $this->hasMany('App\Models\Cert');
    }
    public function comments()
    {
        return $this->hasMany(Cert::class);
    }
    public static function getAllUsers()
    {
        return self::orderBy('id', 'desc')
            ->get();
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public static function getAllWork()
    {
        return array(
            'Chi nhánh quận Hai Bà Trưng',
            'Chi nhánh quận Hoàng Mai',
            'Chi nhánh quận Thanh Xuân'
        );
    }

    public static function checkAccount($email, $password)
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }
}
