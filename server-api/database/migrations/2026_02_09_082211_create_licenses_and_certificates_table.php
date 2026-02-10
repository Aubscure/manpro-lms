<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('licenses_and_certifications', function (Blueprint $table) {
            $table->id();

            // 1. FOREIGN KEY (The Link)
            // Links this specific license to the 'credentials' table
            $table->foreignId('credential_id')
                  ->constrained('credentials')
                  ->onDelete('cascade');

            // 2. LICENSE / CERTIFICATE NAME (e.g., "Certified Public Accountant", "AWS Solutions Architect")
            // Corresponds to 'type' in your ERD
            $table->string('name');

            // 3. LICENSE NUMBER (e.g., "CPA-123456", "AWS-998877")
            // Nullable because some certificates might not have a strict ID number
            $table->string('license_number')->nullable();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses_and_certifications');
    }
};
