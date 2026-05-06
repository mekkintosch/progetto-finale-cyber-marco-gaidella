<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:6'
        ]);

        $data = $request->all();

        if (!$request->filled('password')) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return back()->with('message', 'Profilo aggiornato');
    }
}
