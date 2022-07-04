<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'design',
        'color',
        'currency_id',
        'phone',
        'logo',
        'background_image',
        'wifi_password',
        'country_id',
        'city',
        'address',
        'expiration_date',
        'main_language'
    ];

    protected $dates = [
        'expiration_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class)->orderBy('setting');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, Menu::class);
    }
}