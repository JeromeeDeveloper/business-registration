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
                    'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST', 'LUZON'
                ]);

                $table->string('phone_number');
                $table->string('email')->unique();
                $table->string('tin');
                $table->string('coop_identification_no')->nullable();
                $table->string('bod_chairperson')->nullable();
                $table->string('general_manager_ceo')->nullable();
                $table->decimal('total_asset', 15, 2)->nullable();
                $table->decimal('loan_balance', 15, 2)->nullable();
                $table->decimal('total_overdue', 15, 2)->nullable();
                $table->decimal('time_deposit', 15, 2)->nullable();
                $table->decimal('accounts_receivable', 15, 2)->nullable();
                $table->decimal('savings', 15, 2)->nullable();
                $table->decimal('net_surplus', 15, 2)->nullable();
                $table->decimal('cetf_due_to_apex', 15, 2)->nullable();
                $table->decimal('additional_cetf', 15, 2)->nullable();
                $table->decimal('cetf_undertaking', 15, 2)->nullable();
                $table->enum('full_cetf_remitted', ['yes', 'no'])->nullable();
                $table->date('registration_date_paid')->nullable();
                $table->decimal('registration_fee', 15, 2)->nullable();
                $table->decimal('total_income', 15, 2)->nullable();
                $table->decimal('cetf_remittance', 15, 2)->nullable();
                $table->decimal('cetf_required', 15, 2)->nullable();
                $table->decimal('cetf_balance', 15, 2)->nullable();

                $table->decimal('free_migs_pax', 10, 2)->nullable();

                $table->enum('fs_status', ['yes', 'no'])->default('no');
                $table->enum('delinquent', ['yes', 'no'])->default('no');

                $table->decimal('total_remittance', 15, 2)->nullable();
                $table->string('ga_remark')->nullable();
                $table->decimal('reg_fee_payable', 15, 2)->nullable();
                $table->decimal('net_required_reg_fee', 15, 2)->nullable();
                $table->decimal('total_reg_fee', 15, 2)->nullable();

                $table->decimal('less_prereg_payment', 15, 2)->nullable();
                $table->decimal('less_cetf_balance', 15, 2)->nullable();

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
