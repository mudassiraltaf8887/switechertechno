<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            // Dropdown for Lead Source
            $table->enum('lead_source', [
                'Facebook',
                'Google Ads',
                'Olx',
                'Reference',
                'Youtube'
            ])->nullable();

            // Dropdown for Lead For
            $table->enum('lead_for', [
                'ERP Software',
                'FBR Digital Invoicing',
                'Accounting Software',
                'POS Software',
                'Restaurant POS Software',
                'Distribution Software',
                'Wholesale Software'
            ])->nullable();

            // Lead Priority dropdown
            $table->enum('lead_priority', ['High', 'Medium', 'Low'])->default('Low');

            $table->string('contact_person');
            $table->date('lead_date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('mobile_no');
            $table->string('whatsapp_no')->nullable();
            $table->string('email_id')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();

            // Assigned to user (foreign key relation with users table)
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
