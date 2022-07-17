<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Setting\LanguageResource;
use App\Models\Language;

class LanguageController extends Controller
{
    //

    public function getLanguages()
    {
        return LanguageResource::collection(Language::all());
    }
}
