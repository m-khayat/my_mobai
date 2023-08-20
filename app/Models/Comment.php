<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function mobile()
    {
        return $this->belongsTo(Mobile::class);
    }
}
