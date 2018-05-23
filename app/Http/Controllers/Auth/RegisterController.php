<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\UserFisico;
use App\Models\UserJuridico;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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
    protected $redirectTo = '/home';

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
    protected function validator(array $data) {

        $config = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'ddd' => 'required|string|max:3',
            'telefone' => 'required|string|max:10',
        ];

        if ($data['tipo'] == 'Juridica') {
            $config = array_merge($config, [
                'cnpj' => 'required|string|max:255|unique:user_juridicos',
                'razao_social' => 'required|string',
                'nome_solicitante' => 'required|string|max:255',
                'cpf_solicitante' => 'required|string|max:255',
                'rg_solicitante' => 'required|string|max:255',
            ]);
        } else {
            $config = array_merge($config, [
                'cpf' => 'required|string|max:255|unique:user_fisicos',
                'rg' => 'required|string|max:255',
            ]);
        }

        return Validator::make($data, $config);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if ($data['tipo'] == 'Juridica') {
            UserJuridico::create([
                'user_id' => $user->id,
                'cnpj' => $data['cnpj'],
                'razao_social' => $data['razao_social'],
                'nome_solicitante' => $data['nome_solicitante'],
                'cpf_solicitante' => $data['cpf_solicitante'],
                'rg_solicitante' => $data['rg_solicitante'],
                'ddd' => $data['ddd'],
                'telefone' => $data['telefone'],
            ]);
        } else {
            UserFisico::create([
                'user_id' => $user->id,
                'cpf' => $data['cpf'],
                'rg' => $data['rg'],
                'ddd' => $data['ddd'],
                'telefone' => $data['telefone'],
            ]);
        }

        return $user;
    }

    public function postRegister(Request $request) {
        
    }
}
