<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 7/5/15
 * Time: 10:06 PM
 */

class Comment extends Eloquent {
    public static $rules = array(
        'comment_post_id'=>'required',
        'comment_author'=>'required',
        'comment_content'=>'required'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }
} 