<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request) {
        if (User::where($this->username(), $request->post($this->username()))->whereIn('provider', ['google', 'facebook'])->first()) {
            throw ValidationException::withMessages([
                $this->username() => ['Anda terdaftar menggunakan akun media sosial. Silakan gunakan akun media sosial Anda untuk login.'],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function authenticated(Request $request, $user) {
        $user->last_login = now();
        $user->save();
    }
}
