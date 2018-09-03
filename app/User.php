<?php

namespace App;

use App\Models\Agency;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'phone_ext',
            'is_approved',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            'password',
            'remember_token',
        ];


    /**
     * Return user agency.
     *
     * @return App\Models\Agency
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class)->first();
    }

    public function scopeAwaitingApprovals($query)
    {
        return $query->where('is_approved', 0);
    }
    /**
     * Roles are hard-coded.
     * Existing roles:
     *     (1) Admin (T&B)
     *     (2) Agency Admin
     *     (3) Agent
     */
    public function isAdmin()
    {
        return $this->role_id === 1;
    }
    public function isAgencyAdmin()
    {
        return $this->role_id === 2;
    }
    public function isAgent()
    {
        return $this->role_id === 3;
    }
}
