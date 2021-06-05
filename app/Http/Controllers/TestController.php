<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{

    public function index(Request $request)
    {

        $data = User::where('email', $request->email)->firstOrFail();
        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                Auth::attempt($request->only('email', 'password'));
                return redirect('/home');
            } else {
                return view('auth.login');
            }
            return view('auth.login');
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
