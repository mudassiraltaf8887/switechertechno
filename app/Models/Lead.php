<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_source',
        'lead_for',
        'lead_priority',
        'contact_person',
        'lead_date',
        'company_name',
        'mobile_no',
        'whatsapp_no',
        'email_id',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'assigned_to',
        'assigned_salesman_id', // Ye column name ho sakta hai
        // Add other fields as needed
    ];

    protected $casts = [
        'lead_date' => 'date',
    ];

    // ✅ Ye relationships add kariye
  

    public function assignedManager()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Manager leads relationship
    public function managerLeads()
    {
        return $this->hasMany(ManagerLead::class, 'original_lead_id');
    }
     public function managerLead()
    {
        return $this->hasOne(ManagerLead::class, 'original_lead_id');
    }
    
}