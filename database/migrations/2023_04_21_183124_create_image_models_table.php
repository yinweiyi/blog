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
        Schema::create('image_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('名称');
            $table->decimal('size')->comment('文件大小（M）');
            $table->string('download_url')->comment('下载地址');
            $table->text('description')->nullable()->comment('描述');
            $table->bigInteger('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('是否显示');
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
        Schema::dropIfExists('image_models');
    }
};
