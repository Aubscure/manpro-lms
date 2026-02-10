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
        Schema::create('user_links', function (Blueprint $table) {
            $table->id();

            // Relationship to your main User or Credential table
            // Based on your image, this links to 'credentials'
            $table->foreignId('credential_id')
                ->constrained('credentials')
                ->onDelete('cascade');

            // The "Type" is now a Foreign Key to the platforms table
            $table->foreignId('platform_id')
                ->constrained('platforms')
                ->onDelete('restrict'); // Prevent deleting a platform if users are using it

            $table->string('url'); // The actual profile link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_links');
    }
};
