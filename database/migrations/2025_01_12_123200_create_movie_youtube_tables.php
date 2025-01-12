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
        Schema::create('youtube_movies', function (Blueprint $table) {
            $table->id('youtube_movie_id');
            $table->text('url')->comment('動画url');
            $table->string('title', 255)->nullable()->comment('タイトル');
            $table->date('filming_date')->comment('撮影日')->nullable();
            $table->unsignedTinyInteger('up_flg')->default(0)->comment('公開フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_movies');
    }
};
