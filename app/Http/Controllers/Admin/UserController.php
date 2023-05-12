<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $repository;
    public function __construct(User $user)
    {
        $this->repository = $user;
        $this->middleware(['can:users']);

    }

    public function index()
    {
        //usando o scope local
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }


    public function create()
    {

        return view('admin.pages.users.create');
    }


    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id']  =  auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']); //encriptar a senha!!


        $this->repository->create($data);

        return redirect()->route('users.index')->with('message', 'Cadastro realizado com sucesso!');
    }


    public function show($id)
    {
        if (!$user =   $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }


        return view('admin.pages.users.show', compact('user'));
    }


    public function edit($id)
    {
        if (!$user =   $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }


        return view('admin.pages.users.edit', compact('user'));
    }



    public function update(StoreUpdateUser $request, $id)
    {


        if (!$users =   $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if ($request->password) {

            $data['password'] =  bcrypt($request->password);
        }

        $users->update($data);

        return redirect()->route('users.index')->with('message', 'Cadastro Editado com sucesso!');
    }


    public function destroy($id)
    {
        if (!$users =   $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $users->delete();

        return redirect()->route('users.index')->with('message', 'Cadastro Deletado com sucesso!');
    }


    public function search(Request $request)
    {
        $filters = $request->only('filter');


        $users = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                $query->orWhere('email', $request->filter);
            }
        })->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
