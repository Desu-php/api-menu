<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Http\Resources\InsitutionResource;
use App\Models\City;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{

    public function index()
    {
        $institutions = Institution::with('user', 'categories', 'country', 'city', 'currency')
            ->lists()
            ->paginate();

        return InsitutionResource::collection($institutions);
    }

    public function store(InstitutionRequest $request)
    {
        $data = $request->validated();

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
