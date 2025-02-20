<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ga_registrations', function (Blueprint $table) {
            $table->id('registration_id');

            $table->timestamp('date_submitted')->useCurrent();
            $table->enum('delegate_type', ['Voting', 'Non Voting']);

            $table->enum('registration_status', ['Partial Registered', 'Fully Registered', 'Rejected']);
            $table->enum('membership_status', ['Non-migs', 'Migs']);

            $table->unsignedBigInteger('coop_id');
            $table->foreign('coop_id')->references('coop_id')->on('cooperatives')->onDelete('cascade');

          $table->unsignedBigInteger('participant_id')->nullable();
            $table->foreign('participant_id')->references('participant_id')->on('participants')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ga_registrations');
    }
};
