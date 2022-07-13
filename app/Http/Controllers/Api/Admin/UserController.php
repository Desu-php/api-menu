<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Access;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::with('roles', 'access')
            ->lists()
            ->paginate();

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::updateOrCreate([
            'id' => $request->id
        ], $data);

        $user->syncRoles($request->role);

        if ($user->hasRole(User::CUSTOMER)) {
            Access::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'limit' => $request->limit,
                'duration' => $request->duration,
            ]);
        }

        return new UserResource($user);
    }

    public function show(User $user)
    {
        $user->load('roles');

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
