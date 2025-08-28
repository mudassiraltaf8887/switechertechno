<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesmanLead extends Model
{
    use HasFactory;

    protected $table = 'salesmanlead'; // Table name fix karo

    protected $fillable = [
        'original_lead_id',
        'salesman_id',
        'lead_source',
        'lead_for', 
        'lead_priority',
        'lead_date',
        'assigned_to',
        'contact_person',
        'company_name',
        'mobile_no',
        'whatsapp_no',
        'email_id',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'manager_lead_priority',
        'physical_demo_date',
        'assigned_to_salesman',
        'manager_remarks',
        'demo_type',
        'status',
        'next_followup_date',
        'amount_quotated',
        'salesman_remarks'
    ];

    protected $casts = [
        'lead_date' => 'date',
        'physical_demo_date' => 'datetime',
        'next_followup_date' => 'date',
        'amount_quotated' => 'decimal:2'
    ];

    // Relationships
    public function originalLead()
    {
        return $this->belongsTo(Lead::class, 'original_lead_id');
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedToSalesman()
    {
        return $this->belongsTo(User::class, 'assigned_to_salesman');
    }
}