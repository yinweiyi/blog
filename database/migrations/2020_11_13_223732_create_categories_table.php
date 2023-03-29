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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('parent_id')->index()->default(0)->comment('父级id');
            $table->string('name', 20)->default('')->comment('分类名');
            $table->string('slug', 50)->unique()->comment('slug');
            $table->string('description')->nullable()->comment('分类的描述');
            $table->unsignedBigInteger('order')->default(0)->comment('排序');
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
        Schema::dropIfExists('categories');
    }
};
