<?php

namespace app\core;


class Model extends Table
{

    private $table_name;
    private $validation_status = false;
    private $validation_rules = [
        'username' => [
            'min' => 3,
            'unique' => true,
            'required' => true

        ],
        'password' => [
            'min' => 3,
            'required' => true,

        ],
        'repeat_password' => [
            'min' => 3,
            'matches' => 'password',
            'required' => true,

        ],
        'email' => [
            'email' => true,
            'required' => true
        ]
    ];

    private $validation_errors = [];


    public function __construct($use_table)
    {
        parent::__construct($use_table);
    }

    public function validate($input_data){
        foreach ($input_data as $input => $value){
            foreach ($this->validation_rules[$input] as $rule => $rule_value){
                if(empty($this->validation_errors[$input]) && Validation::$rule($input, $value, $rule_value)){
                    $this->validation_errors[$input] = Validation::$rule($input, $value, $rule_value);
                }
            }
        }
        $this->validation_status = empty($this->validation_errors) ? true : false;
    }

    public function save($data= [], $where =[]){
        if(empty($where)){
            $this->insert($data);
        }else{
            $this->update($data, $where);
        }

    }

    public function deleteRecord($where){
        $this->delete($where);
    }

    public function find($column = '*', $where =[]){
        if(empty($where)){
            $this->getAll();
        }else{
            $this->get($column, $where);
        }
    }


}