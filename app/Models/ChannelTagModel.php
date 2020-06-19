<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelTagModel extends Model
{
    protected  $table = "channel_tag";
    public $timestamp = false;

    protected $fillable = [
        'channel_id',
        'tag_id',
        'created_at',
        'updated_at'
    ];
}
