<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class School extends Model
{
    protected $fillable = [
        'name',
        'code',
        'province',
        'district',
        'type',
        'status',
        'admin_password',
        'address',
        'phone',
        'email'
    ];

    protected $hidden = [
        'admin_password'
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
     * Set admin password with bcrypt
     */
    public function setAdminPasswordAttribute($value)
    {
        $this->attributes['admin_password'] = Hash::make($value);
    }

    /**
     * Check if admin password is correct
     */
    public function checkAdminPassword($password)
    {
        return Hash::check($password, $this->admin_password);
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