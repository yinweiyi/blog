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
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('title', 50)->comment('网站标题');
            $table->string('sub_title', 50)->comment('子标题');
            $table->string('keywords', 50)->comment('关键字');
            $table->string('icp', 50)->comment('icp备案号');
            $table->string('beian', 50)->comment('公安备案号');
            $table->string('author', 50)->comment('网站作者');
            $table->string('description')->comment('网站描述');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
};
