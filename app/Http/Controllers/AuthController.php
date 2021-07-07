<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function entrar(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Usuário e/ou senha inválidos!');
        }
        return redirect()->route('listar_series');
    }

    public function create()
    {
        return view('login.registro');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('listar_series');
    }
}
