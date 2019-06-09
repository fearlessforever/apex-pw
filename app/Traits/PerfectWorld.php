<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

trait PerfectWorld
{

    /**
     * PW's users columns.
     *
     * @var string
     */
    protected $columns = [
        'ID' => 'int',
        'name' => 'string',
        'passwd' => 'string',
        'Prompt' => 'string',
        'answer' => 'string',
        'truename' => 'string',
        'idnumber' => 'string',
        'email' => 'string',
        'mobilenumber' => 'string',
        'province' => 'string',
        'city' => 'string',
        'phonenumber' => 'string',
        'address' => 'string',
        'postalcode' => 'string',
        'gender' => 'int',
        'birthday' => 'date',
        'creatime' => 'date',
        'qq' => 'string',
        'passwd2' => 'string',
    ];

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(array $data)
    {
        $collection = collect($data)->except(['_token'])->toArray();
        $data = $this->sortAndCleanData($collection);

        // Unset 'ID' and 'creatime' (both are set by 'adduser' procedure)
        unset($data['ID'], $data['creatime']);

        // Set passwd's hash
        $data['passwd'] = Hash::make($data['name'] . $data['passwd']);

        // Create the user in DB.
        $user = DB::statement('CALL adduser (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array_values($data));

        if (!$user) {
            abort(400, 'Ocorreu um erro ao registrar o usuário.');
        }

        return User::findByLogin($data['name']);
    }

    /**
     * Sorts the data according to PW's users columns, removes non-existing columns,
     * and sets not set columns values by their respective types.
     *
     * @param array $data
     * @return array Sorted an cleaned data.
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
