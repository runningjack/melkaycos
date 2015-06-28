<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 6/26/15
 * Time: 5:38 AM
 */

namespace Backend;


class SalesController extends BackendController {
    public function getCustomerIndex(){
        return \View::make("backend.sales.customers.index")->with("customers",\DB::table("customers")->paginate(20))->with("title","Customers")->with("subtitle","List");
    }

    public function getOrderIndex(){
        return \View::make("backend.sales.orders.index")->with("orders",\DB::table("orders")->paginate(20))
            ->with("statuses",\DB::table("order_status")->get())
            ->with("title","Orders")->with("subtitle","List");
    }

    public function getCustomerAdd(){
        return \View::make("backend.sales.customers.add")->with("title","Add New Customer")->with("subtitle","")
            ->with("countries",\DB::table("country")->get());
    }

    public function getCustomerEdit($id=""){
        return \View::make("backend.sales.customers.edit")->with("title","Edit Customer Details")->with("subtitle","")
            ->with("customer",\Customer::find($id))
            ->with("countries",\DB::table("country")->get());
    }

    public function postCustomerAdd($id=""){
        $input = \Input::get();
        $validation = \Customer::validate($input);
        if($id !=""){
            $customer = \Customer::find($id);
            array_forget($input,"_token");
            array_forget($input,"confirm");
            array_forget($input,"submit");
            array_forget($input,"tag");

            foreach($input as $key=>$value){
                $customer->$key = $value;
            }

            if($customer->update()){

                \Session::put("success_message","Customer record updeted!");
                return \Redirect::back();
            }else{
                \Session::put("error_message","Unexpected Error! Customer record could not be updated");
                return \Redirect::back()->withInput();
            }

            exit;
        } else{

        }
        if($validation->fails()){
            return \Redirect::back()->withErrors($validation)->withInput();
        }else{

            $customer = new \Customer();

            array_forget($input,"_token");
            array_forget($input,"confirm");
            array_forget($input,"submit");
            array_forget($input,"tag");

            foreach($input as $key=>$value){
                $customer->$key = $value;
            }



                $customer->password     =  \Hash::make(\Input::get("password"));
                if($customer->save()){

                    \Mail::send('emails.registration', $input, function($message) use($input) {
                        $message->from("info@melkaycosmetics.com", "Melkay Cosmetics ");
                        $message->to($input['email'], "info@melkaycosmetics.com")->cc('ahmed@chroniclesoft.com')->subject("Registration ");
                    });

                    \Session::put("success_message","Your Registration was successful");
                    return \Redirect::back();
                }else{
                    \Session::put("error_message","Your registration was not successful, please try again next time");
                    return \Redirect::back()->withInput();
                }
            //}

        }
    }
} 