<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    public $fileable = [
        'title','content','author_id'
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
