<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\Ecommerce\Customer;
use App\Models\General\User;
use App\Models\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewClient;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showRegistrationForm()
    {
        return view('auth.signup');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator->setAttributeNames([
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\General\User
     */
    protected function create(array $data)
    {
        $client = Customer::create([
            'name'                => $data['name'],
            'uuid'                => Str::uuid()->toString(),
            'email'               => $data['email'],
            'phone'               => $data['phone'],
            // 'image'               => null,
            'password'            => Hash::make($data['password']),
            'encrypt'             => Str::random(64) . '-' . time(),
            'has_agreed'          => isset($data['has_agreed']) ? 10 : 0,
            'agreed_on'           => isset($data['has_agreed']) ? Carbon::now() : null,
            'is_active'           => 10,
            'is_social_only'      => 0,
        ]);

        $users = User::get();
        // Notification::send($users, new NewClient($client));

        return $client;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
