<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    public static $rules = array(
        'firstname'=>'required',
        'lastname'=>'required',
        'phone'=>'required|unique:administrators',
        'username'=>'required|unique:administrators',
        'password'=>'required|alphaNum|min:5',
        'email'=>'required|min:10|unique:administrators'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    public  function fullname(){
        return $this->fname ." ".$this->lname;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'administrators';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

}
