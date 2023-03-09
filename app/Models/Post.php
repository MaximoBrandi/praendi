<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function socials(){
        return $this->hasMany(Social::class);
    }

    public function user_liked(){
        if ($this->likes->where('user_id', Auth::user()->id)->first()) {
            return $this->likes->where('user_id', Auth::user()->id)->first();
        } else {
            return null;
        }
    }

    public function incrementReadCount() {
        $this->reads++;
        return $this->save();
    }

    protected $casts = [
        'multimedia' => 'boolean',
    ];

}
