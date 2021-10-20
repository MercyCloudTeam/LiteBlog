<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use Cachable;

    protected $table = 'authors';

    public $fillable = [
        'email','social','name','desc','avatar'
    ];

    public function tokens()
    {
        return $this->hasMany('App\Models\Token','author_id','id');
    }
}
