<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function view()
    {
        return $this->hasMany(View::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    
}
