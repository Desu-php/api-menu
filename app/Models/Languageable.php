<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languageable extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'language_id',
            'main_language',
            'languageable_id',
            'languageable_type',
        ];


}
