<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelTag extends Model
{
    protected  $table = "channel_tag";
    public $timestamp = false;

    protected $fillable = [
        'channel_id',
        'tag_id',
        'created_at',
        'updated_at'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function data()
    {
        return $this->hasOne(Tag::class);
    }
}
