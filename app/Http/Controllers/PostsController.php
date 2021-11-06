<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Parsedown;

class PostsController extends Controller
{

    public function show(Request $request)
    {
        //todo 时间条件 返回条件
        $perPage = $request->perPage ?? 50;
        // return $this->apiResult(['type'=>'liteblog','list'=>Post::where('sync',true)->get()->toArray()]);
        return $this->apiResult(['type'=>'liteblog','paginate'=>Post::paginate($perPage)]);
    }

    public function markdownToPosts(string $text,string $title)
    {
        $parsedown = new Parsedown();
        $content = $parsedown->text($text);//获取文章全文
    }

    public function download(string $post)
    {
        $post = Post::find($post);
        if (empty($post)){
            return $this->apiResult([],false,'文章不存在');
        }
        return ;
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
        $this->clearCache($post);
        return $this->apiResult();
    }

    /**
     * 创建文章
     * @param Request $request
     * @return JsonResponse
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
     */
    public function update(Request $request,$post): JsonResponse
    {
        $post = Post::find($post);
        if (empty($post)){
            return $this->apiResult([],false,'文章不存在');
        }
        return $this->updateOrStore($request,$post);
    }


    public function detail(Request $request,string $post)
    {
        $post = Post::find($post);
        if (empty($post)){
            return $this->apiResult([],false,'文章不存在');
        }
        return $this->apiResult($post->toArray());
    }

    /**
     * 创建或更新文章操作
     * @param Request $request
     * @param Post|null $post
     * @return JsonResponse
     */
    protected function updateOrStore(Request $request,Post $post = null): JsonResponse
    {
        if (empty($post)){
            $unique = Rule::unique('posts','title');
            empty($request->subtitle) ? $subtitle = substr($request['content'],0,100) : $subtitle = $request['subtitle'];
        }else{
            $unique = Rule::unique('posts','title')->ignore($post);
            empty($request->subtitle) ? $subtitle = $post->subtitle : $subtitle = $request['subtitle'];
        }

        //验证
        $validator = Validator::make($request->all(),[
            'title'=>['string','max:100','required',$unique],
            'lang'=>['string','max:10','nullable'],
            'pid'=>['nullable','exists:posts,id'],
            'status'=>['integer','nullable'],
            'content'=>['string','required'],
            'subtitle'=>['string','nullable','max:200'],
            'config'=>['array','nullable'],
            'tags'=>['array','nullable'],
            'category'=>['array','nullable'],
        ]);
        if ($validator->fails()) {//验证错误返回
            return $this->apiResult($validator->failed(),false,'参数错误');
        }
        isset($request->author_encrypt) ?  $author_id = Crypt::decryptString($request->author_encrypt) : $author_id = null;

        //操作
        $update = [
            'title'=>$request['title'],
            'uuid'=>$post->uuid ?? Str::uuid(),
            'lang'=>$request['lang'],
            'subtitle'=>$subtitle,
            'pid'=>$request['pid'],
            'content'=>$request['content'],
            'author_id'=>$author_id,
            'sync'=>$request['sync'] ?? true,
            'status'=>$request['status'] ?? 1,
            'config'=>$request['config']
        ];
        if (empty($post)){
            $status = Post::create($update);
        }else{
            $status =  Post::find($post->id)->update($update);
        }

//        TODO 创建关联类别及TAG

        if ($status){
            $this->clearCache($post);
            return $this->apiResult();
        }

        return $this->apiResult([],false,'文章创建、更新失败');
    }

    /**
     * 清楚页面缓存
     * @param Post|null $post
     */
    protected function clearCache(Post $post = null)
    {
        Artisan::call('page-cache:clear',['slug'=>'pc__index__pc']);//清除首页缓存
        if (!empty($post)){
            $title = str_replace(' ','-',$post->title);
            Artisan::call('page-cache:clear',['slug'=>"p/{$title}"]);//清除首页缓存
        }
    }
}
