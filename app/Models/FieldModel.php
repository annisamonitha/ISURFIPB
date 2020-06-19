<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldModel extends Model
{
    protected  $table = "fields";
    public $timestamp = false;

    protected $fillable = [
        'name',
        'channel_id',
        'created_at',
        'updated_at'
    ];
}
