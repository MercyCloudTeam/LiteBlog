<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
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


    public function index()
    {
//        ->with(['category','tags'])
        $posts = Post::latest()->paginate(9);
        return view('index',compact('posts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     * @throws \Illuminate\Validation\ValidationException
     */
    public function search(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required|max:100'
        ]);
        $posts = Post::where('title','like',"%{$request['title']}%")->paginate(15);
        return view('index',compact('posts'))->with('search',$request['title']);
    }


    public function posts(Post $post)
    {
        return view('posts',compact('post'));
    }
    //
}
