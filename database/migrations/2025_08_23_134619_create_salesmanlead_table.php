a<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('salesmanlead', function (Blueprint $table) {
        $table->id();
        
        // Original Lead ID reference
        $table->unsignedBigInteger('original_lead_id');
        $table->unsignedBigInteger('salesman_id');
        
        // Lead Information
        $table->string('lead_source')->nullable();
        $table->string('lead_for')->nullable();
        $table->string('lead_priority')->nullable();
        $table->date('lead_date')->nullable();
        $table->unsignedBigInteger('assigned_to')->nullable();
        
        // Personal Information
        $table->string('contact_person');
        $table->string('company_name')->nullable();
        $table->string('mobile_no');
        $table->string('whatsapp_no')->nullable();
        $table->string('email_id')->nullable();
        
        // Address Information
        $table->text('address')->nullable();
        $table->string('country')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
        $table->string('pincode')->nullable();
        
        // Manager Input
        $table->string('manager_lead_priority')->nullable();
        $table->datetime('physical_demo_date')->nullable();
        $table->unsignedBigInteger('assigned_to_salesman')->nullable();
        $table->text('manager_remarks')->nullable();
        
        // Salesman Input
        $table->string('demo_type');
        $table->string('status');
        $table->date('next_followup_date')->nullable();
        $table->decimal('amount_quotated', 10, 2)->nullable();
        $table->text('salesman_remarks')->nullable();
        
        $table->timestamps();
        
        // Foreign Keys
        $table->foreign('original_lead_id')->references('id')->on('leads');
        $table->foreign('salesman_id')->references('id')->on('users');
        $table->foreign('assigned_to')->references('id')->on('users');
        $table->foreign('assigned_to_salesman')->references('id')->on('users');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesmanlead');
    }
};
