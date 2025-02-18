<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id('coop_id');
            $table->string('name');
            $table->string('contact_person');
            $table->string('type');
            $table->text('address');
            $table->string('region');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('tin');
            $table->string('coop_identification_no');
            $table->string('bod_chairperson');
            $table->string('general_manager_ceo');
            $table->string('ga_registration_status');
            $table->decimal('total_asset', 15, 2);
            $table->decimal('total_income', 15, 2);
            $table->decimal('cetf_remittance', 15, 2);
            $table->decimal('cetf_required', 15, 2);
            $table->decimal('cetf_balance', 15, 2);
            $table->decimal('share_capital_balance', 15, 2);
            $table->integer('no_of_entitled_votes');
            $table->text('services_availed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cooperatives');
    }
};
