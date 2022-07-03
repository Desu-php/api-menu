<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(400);

        return UserResource::collection($users);
    }


    public function store(UserStoreRequest $request, User $user)
    {
        $role = Role::where('id', $request->role_id)->first();

        $user = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ])->assignRole($role->name);

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


    public function update(UserUpdateRequest $request, User $user)
    {
        $role = Role::where('id', $request->role_id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->syncRoles([$role->name]);

        return new UserResource($user);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
