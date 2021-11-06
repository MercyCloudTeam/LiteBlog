<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use App\Models\ShoreLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Lumen\Application;
use Laravel\Lumen\Http\Redirector;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Parsedown;

class BlogController extends Controller
{
    /**
     * 首页
     * @return View|Application
     */
    public function index()
    {
        $posts = Post::latest()->paginate(4);
        return view('index',compact('posts'));
    }

    /**
     * @param Request $request
     * @return View|Application
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

    /**
     * 通过标题跳转文章
     * @param $title
     * @return View|Application
     */
    public function postsTitle($title)
    {
        $post = Post::where('title',urldecode(str_replace('-',' ',$title)))->limit(1)->first();
        if (empty($post)){
            return view("errors.404");
        }
        return $this->posts($post);
    }

    /**
     * 通过文章ID访问文章
     * @param $id
     * @return View|Application
     */
    public function postsId($id)
    {
        $post = Post::find($id);
        if (empty($post)){
            return view("errors.404");
        }
        return $this->posts($post);
    }

    /**
     * 通过文章UUID访问文章
     * @param $uuid
     * @return RedirectResponse|View|Application|Redirector
     */
    public function postsUUID($uuid)
    {
        $post = Post::where('uuid',$uuid)->limit(1)->first();;
        if (empty($post)){
            return view("errors.404");
        }
        return redirect(route('postsId',['id'=>$post->id]));
    }


    /**
     * 返回文章页面
     * @param Post $post
     * @return View|Application
     */
    public function posts(Post $post)
    {
        $parsedown = new Parsedown();
        $post->content = $parsedown->text($post->content);
        return view('posts',compact('post'));
    }

    /**
     * 短链接跳转
     * @param string $code
     * @return RedirectResponse|View|Application|Redirector
     */
    public function shoreLink(string $code)
    {
        $link = ShoreLink::find($code);
        if (!empty($link)){
            return redirect($link->url);
        }
        return view('errors.404');

    }

    /**
     * @return View|Application
     */
    public function tags()
    {
        return view('tags');
    }

    /**
     * @return View|Application
     */
    public function categories()
    {
        $categories = Category::latest()->paginate(4);
        return view('categories',compact('categories'));
    }

    /**
     * @return View|Application
     */
    public function links()
    {
        $links = Link::latest()->paginate(12);
        return view('links',compact('links'));
    }
}
