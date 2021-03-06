<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    use Cachable;

    protected $fillable = [
        'ip','name','content','post_id'
    ];


}
