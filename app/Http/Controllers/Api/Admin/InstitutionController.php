<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Http\Resources\InsitutionResource;
use App\Models\Currency;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionController extends Controller
{

    public function index()
    {
        $institutions = Institution::with('user', 'categories', 'country', 'city', 'currency')
            ->latest()
            ->paginate(30);

        return InsitutionResource::collection($institutions);
    }

    public function store(InstitutionRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')){
            $data['logo'] = Storage::url($request->file('logo')->store('institutions/images'));
        }

        if ($request->hasFile('background_image')){
            $data['logo'] = Storage::url($request->file('background_image')->store('institutions/images'));
        }

        if (!$request->hasFile('logo') && $request->id){
            unset($data['logo']);
        }
        if (!$request->hasFile('background_image') && $request->id){
            unset($data['background_image']);
        }

        $institution = Institution::updateOrCreate([
            'id' => $request->id
        ], [...$request->validated(), 'currency_id' => Currency::firstWhere('name', 'Сомони')->id]);

        return new InsitutionResource($institution);
    }


    public function show(Institution $institution)
    {
        $institution->load('currency', 'country', 'city');

        return new InsitutionResource($institution);
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();

        return response()->noContent();
    }
}
