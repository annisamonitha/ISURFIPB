<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelModel extends Model
{
    protected  $table = "table_channels";
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
}
