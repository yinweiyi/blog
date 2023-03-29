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
        Schema::create('guestbook', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->unsignedTinyInteger('content_type')->default(1)->comment('内容类型：1-markdown 2-html');
            $table->mediumText('markdown')->nullable()->comment('markdown文章内容');
            $table->mediumText('html')->nullable()->comment('markdown转的html页面');
            $table->unsignedTinyInteger('can_comment')->default(1)->comment('是否开放评论');
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
        Schema::dropIfExists('guestbook');
    }
};
