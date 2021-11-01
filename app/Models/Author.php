<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravolt\Avatar\Avatar;

class Author extends Model
{
    use Cachable;

    protected $cacheCooldownSeconds = 1800; // 30 minutes]

    protected $table = 'authors';

    protected $fillable = [
        'email','social','name','desc','avatar'
    ];

    public function tokens(): HasMany
    {
        return $this->hasMany('App\Models\Token','author_id','id');
    }

    public function getAvatarAttribute($value)
    {
        if (empty($value)){
            $path = base_path('public/img/avatar/'.$this->attributes['name'].".svg");
            if (file_exists($path)){
                return url('img/avatar/'.$this->attributes['name'].".svg");
            }else{
                $avatar = new Avatar();
                file_put_contents($path,$avatar->create($this->attributes['name'])->toSvg());
                return url('img/avatar/'.$this->attributes['name'].".svg");
            }
        }else{
            return $value;
        }
    }
}
