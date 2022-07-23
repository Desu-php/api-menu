<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Http\Resources\InsitutionResource;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InstitutionController extends Controller
{

    public function index()
    {
        $institutions = Institution::with('user')
            ->when(auth()->user()->hasRole(User::CUSTOMER), fn($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->paginate(30);

        return InsitutionResource::collection($institutions);
    }

    public function store(InstitutionRequest $request)
    {
        $data = $request->validated();

        if (!$request->hasFile('logo') && $request->id) {
            if (!is_null($request->image)){
                unset($data['logo']);
            }
        }

        if (!$request->hasFile('background_image') && $request->id) {
            unset($data['background_image']);
        }

        if ($request->hasFile('logo')) {
            $data['logo'] = Storage::url($request->file('logo')->store('public/institution/images'));
        }

        if (auth()->user()->hasRole(User::CUSTOMER) && empty($request->id)) {
            abort_if(auth()->user()->access->limit <= auth()->user()->institutions()->count(), 403, 'Вы исчерпали лимит.');
            $data['user_id'] = auth()->id();
        }

        $data['city_id'] = 1;
        $data['country_id'] = 1;
        $data['currency_id'] = 1;

        $institution = Institution::updateOrCreate([
            'id' => $request->id
        ], $data + ['slug' => Str::slug($data['slug'])]);

        return new InsitutionResource($institution);
    }

    public function show($id)
    {
        $institution = Institution::findOrFail($id);

        return new InsitutionResource($institution->load('user'));
    }

    public function destroy($id)
    {
        if (auth()->user()->hasRole(User::ADMINISTRATOR)) {
            Institution::destroy($id);
        }else{
            auth()->user()
                ->institutions()
                ->where('id', $id)
                ->delete();
        }

        return response()->noContent();
    }

}
