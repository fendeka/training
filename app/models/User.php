<?php

namespace app\models;

use app\core\Model;

class User extends Model
{

    public $scenario = [
        'login' => [
            'username' => [
                'required' => true
            ],
            'password' => [
                'required' => true,
            ]
        ],

        'register' => [
            'username' => [
                'required' => true,
                'max' => 16,
                'min' => 6,
                'unique' => true,
            ],
            'email' => [
                'required' => true,
                'email' => true,
                'unique' => true,
            ],
            'password' => [
                'required' => true,
                'max' => 16,
                'min' => 6,
                'matches' => 'repeat_password',
            ]
        ]

    ];

    public function toLogin(){
        $this->validation_rules = $this->scenario['login'];
    }

    public function toRegister(){
        $this->validation_rules = $this->scenario['register'];
    }


}