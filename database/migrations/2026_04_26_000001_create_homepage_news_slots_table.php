<?php

use App\Models\Article;
use App\Models\User;
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
        Schema::create('homepage_news_slots', function (Blueprint $table) {
            $table->id();
            $table->enum('slot', ['featured', 'breaking_1', 'breaking_2', 'breaking_3'])->unique();
            $table->foreignIdFor(Article::class)->unique()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'selected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_news_slots');
    }
};
