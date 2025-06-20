<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Customer;
use App\Models\Ecommerce\SocialIdentity;
use App\Helpers\Support;
use Illuminate\Support\Str;

use Auth;
use Carbon\Carbon;
use Socialite;
use Session;
use Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function showLoginForm(Request $request)
    {
        session(['prev_url' => url()->previous()]);
        return view('auth.login');
    }


    public function login(Request $request)
    {
        //Error messages
        $messages = [
            "email.required" => "email is required",
            "email.exists" => "email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 8 characters"
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:8'
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if (Auth::attempt(['is_active' => '10', 'email' => $request->email, 'password' => $request->password], $request->remember)) {
                if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    return redirect()->route('verification.approved');
                } else {
                    $prev_url = session('prev_url');
                    session(['prev_url' => '']);
                    // $prev_url = route('login'); // only while feature testing
                    return redirect(($prev_url == route('login')) ? route('dashboard') : $prev_url);
                }
            } else {
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                    'password' => 'Invalid password or username.',
                ]);
            }
        }
    }
    public static function loggedIn()
    {
        $prev_url = session('prev_url');
        session(['prev_url' => '']);
        return redirect(($prev_url == route('login')) ? route('dashboard') : $prev_url);
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function redirectToProvider($provider)
    {
        // session(['prev_url' => url()->previous()]);
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback(Request $request, $provider)
    {
        if (!$request->error_code == 200) {
            try {
                $user = Socialite::driver($provider)->stateless()
                    ->user();
            } catch (Exception $e) {
                return redirect('/login');
            }

            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
            $prev_url = session('prev_url');
            session(['prev_url' => '']);

            return redirect(($prev_url == route('login')) ? route('dashboard') : $prev_url);
        }
        return redirect(route('login'));
    }



    public function findOrCreateUser($providerUser, $provider)
    {
        $account = SocialIdentity::whereProviderName($provider)->whereProviderId($providerUser->id)
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $user = Customer::whereEmail($providerUser->email)
                ->first();
            if (!$user) {
                $user = Customer::create([
                    'uuid' => Str::uuid()->toString(),
                    'email' => $providerUser->email,
                    'name' => $providerUser->name,
                    'phone' => isset($providerUser->phone) ? $providerUser->phone : '',
                    'password' => '',
                    'encrypt'  => Str::random(64) . '-' . time(),
                    'is_active' => 10,
                    'is_social_only' => 10,
                    'has_agreed'          => 10,
                    'agreed_on'           => Carbon::now(),
                    'email_verified_at' => date("Y-m-d h:i:s"),
                ]);
            }

            $user->identities()
                ->create(['provider_id' => $providerUser->id, 'provider_name' => $provider,]);

            return $user;
        }
    }
}
