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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->Integer('author_id');
            $table->enum('author_role', ['admin', 'branch']);
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('date_of_birth');
            $table->string('institute_name');
            $table->string('roll')->unique();
            $table->string('registration_no')->unique();
            $table->string('student_type');
            $table->string('course_duration');
            $table->string('session'); 
            $table->string('course_name');
            $table->string('status');
            $table->decimal('cgpa_result', 4, 2)->nullable();
            $table->string('profile_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
