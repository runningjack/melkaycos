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
        return \View::make("backend.sales.orders.index")->with("orders",\DB::table("orders")->paginate(20))->with("title","Orders")->with("subtitle","List");
    }

    public function getCustomerAdd(){
        return \View::make("backend.sales.customers.add")->with("title","Add New Customer")->with("subtitle","")
            ->with("countries",\DB::table("country"));
    }
} 