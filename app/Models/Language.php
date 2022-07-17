<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    const RU = 'ru';
    CONST EN = 'en';

    protected $fillable = [
        'name',
        'key',
        'code'
    ];


    public function institutions()
    {
        return $this->morphedByMany(Institution::class, 'languageable');
    }

}
