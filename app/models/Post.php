<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 2:35 PM
 */

class Post extends Eloquent  {
    public static $rules = array(
        'title'=>'required',
        'permalink'=>'required'

    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 