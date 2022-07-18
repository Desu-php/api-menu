<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Setting\LanguageResource;
use App\Http\Resources\Admin\Setting\LanguageStoreResource;
use App\Models\Language;
use App\Models\Languageable;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //

    public function getLanguages()
    {
        return LanguageResource::collection(Language::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'languages' => 'required|array',
            'languages.*' => 'required|exists:languages,id'
        ]);

        $lang = auth()->user()->languages->firstWhere('pivot.is_main', true);

        auth()->user()->languages()->detach();

        foreach ($data['languages'] as $language) {
            auth()->user()->languages()->attach($language, ['is_main' => $language == $lang->id]);
        }

        return LanguageStoreResource::collection(auth()->user()->languages()->get());
    }

    public function select($language_id)
    {
        Languageable::where('language_id', $language_id)
            ->update(['is_main' => true]);

        Languageable::where('language_id','!=', $language_id)
            ->update(['is_main' => false]);

        return LanguageStoreResource::collection(auth()->user()->languages);
    }
}
