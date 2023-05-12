<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
        $this->middleware(['can:users']);

    }


    public function roles($idUser)
    {

        if (!$user =   $this->user->find($idUser)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $roles =  $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', compact('user', 'roles'));
    }

    public function users($idRole)
    {

        if (!$role =   $this->role->find($idRole)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $users =  $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact('role', 'users'));
    }


    public function rolesAvailable(Request $request, $idUser)
    {

        if (!$user =   $this->user->find($idUser)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters'));
    }

    public function attachRolesUser(Request $request, $idUser)
    {



        if (!$user =   $this->user->find($idUser)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        if (!$request->roles || count($request->roles) == 0) {
            return redirect()->back()->with('error', 'Precisa Escolher pelo menos uma usero');
        }

        $user->roles()->attach($request->roles);
        $notifications = [
            'message'=>'Cargo vinculado com sucesso',
            'alert-type' => 'success',

        ];
        return redirect()->route('users.roles', $user->id)->with($notifications);
    }

    public function detachRoleUser($idUser, $idRole)
    {

        $user =   $this->user->find($idUser);
        $role =   $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $user->roles()->detach($role);
        $notifications = [
            'message'=>'Cargo desvinculado com sucesso',
            'alert-type' => 'success',

        ];
        return redirect()->route('users.roles', $user->id)->with($notifications);
    }
}
