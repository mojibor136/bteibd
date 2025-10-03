<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('institute_name');
            $table->string('director_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->text('address');
            $table->string('post_office');
            $table->string('upazila');
            $table->string('district');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('status')->default('inactive');
            $table->string('director_photo')->nullable();
            $table->string('institute_photo')->nullable();
            $table->string('national_id_photo')->nullable();
            $table->string('signature_photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
