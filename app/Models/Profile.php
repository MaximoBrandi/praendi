<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Searchable;

class Profile extends Model
{
    use SoftDeletes, Searchable;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'user_id',
        'social',
        'contact',
        'pfp'
    ];

    protected function social(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function contact(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follows(){
        return $this->hasMany(Follow::class);
    }

    public function followers(){
        return $this->hasMany(Follow::class, 'followed_profile_id');
    }
}
