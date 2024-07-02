<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->enum('status', \App\Enums\NewsStatusEnum::asArray());
            $table->timestamps();
        });

        Schema::create('news_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('short_description');
            $table->text('full_description');

            $table->unique(['news_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_translations');
        Schema::dropIfExists('news');
    }
};
