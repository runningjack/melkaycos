<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/13/15
 * Time: 3:55 PM
 */

class Product extends Eloquent {
    public static $rules = array(
        'title'=>'required',
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 