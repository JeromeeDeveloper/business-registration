<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('coop_id');
            $table->foreign('coop_id')->references('coop_id')->on('cooperatives')->onDelete('cascade');
            $table->text('message');
            $table->enum('notification_type', ['SMS', 'Email']);
            $table->enum('status', ['Sent', 'Pending']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};

