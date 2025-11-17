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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('status');
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('old_price')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText(column: 'content')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedInteger('reading_time')->nullable()->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
