<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('uploaded_documents', function (Blueprint $table) {
            $table->id('document_id');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('participant_id')->references('participant_id')->on('participants')->onDelete('cascade');
            $table->enum('document_type', [
                'Financial Statement',
                'Resolution for Voting delegates',
                'Deposit Slip for Registration Fee',
                'List of Officers',
                'Deposit Slip for CETF Remittance'
            ]);
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamp('upload_date')->useCurrent();
            $table->timestamps();

            // Ensure that each participant uploads one document for each document type
            $table->unique(['participant_id', 'document_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('uploaded_documents');
    }
};
