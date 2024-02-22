<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'addres' => 'required',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'role' => 'required|in:user,company',
        ]);

        $userData = $request->except('confirm-password', 'password', 'role');
        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        $user->update(['role' => $request->role]);

        if ($request->role == 'company') {
            $companyData = [
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ];

            Company::create($companyData);
        }

        return redirect('/login');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
