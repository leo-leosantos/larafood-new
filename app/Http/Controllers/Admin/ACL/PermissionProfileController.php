<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\{
    Profile,
    Permission
};
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
        $this->middleware(['can:profiles']);

    }


    public function permissions($idProfile)
    {
        $profile =   $this->profile->find($idProfile);


        if (!$profile) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $permissions =  $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    public function profiles($idPermission)
    {

        if (!$permission =   $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $profiles =  $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));
    }


    public function permissionsAvailable(Request $request, $idProfile)
    {

        if (!$profile =   $this->profile->find($idProfile)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {

        if (!$profile =   $this->profile->find($idProfile)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()->with('info', 'Precisa Escolher pelo menos uma permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissionsProfile($idProfile, $idPermission)
    {

        $profile =   $this->profile->find($idProfile);
        $permission =   $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id)->with('message', 'Permissão desvinculada com sucesso!');
    }
}
