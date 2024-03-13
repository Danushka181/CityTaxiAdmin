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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->text('avatar')->nullable();

            $table->string('address')->nullable();

            $table->string('identity_card')->nullable();
            $table->string('license_number')->nullable();
            $table->decimal('hire_rate')->nullable();
            $table->enum('status', [
                'ACTIVE',
                'INACTIVE',
            ])->default('INACTIVE');

            $table->string('location')->nullable();
            $table->boolean('is_banned')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
