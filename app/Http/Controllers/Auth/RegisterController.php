<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_user' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            // 'email' => ['string', 'email', 'max:255'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $bidang = explode("||", $data['user_subbidang']);
        return User::create([
            'id_user' => $data['id_user'],
            'name' => $data['name'],
            'nrk' => $data['nrk'],
            'nip' => $data['nip'],
            'email' => $data['email'],
            'user_bidang' => $bidang[0],
            'user_subbidang' => $bidang[1],
            'user_status' => $data['user_status'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
