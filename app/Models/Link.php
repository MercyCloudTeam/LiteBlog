<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Link extends Model
{
    use Cachable;

    protected $fillable = [
        'name','url','img','desc','sync'
    ];


}
