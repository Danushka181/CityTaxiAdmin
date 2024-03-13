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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('rating_id')->nullable()->constrained()->onDelete('cascade');

            $table->string('pickup_location',100);
            $table->string('drop_location',100)->nullable();

            $table->string('trip_distance',100)->nullable();
            $table->string('trip_time',100)->nullable();

            $table->enum('status',['Scheduled', 'Cancelled','Ongoing','End trip','Payment','Rating','Completed','Null'])->default('Null');
            $table->string('otp','10')->default('Null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
