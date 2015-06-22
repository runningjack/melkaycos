<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/19/15
 * Time: 12:44 AM
 */

class Brand extends Eloquent {
    public static $rules = array(
        'title'=>'required',
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 