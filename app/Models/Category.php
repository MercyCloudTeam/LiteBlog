<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fileable = [
        'name','desc','pid'
    ];

    /**
     * 拥有此角色的用户
     */
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

}
