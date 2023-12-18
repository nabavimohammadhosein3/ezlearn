<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
