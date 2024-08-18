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
        Schema::create('religion', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('group', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('eselon', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('workplace', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('unit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('employee', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('information', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->foreign('nip')->references('nip')->on('employee')->onDelete('cascade');
            $table->string('birthplace')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->foreignId('religion_id')->nullable()->constrained('religion');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('npwp')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        Schema::create('employement', function (Blueprint $table) {
            $table->string('nip')->primary();
            $table->foreign('nip')->references('nip')->on('employee')->onDelete('cascade');
            $table->string('position')->nullable();
            $table->foreignId('group_id')->nullable()->constrained('group');
            $table->foreignId('eselon_id')->nullable()->constrained('eselon');
            $table->foreignId('workplace_id')->nullable()->constrained('workplace');
            $table->foreignId('unit_id')->nullable()->constrained('unit');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
