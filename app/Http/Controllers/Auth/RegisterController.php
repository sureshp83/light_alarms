<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Traits\AssignAgencyTeam;
use App\Traits\RegistersAgencyAdmin;
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

    use RegistersUsers, RegistersAgencyAdmin, AssignAgencyTeam;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'registered';

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
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'phone'     => 'string|max:24',
            'phone_ext' => 'max:9',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {

       return  User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'phone'     => $data['phone'],
            'phone_ext' => $data['phone_ext'],
        ]);

    }

    /**
     * Show account registered page.
     *
     * @return mixed
     */
    protected function showRegistered()
    {
        return view('auth.registered');
    }


    /**
     * Registers an Agent or a Agency Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function registersAgentOrAgencyAdmin($request, $user)
    {

        // Assign user as Agency Admin
        if ($request['usrtype'] == 'agency_admin') {
            $this->assignAgencyAdmin($request, $user);
        }else{
            $this->assignDefaultAgencyTeam($request, $user);
        }

        // Attach user to the default agency team
        //

        return response()->json();
    }
}
