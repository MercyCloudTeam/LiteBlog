<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use Cachable;

    public $fileable = [
        'name','desc','pid'
    ];

    /**
     * 拥有此角色的用户
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Post');
    }

}
