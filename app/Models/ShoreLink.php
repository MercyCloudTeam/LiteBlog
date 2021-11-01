<?php

namespace App\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class ShoreLink extends Model
{
    use Cachable;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'shore_links';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code','url'
    ];

    public static function shoreUrl(string $url,$fail = 0)
    {
        $code = Str::random(8);
        $link = ShoreLink::where('url',$url)->limit(1);
        if ($link->exists()){
            return route('shoreLink',['code'=>$link->first()->code]);
        }
        try {
            ShoreLink::create([
                'url'=>$url,
                'code'=>$code
            ]);
        }catch (QueryException $exception){//如果是SQL语句错误（CODE重复），则重新执行（最大失败5次）
            $fail++;
            if ($fail < 5){
                self::shoreUrl($url,$fail);
            }else{
                report($exception);
                return false;
            }
        }
        return route('shoreLink',['code'=>$code]);

    }


}
