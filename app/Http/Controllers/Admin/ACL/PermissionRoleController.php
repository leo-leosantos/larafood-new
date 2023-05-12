<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\{
    Permission,
    Role,

};
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->middleware(['can:roles']);

    }


    public function permissions($idrole)
    {
        $role =   $this->role->find($idrole);


        if (!$role) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $permissions =  $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));
    }

    public function roles($idPermission)
    {

        if (!$permission =   $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $roles =  $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.roles', compact('permission', 'roles'));
    }


    public function permissionsAvailable(Request $request, $idrole)
    {

        if (!$role =   $this->role->find($idrole)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions', 'filters'));
    }

    public function attachPermissionsRole(Request $request, $idrole)
    {

        if (!$role =   $this->role->find($idrole)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        if (!$request->permissions || count($request->permissions) == 0) {

            $notifications = [
                'message'=>'Precisa Escolher pelo menos uma permissão',
                'alert-type' => 'error',

            ];
            return redirect()->back()->with($notifications);
        }

        $role->permissions()->attach($request->permissions);
        $notifications = [
            'message'=>'permissão vinculada com sucesso',
            'alert-type' => 'success',

        ];
        return redirect()->route('roles.permissions', $role->id)->with($notifications);
    }

    public function detachPermissionsRole($idrole, $idPermission)
    {

        $role =   $this->role->find($idrole);
        $permission =   $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $role->permissions()->detach($permission);
        $notifications = [
            'message'=>'Permissão desvinculada com sucesso',
            'alert-type' => 'success',

        ];

        return redirect()->route('roles.permissions', $role->id)->with($notifications);
    }
}
