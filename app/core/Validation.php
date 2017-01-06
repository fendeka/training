<?php

namespace app\core;


class Validation
{

    public static function min($field_name = '', $value = '', $rule_value = ''){
        if(strlen($value) < $rule_value){
            return "{$field_name} must be at list {$rule_value} chars";
        }
        return false;
    }

    public static function max($field_name = '', $value = '', $rule_value = ''){
        if(strlen($value) > $rule_value){
            return "{$field_name} must be not longer then {$rule_value} chars";
        }
        return false;
    }

    public static function unique($field_name = '', $value = '', $rule_value = ''){
        if($rule_value){

            return "this {$field_name} already exists";
        }

        return false;
    }

    public static function matches($field_name = '', $value = '', $rule_value = ''){
        $rule_value = Input::get($rule_value);
        if ($value != $rule_value) {
            return "{$field_name} have to match";
        }
        return false;
    }

    public static function email($field_name = '', $value = '', $rule_value = ''){
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "{$field_name} have to be valid format";
        }
        return false;
    }

    public static function required($field_name = '', $value = false, $rule_value = ''){
        if(!$value){
            return "{$field_name} is required";
        }
        return false;
    }


}