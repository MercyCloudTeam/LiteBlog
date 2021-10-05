<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $fileable = [
        'email','social','name','desc','avatar'
    ];
}
