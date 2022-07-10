<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Http\Resources\InsitutionResource;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{

    public function index()
    {
        $institutions = Institution::with('user', 'categories')
            ->latest()
            ->paginate(30);

        return InsitutionResource::collection($institutions);
    }

    public function store(InstitutionRequest $request)
    {

        $institution = Institution::updateOrCreate([
            'id' => $request->id
        ], $request->validated());

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
