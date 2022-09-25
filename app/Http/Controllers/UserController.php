<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Show the form to enter an account.
     *
     * @return \Illuminate\View\View
     */
    public function login(): View
    {
        return view('users.login');
    }

    /**
     * Show the form for creating a new account.
     *
     * @return \Illuminate\View\View
     */
    public function register(): View
    {
        return view('users.register');
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ], [
            'username.required' => 'O Nome é obrigatório',
            'email.required' => 'O E-mail é obrigatório',
            'email.unique' => 'O E-mail em uso',
            'password.required' => 'A Senha é obrigatória',
        ]);

        try {
            $data = $request->all();

            $user = [
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];

            $user = User::create($user);
        } catch (Exception $e) {
            return redirect()->route('users.register')->with('status', 'Não foi possível cadastrar usuário');
        }

        return redirect()->route('users.login')->with('status', 'Usuário cadastrado com sucesso.');
    }

    /**
     * Authenticate user;
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'O E-mail é obrigatório',
            'password.required' => 'A Senha é obrigatória',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true)) {
            User::where('email', $credentials['email'])->get();

            return redirect()->route('cities.index');
        } else {
            return redirect()->back()->with('danger', 'E-mail ou senha inválida');
        }
    }

    public function logout()
    {
        Auth::logout();

        return view('users.login');
    }
}
