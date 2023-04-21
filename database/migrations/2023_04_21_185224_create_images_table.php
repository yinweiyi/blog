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
        Schema::connection('stable_diffusion')->create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url')->comment('图片');
            $table->integer('width')->default(0)->comment('宽度');
            $table->integer('height')->default(0)->comment('高度');
            $table->integer('likes')->default(0)->comment('喜欢数');
            $table->integer('hearts')->default(0)->comment('爱心数');
            $table->integer('dislikes')->default(0)->comment('不喜欢数');
            $table->text('prompt')->comment('Prompt');
            $table->text('negative_prompt')->comment('Negative prompt');
            $table->decimal('cfg_scale', 8, 1)->comment('CFG scale');
            $table->integer('steps')->comment('Steps');
            $table->string('sampler')->comment('Sampler');
            $table->bigInteger('seed')->comment('Seed');
            $table->integer('clip_skip')->comment('Clip skip');
            $table->unsignedBigInteger('model_id')->index()->comment('模型id');
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
        Schema::connection('stable_diffusion')->dropIfExists('images');
    }
};
