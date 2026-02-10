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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // e.g., "LinkedIn", "GitHub"
            $table->string('icon_key');      // e.g., "fa-linkedin", "lucide-github" (Frontend uses this)
            $table->string('base_url')->nullable(); // e.g., "linkedin.com" (For validation)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
