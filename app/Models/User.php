<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];



    //########################################### Constants ################################################


    //########################################### Accessors ################################################
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }


    //########################################### Mutators #################################################

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function follows()
    {
        return $this->belongsToMany(self::class,'user_follows','follower_id','followed_id')
                    ->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class,'user_follows','followed_id','follower_id')
                    ->withTimestamps();
    }
}
