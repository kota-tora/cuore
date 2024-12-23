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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('administrator_id', 255)->unique()->comment('管理画面アカウントID');
            $table->string('password', 255)->comment('パスワード');
            $table->enum('authority', ['administrator', 'member', 'developer'])->default('member')->comment('管理者, メンバー, 開発者');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
