<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected  $table = "fields";
    public $timestamp = false;

    protected $fillable = [
        'name',
        'sensor',
        'channel_id',
        'created_at',
        'updated_at'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
