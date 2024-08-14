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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('prefix')->comment('前綴');
            $table->string('front_domain')->comment('前台網址');
            $table->string('backend_domain')->comment('後台網址');
            $table->unsignedBigInteger('status')->comment('上線狀態;0:準備中,1:上線,2:關閉,3:維護');
            $table->date('online_date')->nullable()->comment('上線日期');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('站點資料');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
