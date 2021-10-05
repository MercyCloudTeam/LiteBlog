<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $fileable = [
        'token','author_id'
    ];
}
