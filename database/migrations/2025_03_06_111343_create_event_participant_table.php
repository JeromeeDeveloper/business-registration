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
        Schema::create('event_participant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('participant_id');
            $table->timestamp('attendance_datetime')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('participant_id')->references('participant_id')->on('participants')->onDelete('cascade');

            // Prevent duplicate attendance per event
            $table->unique(['event_id', 'participant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_participant');
    }
};
