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
        Schema::create('admin_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('群組名稱');
            $table->unsignedTinyInteger('status')->default(1)->comment('狀態 1:啟用 0:停用');
            $table->json('permissions')->nullable()->comment('權限');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('管理員群組');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_groups');
    }
};
