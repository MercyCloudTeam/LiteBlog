<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show(Request $request)
    {
        return response()->json(Post::paginate(100)->toArray());
    }


}
