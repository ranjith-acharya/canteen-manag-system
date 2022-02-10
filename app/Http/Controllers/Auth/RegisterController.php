<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'card' => ['required', 'string', 'max:16', 'min:16'],
            'cardcvv' => ['required', 'string', 'max:4', 'min:3'],
        ], [
            'name.required' => 'Mention your Full name',
            'email.required' => 'Mention your Email address',
            'password.required' => 'Mention Password for your account',
            'card.required' => 'Provide your Card number',
            'card.min' => 'Card number must be atleast 16 characters',
            'card.max' => 'Card number must be atleast 16 characters',
            'cardcvv.min' => 'Card CVV must be atleast 3 to 4 characters',
            'cardcvv.max' => 'Card CVV must be atleast 3 to 4 characters',
            'cardcvv.required' => 'Provide your Card CVV mentioned at back of your card',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'card' => $data['card'],
            'cardcvv' => $data['cardcvv'],
        ]);
    }
}
