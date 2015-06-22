<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/1/15
 * Time: 4:17 PM
 */

class Order extends Eloquent {

    public static function invoiceNo($lastid){
        if(!empty($lastid)){
            $careid = str_pad($lastid, 10, "0", STR_PAD_LEFT);
            return $careid;
        }else{
            return false;
        }
    }
} 