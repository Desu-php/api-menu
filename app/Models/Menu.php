<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'title',
        'vision',
        'order'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->orderBy('order');
    }
}
