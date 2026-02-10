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
        Schema::create('credentials', function (Blueprint $table) {
            $table->id(); // This creates the 'id' referenced by child tables

            // Foreign Key to the Users table
            // This links the credential profile to a specific logged-in user
            $table->foreignId('user_id')
                  ->constrained()       // Links to 'users' table id
                  ->onDelete('cascade'); // If user is deleted, credentials are deleted

            // The 'profession' column visible in your ERD
            $table->string('profession')->nullable();

            // You might want a summary/bio here if it fits the "Credential" concept
            // $table->text('professional_summary')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credentials');
    }
};
