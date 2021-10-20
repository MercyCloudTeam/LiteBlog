<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LiteBlogServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $configs = config('liteblog') ?? [];
        $this->registerConfigView($configs);

    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * 注册配置到视图
     * @param array $configs
     */
    protected function registerConfigView(array $configs)
    {
        foreach ($configs as $k=>$v){
            View::share($k,$v);
        }
    }
}
