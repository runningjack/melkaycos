<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/23/15
 * Time: 3:21 PM
 */

class Option extends Eloquent{
    public static $rules = array(
        'title'=>'required',
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 