<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    public function parent()
    {
        return $this->belongsTo(Group::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Group::class, 'parent_id');
    }
}
