<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'type', 
        'title',
        'message',
        'data',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    // Static methods for creating notifications
    public static function createLeadAssignedNotification($managerId, $leadData)
    {
        return self::create([
            'user_id' => $managerId,
            'type' => 'lead_assigned',
            'title' => 'New Lead Assigned',
            'message' => "New lead from {$leadData['company_name']} has been assigned to you.",
            'data' => [
                'lead_id' => $leadData['id'],
                'company_name' => $leadData['company_name'],
                'contact_person' => $leadData['contact_person'],
                'mobile_no' => $leadData['mobile_no'],
                'assigned_at' => now()->toISOString()
            ]
        ]);
    }

    public static function createLeadUpdatedNotification($managerId, $leadData)
    {
        return self::create([
            'user_id' => $managerId,
            'type' => 'lead_updated',
            'title' => 'Lead Updated',
            'message' => "Lead from {$leadData['company_name']} has been updated.",
            'data' => [
                'lead_id' => $leadData['id'],
                'company_name' => $leadData['company_name'],
                'updated_at' => now()->toISOString()
            ]
        ]);
    }

    public static function createPriorityChangedNotification($managerId, $leadData, $newPriority)
    {
        return self::create([
            'user_id' => $managerId,
            'type' => 'priority_changed',
            'title' => 'Priority Updated',
            'message' => "Lead from {$leadData['company_name']} priority changed to {$newPriority}.",
            'data' => [
                'lead_id' => $leadData['id'],
                'company_name' => $leadData['company_name'],
                'old_priority' => $leadData['lead_priority'],
                'new_priority' => $newPriority
            ]
        ]);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessor for human readable time
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // Get notification icon based on type
    public function getIconAttribute()
    {
        $icons = [
            'lead_assigned' => 'fas fa-user-plus',
            'lead_updated' => 'fas fa-edit',
            'priority_changed' => 'fas fa-exclamation-triangle',
            'salesman_assigned' => 'fas fa-handshake',
            'default' => 'fas fa-bell'
        ];

        return $icons[$this->type] ?? $icons['default'];
    }

    // Get notification color based on type
    public function getColorAttribute()
    {
        $colors = [
            'lead_assigned' => 'green',
            'lead_updated' => 'blue', 
            'priority_changed' => 'red',
            'salesman_assigned' => 'purple',
            'default' => 'gray'
        ];

        return $colors[$this->type] ?? $colors['default'];
    }
    
}