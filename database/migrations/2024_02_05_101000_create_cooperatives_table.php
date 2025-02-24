<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id('coop_id');
            $table->string('name');
            $table->string('contact_person');
            $table->string('type');
            $table->text('address');
            $table->enum('region', [
                'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
                'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
                'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'
            ]);
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('tin');
            $table->string('coop_identification_no')->nullable();
            $table->string('bod_chairperson')->nullable();
            $table->string('general_manager_ceo')->nullable();
            $table->decimal('total_asset', 15, 2)->nullable();
            $table->decimal('total_income', 15, 2)->nullable();
            $table->decimal('cetf_remittance', 15, 2)->nullable();
            $table->decimal('cetf_required', 15, 2)->nullable();
            $table->decimal('cetf_balance', 15, 2)->nullable();
            $table->decimal('share_capital_balance', 15, 2)->nullable();
            $table->integer('no_of_entitled_votes')->nullable();
            $table->json('services_availed')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cooperatives');
    }
};
