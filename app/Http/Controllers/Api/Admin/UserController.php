<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::with('roles')
            ->search()
            ->latest()
            ->paginate();

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request, User $user)
    {
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ])->save();

        $user->syncRoles($request->role);

        return new UserResource($user);
    }

    public function show(User $user)
    {
        $user->load('roles');

        $roles = Role::all();

        return [
            'user' => new UserResource($user),
            'roles' => RoleResource::collection($roles),
        ];
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
