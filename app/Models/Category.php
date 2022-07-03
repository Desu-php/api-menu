<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'title',
        'vision',
        'image',
        'order',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
