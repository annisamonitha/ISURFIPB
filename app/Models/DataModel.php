<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{
    protected  $table = "data";
    public $timestamp = false;

    protected $fillable = [
        'nilai',
        'date',
        'time',
        'field_id',
        'created_at',
        'updated_at'
    ];
}
