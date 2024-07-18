<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('account')->unique()->comment('帳號');
            $table->tinyInteger('status')->default(1)->comment('狀態');
            $table->string('password')->comment('密碼');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('管理員表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
