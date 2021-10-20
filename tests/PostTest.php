<?php

use App\Models\Post;
use App\Models\Token;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreatePost()
    {
        $this->json('POST', '/api/posts',
            [
                'title' => 'Create Test',
                'token'=> "DEV",
                'content'=>'TEST Content'
            ]
        )->seeJson(['status'=>true])->seeInDatabase('posts', ['title' => 'Create Test']);
    }

    public function testEditPost(){
        $post = Post::factory()->create();
        $this->json('POST', "/api/posts/$post->id",
            [
                'title' => 'Edit Test',
                'token'=> "DEV",
                'content'=>'Edit Content'
            ]
        )->seeJson(['status'=>true])->seeInDatabase('posts', ['title' => 'Edit Test']);
    }
}
