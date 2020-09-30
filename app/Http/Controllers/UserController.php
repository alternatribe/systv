<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class UserController extends Controller
{
    use ResetsPasswords;

    public function index()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return redirect()
                ->back()
                ->withErrors('Usuário e/ou senha inválidos !!!');
        }
        return redirect()->route('lista');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function create()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|min:4'
        ]);
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        if (DB::table('users')->where('email', $data['email'])->exists()) {
            return redirect()
                ->back()
                ->withErrors('Usuário já cadastrado !!!');
        }
        try {
            $user = User::create($data);
            Auth::login($user);
            $request->session()
                ->flash(
                    'success',
                    "Usuário " . Auth::user()->name . " cadastrado com sucesso!"
                );
            return redirect()->route('lista');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors('Erro ao cadastrar o usuário !!!');
        }
    }

    public function request()
    {
        return view('user.passwords.email');
    }

    public function reset(Request $request)
    {
        $token = basename($request->url());
        return view('user.passwords.reset')->with(
            ['token' => $token]
        );
    }

    public function update(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
        //return view('home');

    }


    public function delete()
    {
        try {
            $user = User::find(Auth::id());
            $user->delete();
            $user->logout();
        } catch (\Throwable $th) {
            return redirect()
                ->back()
            ->withErrors('Erro ao remover esta conta !!!');
        }
        return view('home');
    }
}
