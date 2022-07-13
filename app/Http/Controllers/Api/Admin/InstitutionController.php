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
        $institutions = Institution::with('user', 'categories', 'country', 'city', 'currency')
            ->latest()
            ->paginate(30);

        return InsitutionResource::collection($institutions);
    }

    public function store(InstitutionRequest $request)
    {
        $data = $request->validated();

        if (!$request->hasFile('logo') && $request->id){
            unset($data['logo']);
        }
        if (!$request->hasFile('background_image') && $request->id){
            unset($data['background_image']);
        }

        if (auth()->user()->hasRole(User::CUSTOMER) && empty($request->id)){
           abort_if( auth()->user()->access->limit == auth()->user()->menus()->count(), 403, 'Вы исчерпали лимит.');
           $data['user_id'] = auth()->id();
        }

        $data['city_id'] = 1;
        $data['country_id'] = 1;
        $data['currency_id'] = 1;

        $institution = Institution::updateOrCreate([
            'id' => $request->id
        ], $data);

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
