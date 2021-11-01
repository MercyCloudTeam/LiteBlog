<?php

use App\Models\Post;
use App\Models\Token;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
//    use DatabaseTransactions;

    public function testCreatePost()
    {
        $title = 'Create Test '.time();
        $this->json('POST', '/api/posts',
            [
                'title' => $title,
                'token'=> "DEV",
                'content'=>'TEST Content'
            ]
        )->seeJson(['status'=>true])->seeInDatabase('posts', ['title' => $title]);
    }

    public function testEditPost(){
        $post = Post::factory()->create();
        $title =  'Edit Test '.time();
        $this->json('POST', "/api/posts/$post->id",
            [
                'title' =>$title,
                'token'=> "DEV",
                'content'=>'Edit Content'
            ]
        )->seeJson(['status'=>true])->seeInDatabase('posts', ['title' => $title]);
    }
}
