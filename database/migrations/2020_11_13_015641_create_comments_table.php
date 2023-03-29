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
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('parent_id')->comment('父级ID');
            $table->string('content', 255)->default('')->comment('评论内容');
            $table->string('avatar',50)->default('/images/avatar.jpg')->comment('头像');
            $table->string('nickname',50)->default('')->comment('昵称');
            $table->string('email',50)->nullable()->default('')->comment('邮箱');
            $table->unsignedInteger('commentable_id')->default(0)->comment('关联ID');
            $table->string('commentable_type', 100)->default('')->comment('关联表类型');
            $table->string('ip',50)->default('')->comment('ip地址');
            $table->unsignedTinyInteger('is_audited')->default(1)->comment('是否已审核');
            $table->unsignedTinyInteger('is_read')->default(0)->comment('是否已读');
            $table->unsignedTinyInteger('is_admin_reply')->default(0)->comment('是否后台回复');
            $table->unsignedInteger('top_id')->default(0)->comment('顶级ID');
            $table->timestamps();
            $table->softDeletes();
            $table->index('parent_id');
            $table->index('top_id');
            $table->index(['commentable_id', 'commentable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
