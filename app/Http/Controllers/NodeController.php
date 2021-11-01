<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class NodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function syncWordpressPosts(string $content)
    {
        $endpoint = "";

    }

    public function syncPosts()
    {
        $type = '';
        $content = Http::get('');
        switch ($type){
            case "wordpress":
                $this->syncWordpressPosts($content);
        }
    }


    //
}
