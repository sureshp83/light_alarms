<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = "agencies";

    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'state_province',
        'postal_code',
        'website',
        'avatar',
        'is_approved',
    ];

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function admin()
    {
        return $this->hasOne(User::class)->where('role_id', 2);
    }

    //-------------------------------------------------| Model Scopes

    public function scopeAwaitingApprovals($query)
    {
        return $query->where('is_approved', 0);
    }
}
