<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/12/15
 * Time: 12:10 PM
 */

class Category extends Eloquent {
    public static $rules = array(
        'title'=>'required',
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 