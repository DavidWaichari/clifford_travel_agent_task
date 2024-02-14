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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->decimal('rate', 10, 2); // Example rate field with 10 digits, 2 decimals
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('accommodation_id');
            $table->unsignedBigInteger('travel_agent_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
            $table->foreign('travel_agent_id')->references('id')->on('travel_agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
