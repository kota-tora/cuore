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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('contact_id');
            $table->string('name', 255)->comment('名前');
            $table->string('mail', 255)->comment('メールアドレス');
            $table->unsignedBigInteger('category_id')->comment('カテゴリーID');
            $table->text('content')->comment('内容');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
