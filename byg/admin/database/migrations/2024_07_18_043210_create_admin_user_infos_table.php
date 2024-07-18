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
        Schema::create('admin_user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id')->comment('管理員ID');
            $table->string('key')->comment('索引');
            $table->binary('value')->comment('屬性');
            $table->timestamps();
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->comment('管理員資訊表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_user_infos');
    }
};
