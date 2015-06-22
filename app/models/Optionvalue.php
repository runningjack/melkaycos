<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 4/12/15
 * Time: 3:48 PM
 */

class Optionvalue extends Eloquent {
    public static $rules = array(
        'title'=>'required',
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    protected $table = 'options_values';
} 