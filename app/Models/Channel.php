<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected  $table = "channels";
    public $timestamp = false;

    protected $fillable = [
        'name',
        'device_type',
        'micon_type',
        'metadata',
        'description',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->hasMany(Field::class);
    }
}
