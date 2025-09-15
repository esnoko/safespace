<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    protected $fillable = [
        'reference_number',
        'is_anonymous',
        'reporter_name',
        'reporter_email',
        'reporter_phone',
        'reporter_grade',
        'reporter_student_id',
        'category',
        'description',
        'location',
        'incident_date',
        'incident_time',
        'evidence_files',
        'status',
        'admin_notes',
        'resolved_at'
    ];

    protected $casts = [
        'evidence_files' => 'array',
        'incident_date' => 'date',
        'incident_time' => 'datetime',
        'resolved_at' => 'datetime',
        'is_anonymous' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($report) {
            $report->reference_number = static::generateReferenceNumber();
        });
    }

    public static function generateReferenceNumber()
    {
        do {
            $reference = 'SS' . strtoupper(Str::random(8)) . date('y');
        } while (static::where('reference_number', $reference)->exists());
        
        return $reference;
    }

    public function getCategoryDisplayNameAttribute()
    {
        $categories = [
            'bullying' => 'Bullying',
            'substance_abuse' => 'Substance Abuse',
            'sexual_harassment' => 'Sexual Harassment',
            'weapons' => 'Weapons',
            'teenage_pregnancy' => 'Teenage Pregnancy',
            'other' => 'Other'
        ];

        return $categories[$this->category] ?? $this->category;
    }

    public function getStatusDisplayNameAttribute()
    {
        $statuses = [
            'pending' => 'Pending Review',
            'reviewing' => 'Under Review',
            'investigated' => 'Investigated',
            'resolved' => 'Resolved'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}