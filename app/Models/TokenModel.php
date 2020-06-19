<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    protected  $table = "table_token";
    public $timestamp = false;

    protected $fillable = [
        'channel_id',
        'token',
        'created_at',
        'updated_at'
    ];
}
