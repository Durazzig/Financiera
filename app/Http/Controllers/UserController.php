<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function edit ()
    {
        $user = Auth::id();
        return view ('users.edit',[
            'user' => $user
        ]);
    }

    public function update (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()
            ->route('users.edit')
            ->withMessage('Actualizado correctamente');
    }

    public function update_pass(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if( !Hash::check($request->old_password , $user->password))
        {
            return redirect()->route('users.edit')
            ->with('error','Contrasena actual incorrecta');
        } 
        $user->password =  Hash::make($request->password);
        $user->save();
        return redirect()->route('users.edit')->with('status', 'Contrasena actualizada correctamente');
    }

}
