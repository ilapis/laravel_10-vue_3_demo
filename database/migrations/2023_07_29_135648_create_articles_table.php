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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->foreignId('language_id')->constrained();
            $table->string('title');
            $table->string('tags');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['language_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
