<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_index'), '403');
        // $users = User::all();
        $users = User::where('estadoId', 1)->paginate(15);
        return view('users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('user_create'), '403');
        // $request->validate([
        //     'name' => 'required|min:3|max:100',
        //     // 'username' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required'
        // ]);
        $user = User::create($request->only('name', 'username', 'email')
            + [
                'password' => bcrypt($request->input('password')),
            ]);
        // dd($request);
        if (isset($request['roles'])) {
            $roles = $request->input('roles', 'id');
            $user->syncRoles($roles);
        }

        Session::flash('message', 1);
        // return redirect()->route('users.index', $user->id)->with('success', 'Usuario Guardado');
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), '403');
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('users.show', compact('user', 'roles'));
    }

    // public function show($id)
    // {
    //     $user = User::findOrfail($id);
    //     return view('users.show', compact('user'));
    // }
    // el parametro User $user funciona como un find pero directo, guardando la informacione n la misma variable

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), '403');
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('user_edit'), '403');
        $data = $request->only('name', 'username', 'email');
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);
        $user->update($data);
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        Session::flash('message', 1);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente');
        // return redirect()->route('users.show');
    }

    public function updatePassword(Request $request, User $user)
    {
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);
        $user->update($data);
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        Session::flash('message', 1);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente');
        // return redirect()->route('users.show');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_destroy'), '403');
        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index', $user->id)->with('faild', 'No Puedes Eliminar El Tu Mismo Usuario');
        }
        $user->estadoId = 2;
        // $user->email = null;
        $password = Str::random(50);
        $user->password = bcrypt($password);
        $user->update();
        // $user->delete();

        return redirect()->back()->with('success', 'Usuario Eliminado correctamente');
        // return redirect()->route('users.index');
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
