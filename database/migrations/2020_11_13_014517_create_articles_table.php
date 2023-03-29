<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('title')->default('')->comment('标题');
            $table->string('slug', 50)->unique()->comment('slug');
            $table->string('author')->default('')->comment('作者');
            $table->unsignedTinyInteger('content_type')->default(1)->comment('内容类型：1-markdown 2-html');
            $table->mediumText('markdown')->nullable()->comment('markdown文章内容');
            $table->mediumText('html')->nullable()->comment('markdown转的html页面');
            $table->string('description')->nullable()->comment('描述');
            $table->string('keywords')->default('')->comment('关键词');
            $table->unsignedTinyInteger('is_top')->default(0)->comment('是否置顶 1是 0否');
            $table->unsignedTinyInteger('is_show')->default(1)->comment('是否显示 1是 0否');
            $table->unsignedInteger('views')->unsigned()->default(0)->comment('浏览量');
            $table->unsignedInteger('order')->unsigned()->default(0)->comment('排序');
            $table->unsignedInteger('category_id')->unsigned()->default(0)->comment('分类ID');
            $table->timestamps();
            $table->softDeletes();
            $table->index('views');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
