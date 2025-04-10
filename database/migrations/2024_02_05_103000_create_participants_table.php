<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
       // Migration for participants table
        Schema::create('participants', function (Blueprint $table) {
            $table->id('participant_id');

            $table->unsignedBigInteger('coop_id');
            $table->foreign('coop_id')->references('coop_id')->on('cooperatives')->onDelete('cascade');

            // Relationship with user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->string('reference_number')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('nickname')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('phone_number')->nullable();
            $table->string('designation')->nullable();
            $table->string('congress_type')->nullable();
            $table->string('religious_affiliation')->nullable();
            $table->dateTime('attendance_datetime')->nullable();
            $table->enum('tshirt_size', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'])->nullable();
            $table->enum('is_msp_officer', ['Yes', 'No']);
            $table->string('msp_officer_position')->nullable();
            $table->enum('delegate_type', ['Voting', 'Non-Voting']);
            $table->enum('voting_status', ['Voted', 'Not Voted'])->nullable()->default('Not Voted');
            $table->timestamps();
            $table->string('qr_code')->nullable();
        });

    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
};

