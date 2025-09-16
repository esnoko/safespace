<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'code',
        'province',
        'district',
        'type',
        'status',
        'address',
        'phone',
        'email'
    ];

    protected $hidden = [
        // 'admin_password' removed
    ];

    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Relationship with reports
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'school_code', 'code');
    }

    /**
     * Get full school name with location
     */
    public function getFullNameAttribute()
    {
        return $this->name . ' (' . $this->district . ')';
    }

    /**
     * Scope to get active schools
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get schools by province
     */
    public function scopeByProvince($query, $province)
    {
        return $query->where('province', $province);
    }
}