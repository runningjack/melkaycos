<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 4/29/15
 * Time: 1:01 PM
 */


use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Customer extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    public static $rules = array(
        'firstname'=>'required',
        'lastname'=>'required',
        'phone'=>'required|unique:customers',

        'email'=>'required|min:10|unique:customers',
        'country'=>'required',
        'city'=>'required',
        'address'=>'required'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 