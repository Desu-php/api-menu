<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        //
    }


    public function show(Institution $institution)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
