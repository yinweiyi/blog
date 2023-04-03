<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('用户名');
            $table->string('account')->unique()->comment('账号');
            $table->string('password')->comment('密码');
            $table->tinyInteger('status')->default(1)->comment('是否启用');
            $table->string('last_login_ip', 45)->default('')->comment('最后登录IP');
            $table->timestamp('last_login_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('最后登录时间');

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
        Schema::dropIfExists('administrators');
    }
};
