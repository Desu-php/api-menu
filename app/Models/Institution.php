<?php

namespace App\Models;

use App\Traits\Eloquent\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory, HasSearch;

    protected $fillable = [
        'user_id',
        'city_id',
        'name',
        'slug',
        'design',
        'color',
        'currency_id',
        'phone',
        'logo',
        'background_image',
        'wifi_password',
        'country_id',
        'address',
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

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
