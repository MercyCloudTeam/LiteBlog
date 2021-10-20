<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Cachable,HasFactory,SoftDeletes;

    protected $casts = [
        'config'=>'json'
    ];

    public $fileable = [
        'title','lang','pid','content','author_id','sync','uuid','status','config'
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
