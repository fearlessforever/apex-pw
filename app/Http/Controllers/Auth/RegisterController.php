<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use Illuminate\Http\Request;
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
     * Perfect World's users columns.
     *
     * @var string
     */
    protected $columns = [
        'ID'          => 'int',
        'name'        => 'string',
        'passwd'      => 'string',
        'Prompt'      => 'string',
        'answer'      => 'string',
        'truename'    => 'string',
        'idnumber'    => 'string',
        'email'       => 'string',
        'mobilenumber'=> 'string',
        'province'    => 'string',
        'city'        => 'string',
        'phonenumber' => 'string',
        'address'     => 'string',
        'postalcode'  => 'string',
        'gender'      => 'int',
        'birthday'    => 'date',
        'creatime'    => 'date',
        'qq'          => 'string',
        'passwd2'     => 'string',
    ];

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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|max:64|unique:users',
            'passwd' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'
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
        $collection = collect($data)->except(['_token'])->toArray();
        $data = $this->sortAndCleanData($collection);

        // Unset 'ID' and 'creatime' (both are set by 'adduser' procedure)
        unset($data['ID'], $data['creatime']);

        // Set passwd's hash
        $data['passwd'] = salt_md5($data['name'].$data['passwd']);

        return DB::statement('CALL adduser (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array_values($data));
    }

    /**
     * Sorts the data according to PW's users columns, removes non-existing columns,
     * and sets not set columns as empty strings.
     *
     * @param array $data
     * @return void
     */
    protected function sortAndCleanData(array $data)
    {
        $data_temp = $data;
        $data = [];
        foreach ($this->columns as $column => $type) {
            if (isset($data_temp[$column])) {
                $data[$column] = $data_temp[$column];
            } else {
                $data[$column] = $this->setColumnEmptyValueByType($type);
            }
        }

        return $data;
    }

    /**
     * Correctly defines the "empty value" based on column type.
     *
     * @param $type The column type.
     * @return void
     */
    protected function setColumnEmptyValueByType($type)
    {
        switch ($type) {
            case 'string':
                return '';
            case 'int':
                return 0;
            case 'date':
                return;
        }
    }
}
