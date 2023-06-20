<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $roles = Role::all();
        return $dataTable->render('user', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "role_id" => "required",
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('user.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "role_id" => "required",
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }

    public function getData()
    {
        $user = User::findOrFail($_POST['id']);

        return json_encode($user);
    }
}
