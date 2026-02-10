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
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id();

            // Foreign key linked directly to the users table
            $table->foreignId('credential_id')->constrained()->onDelete('cascade');

            // Column for Highest Educational Attainment
            // Recommendation: String (managed by application-level Enum/Constants)
            $table->string('level');

            // Column for Field of Study
            // Recommendation: String (allows for flexibility shown in UI)
            $table->string('field_of_study')->nullable();

            // Optional: Year graduated, school name, etc., if needed later
            // $table->string('school_name')->nullable();
            // $table->year('year_graduated')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_backgrounds');
    }
};
