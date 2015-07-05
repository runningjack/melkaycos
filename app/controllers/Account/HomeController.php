<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/4/15
 * Time: 4:23 PM
 */
namespace Account;


use Illuminate\Support\Facades\Redirect;

class HomeController extends AccountController {


    public function getAccountIndex(){

        if(\Auth::account()->check()){
            $user = (\Auth::account()->get());
        }else{
            return Redirect::to("account/login")->with("error_message","Login faild");
        }
        $user = \Auth::account()->get();
        return  \View::make("account.index")->with("categories",\DB::table("categories")->get())->with("countries",\DB::table("country")->get())
            ->with("myorders",\DB::table("orders")->where("customer_id",$user->id)->get())
            ->with("statuses",\DB::table("order_status")->get());
    }


} 