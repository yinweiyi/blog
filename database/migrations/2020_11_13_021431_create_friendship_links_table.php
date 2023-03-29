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
        Schema::create('friendship_links', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('title', 100)->default('')->comment('标题');
            $table->string('link', 100)->default('')->comment('链接');
            $table->string('description')->nullable()->comment('描述');
            $table->unsignedTinyInteger('is_enable')->default(0)->comment('是否开启');
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
        Schema::dropIfExists('friendship_links');
    }
};
