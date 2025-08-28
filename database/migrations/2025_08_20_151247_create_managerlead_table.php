<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('managerlead', function (Blueprint $table) {
            $table->id();
            
            // Original Lead fields (from leads table)
            $table->enum('lead_source', [
                'Facebook',
                'Google Ads',
                'Olx',
                'Reference',
                'Youtube'
            ])->nullable();
            
            $table->enum('lead_for', [
                'ERP Software',
                'FBR Digital Invoicing',
                'Accounting Software',
                'POS Software',
                'Restaurant POS Software',
                'Distribution Software',
                'Wholesale Software'
            ])->nullable();
            
            $table->enum('lead_priority', ['High', 'Medium', 'Low'])->default('Low');
            
            $table->string('contact_person');
            $table->date('lead_date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('mobile_no');
            $table->string('whatsapp_no')->nullable();
            $table->string('email_id')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            
            // Assigned to manager (from original leads table)
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            
            // Manager Input fields (new fields)
            $table->enum('manager_lead_priority', ['Low', 'Medium', 'High', 'Urgent'])->nullable();
            $table->dateTime('physical_demo_date')->nullable();
            $table->text('manager_remarks')->nullable();
            $table->foreignId('assigned_to_salesman')->nullable()->constrained('users')->nullOnDelete();
            
            // Reference to original lead
            $table->foreignId('original_lead_id')->nullable()->constrained('leads')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('managerlead');
    }
};