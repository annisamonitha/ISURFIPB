<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected  $table = "users";
    public $timestamp = false;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    public function channel()
    {
        return $this->hasMany(Channel::class);
    }
}
