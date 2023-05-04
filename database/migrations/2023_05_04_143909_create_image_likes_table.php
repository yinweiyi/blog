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
        Schema::create('image_likes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ip')->comment('ip');
            $table->bigInteger('image_id')->comment('图片id');
            $table->string('type', 10)->comment('类型：likes, hearts');
            $table->unique(['ip', 'image_id', 'type']);
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
        Schema::dropIfExists('image_likes');
    }
};
