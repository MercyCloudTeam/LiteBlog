<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //友链
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('url',100);
            $table->string('img',100)->nullable();
            $table->string('desc',150)->nullable();//描述
            $table->boolean('sync')->default(false);
            $table->timestamps();
        });

        //短链
        Schema::create('shore_links',function (Blueprint $table){
            $table->string('code')->index()->unique();
            $table->string('url',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
        Schema::dropIfExists('shore_links');
    }
}
