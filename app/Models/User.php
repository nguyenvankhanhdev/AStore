<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function usercoupons()
    {
        return $this->hasMany(UserCoupons::class, 'user_id', 'id');
    }

    public function userRatings()
    {
        return $this->hasMany(Ratings::class, 'user_id', 'id');
    }
    public function userAddress()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
    }

    public static function getPoint()
    {
        $user = User::find(Auth::id());
        return $user->point;
    }


    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }
}
