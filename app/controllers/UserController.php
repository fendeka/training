<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class UserController extends Controller
{

    public function actionRegister(){
        $user = new User();
        $user->toRegister();
        $user->validate($_POST);
    }

    public function actionLogin(){
        $user = new User();
        $user->toLogin();
        $user->validate($_POST);
    }

    public function actionLogout(){

    }
    public function actionIndex(){

    }



}