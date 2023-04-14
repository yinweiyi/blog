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
        Schema::create('friendships', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('title', 100)->default('')->comment('标题');
            $table->string('link', 100)->default('')->comment('链接');
            $table->string('description')->nullable()->comment('描述');
            $table->unsignedTinyInteger('status')->default(1)->comment('是否开启');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
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
        Schema::dropIfExists('friendships');
    }
};
