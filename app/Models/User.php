<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
    public function catrgory()
    {
        return $this->hasMany(Category::class);
    }


    public function mobile()
    {
        return $this->hasMany(Mobile::class);
    }


    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }


    public function slider()
    {
        return $this->hasMany(Slider::class);
    }


    public function comment()
    {
        return $this->hasMany(Comment::class);
    }


    public function view()
    {
        return $this->hasMany(View::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
