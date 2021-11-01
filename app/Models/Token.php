<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Cachable;

    protected $cacheCooldownSeconds = 1800; // 30 minutes]

    protected $fillable = [
        'token','author_id','permissions'
    ];

    public function author()
    {
        return $this->hasOne('App\Models\Author','id','author_id');
    }
}
