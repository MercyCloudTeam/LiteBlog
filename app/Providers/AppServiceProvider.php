<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Validator::excludeUnvalidatedArrayKeys();
        Relation::morphMap([
            'posts' => 'App\Models\Post',
            'author' => 'App\Models\Author',
        ]);
    }
}
