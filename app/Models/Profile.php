<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'about', 'phone', 'social_networks'];


    public function getSocialNetworksAttribute()
    {
        return $this->attributes['social_networks']  ? json_decode($this->attributes['social_networks'], true) : [];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
