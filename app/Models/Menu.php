<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, HasSlug, HasTranslations;

    protected $fillable = [
        'institution_id',
        'name',
        'image',
        'published',
        'expired_at'
    ];

    public $translatable = ['name'];

    protected $dates = ['expired_at'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->orderBy('order');
    }
}
