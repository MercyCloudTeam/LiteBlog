<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Parsedown;

class PostsController extends Controller
{

    public function show(Request $request)
    {
        return response()->json(Post::paginate(100)->toArray());
    }

    public function markdownToPosts(string $text,string $title)
    {
        $parsedown = new Parsedown();
        $content = $parsedown->text($text);//获取文章全文
//        Post::create([
//            'title'=>$title;
//        ])
    }

    public function search(Request $request)
    {
        //简单搜索 利用mysql like实现的搜索
        $this->validate($request,[
            'search'=>'string|max:50|min:1',
        ]);


    }


    // TODO tag分析(将内容出现tag词汇的替换进a标签)
    public function tagToContent()
    {

    }

    public function delete($post)
    {
        $post = Post::find($post);
        if (empty($post)){
            return $this->apiResult([],false,'文章不存在');
        }
        $post->delete();
        return $this->apiResult();
    }

    /**
     * 创建文章
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        return $this->updateOrStore($request);
    }

    /**
     * 更新文章
     * @param Request $request
     * @param $post
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,$post): JsonResponse
    {
        $post = Post::find($post);
        if (empty($post)){
            return $this->apiResult([],false,'文章不存在');
        }
        return $this->updateOrStore($request,$post);
    }

    /**
     * 创建或更新文章操作
     * @param Request $request
     * @param Post|null $post
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function updateOrStore(Request $request,Post $post = null): JsonResponse
    {
        empty($post) ? $unique = "unique:posts,title" : $unique = "unique:posts,title,$post->title";

        $this->validate($request,[
            'title'=>'string|'.$unique. '|max:100|required',
            'lang'=>'string|max:10|nullable',
            'pid'=>'nullable|exists:posts,id',
            'status'=>'integer|nullable',
            'content'=>'string|required',
            'config'=>'array|nullable'
        ]);

        isset($request->author_encrypt) ?  $author_id = Crypt::decryptString($request->author_encrypt) : $author_id = null;

        $status = Post::updateOrInsert([
            'title'=>$request['title'],
        ],[
            'uuid'=>$post->uuid ?? Str::uuid(),
            'lang'=>$request['lang'],
            'pid'=>$request['pid'],
            'content'=>$request['content'],
            'author_id'=>$author_id,
            'sync'=>$request['sync'] ?? true,
            'status'=>$request['status'] ?? 1,
            'config'=>$request['config']
        ]);

//        TODO 创建关联类别及TAG

        if ($status){
            return $this->apiResult();
        }

        return $this->apiResult([],false,'文章创建、更新失败');
    }
}
