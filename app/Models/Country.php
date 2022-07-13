<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'short_name'
    ];

    public $translatable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
