<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    protected  $table = "tags";
    public $timestamp = false;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
}
