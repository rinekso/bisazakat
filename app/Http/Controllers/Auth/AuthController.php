<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller {
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider, Request $request) {

        $request->session()->put("redirect", $request->redirect_page);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider) {

        $user = null;

        if ($provider == 'facebook') {
            $user = Socialite::driver('facebook')
                ->fields([
                    'first_name',
                    'last_name',
                    'email',
                    'gender',
                ])
                ->scopes([
                    'email', 'user_birthday',
                ])->user();
        }

        if ($provider == 'google') {
            $user = Socialite::driver('google')->user();
        }

        $previousUser = User::where('email', $user->email)->where(['provider' => null, 'provider_id' => null])->first();

        if ($previousUser) {
            return redirect()->to('/login')->with('single-error', 'User dengan email ' . $user->email . ' sudah terdaftar di sistem');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        if (session("redirect") == null) {
            return redirect('/');
        }

        return redirect(session("redirect"));
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider) {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        switch ($provider) {
        case 'facebook':

            $data = [
                'first_name' => $user->user['first_name'],
                'last_name' => $user->user['last_name'],
                'email' => $user->user['email'],
                'provider' => $provider,
                'provider_id' => $user->id,
            ];

            break;

        case 'google':

            $data = [
                'first_name' => $user->user['name']['givenName'],
                'last_name' => $user->user['name']['familyName'],
                'email' => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
            ];

            break;
        }

        return User::create($data);
    }
}
