<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * 获取被打上此标签的所有文章
     */
    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }

    /**
     * 获取被打上此标签的所有视频
     */
    public function author()
    {
        return $this->morphedByMany('App\Models\Author', 'taggable');
    }

}
