<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->index()->unique();//标题唯一
            $table->string('lang',10)->nullable()->default('zh_CN');
            $table->bigInteger('pid')->nullable();//如果存在则算为一篇子文章
            $table->text('content');
            $table->bigInteger('author_id')->nullable();//作者
            $table->boolean('sync')->default(true);//是否同步
            $table->uuid('uuid');//唯一ID，允许不同站点文章ID不同
            $table->integer('status')->default(1);
            $table->json('config')->nullable();//针对文章的各种配置

            $table->softDeletes();
            $table->timestamps();
        });

        //类别
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('desc')->nullable();//类别描述
            $table->bigInteger('pid')->nullable();
            $table->timestamps();
        });

        //文章分组
        Schema::create('category_post',function (Blueprint $table) {
            $table->bigInteger('category_id');
            $table->bigInteger('post_id');
        });

        //标签
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->timestamps();
        });

        //标签关联
        Schema::create('taggable', function (Blueprint $table) {
            $table->bigInteger('tag_id');
            $table->bigInteger('taggable_id');
            $table->string('taggable_type');
        });

        //评论
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip');//评论者IP
            $table->string('name',100);//没有名称就无法判断评论者是否真实，但又不想使用Disque
            $table->text('content');
            $table->integer('status')->default(1);
            $table->bigInteger('post_id');
            $table->timestamps();
        });

        //作者
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('email',100);//关联gv头像
            $table->json('social')->nullable();//社交联系方式
            $table->string('name',50);//名称
            $table->string('desc',150)->nullable();//描述
            $table->string('avatar',100)->nullable();//头像

            $table->timestamps();
        });

        //密钥
        Schema::create('tokens',function (Blueprint $table){
            $table->id();
            $table->string('token',64)->index();
            $table->bigInteger('author_id')->nullable();
            $table->string('permissions',20)->default('user');//权限功能，权限写死，并无分配等
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_post');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggable');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('tokens');
    }
}
