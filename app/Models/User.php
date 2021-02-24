<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function setPasswordAttribute($value)
    {
        if (trim($value) === '') {
            return;
        }
        $this->attributes['password'] = bcrypt($value);
    }

    public function scopeSearch($query, $req)
    {
        $query->where(function ($query) use ($req) {
            $query->where('name', 'LIKE', '%' . $req . '%')
                ->orWhere('email', 'LIKE', '%' . $req . '%');
        });
    }
}
