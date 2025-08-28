<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerLead extends Model
{
    use HasFactory;

    protected $table = 'managerlead';

    protected $fillable = [
        // Original lead fields
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
        
        // Manager input fields
        'manager_lead_priority',
        'physical_demo_date',
        'manager_remarks',
        'assigned_to_salesman',
        'original_lead_id'
    ];

    protected $casts = [
        'lead_date' => 'date',
        'physical_demo_date' => 'datetime',
    ];

    // Relationships
    public function originalLead()
    {
        return $this->belongsTo(Lead::class, 'original_lead_id');
    }

   public function salesman()
{
    return $this->belongsTo(User::class, 'assigned_to_salesman');
}

public function manager()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

public function lead()
{
    return $this->belongsTo(Lead::class, 'original_lead_id');
}
// Lead.php me
public function managerLead()
{
    return $this->hasOne(ManagerLead::class, 'original_lead_id');
}



}