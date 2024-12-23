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
        Schema::create('recruits', function (Blueprint $table) {
            $table->id('recruit_id');
            $table->string('name', 255)->comment('名前');
            $table->string('mail', 255)->comment('メールアドレス');
            $table->unsignedTinyInteger('age')->comment('年齢');
            $table->enum('gender', ['男性', '女性'])->comment('性別');
            $table->string('attendance', 255)->comment('参加頻度');
            $table->text('experience')->comment('経験');
            $table->text('question')->comment('質問');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruits');
    }
};
