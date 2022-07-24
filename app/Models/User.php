<?php

namespace App\Models;

use App\Traits\Eloquent\HasSearch;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasSearch;

    const ADMINISTRATOR = 'administrator';
    const CUSTOMER = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function access()
    {
        return $this->hasOne(Access::class);
    }

    public function menus()
    {
        return $this->hasManyThrough(Menu::class, Institution::class, 'user_id', 'institution_id', 'id', 'id');
    }

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable')->withPivot('is_main')->orderByPivot('is_main', 'desc');
    }
}
