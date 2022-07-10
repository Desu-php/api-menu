<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['languages'];

    public function institutions()
    {
        return $this->morphedByMany(Institution::class, 'languageable');
    }

}
