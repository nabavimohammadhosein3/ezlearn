<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Group;
use App\Models\Buy;
use App\Models\File;
use App\Models\Image;

class Package extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function buys()
    {
        return $this->morphMany(Buy::class, 'buyable');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function level()
    {
        $levels = ['مقدماتی', 'متوسط', 'پیشرفته'];
        return $levels[$this->level - 1];
    }
}
