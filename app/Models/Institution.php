<?php

namespace App\Models;

use App\Traits\Eloquent\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Institution extends Model
{
    use HasFactory, HasSearch, HasTranslations, HasSlug;

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

    public $translatable = ['name'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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
