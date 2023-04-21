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
        Schema::connection('stable_diffusion')->create('models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('名称');
            $table->decimal('size')->comment('文件大小（M）');
            $table->string('download_url')->comment('下载地址');
            $table->text('description')->nullable()->comment('描述');
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
        Schema::connection('stable_diffusion')->dropIfExists('models');
    }
};
