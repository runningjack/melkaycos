<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/3/15
 * Time: 6:57 AM
 */
require_once("inc/init.php");
?>
@extends('layouts.nocart')
@section ('content')
<!--<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Shopping Cart</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="index.html">Home</a> / <span>Shopping Cart</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>-->
{{--*/$order = Session::get("order")/*--}}
<?php
if(!Session::has("order")){
    return Redirect::to('pages/home');
    exit;
}
?>
<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-6 col-md-6">
            <div class="beta-callout-box beta-callout-box-a">
                <div class="media">
                    <!--<div class="pull-left"> <i class="fa fa-lightbulb-o"></i> </div>-->
                    <div class="media-body">
                        <h5>YOUR ORDER IS BEING PROCESSED</h5>

                        <div class="space40">&nbsp;</div>
                        <p>Order number is {{$order->invoice_no}} made on date, will be sent to <br> <Strong>{{$order->shipping_firstname}} {{$order->shipping_lastname}}</Strong></p>
                        <div class="space10">&nbsp;</div>
                        <p>
                            Address: <b> {{$order->address}}, {{$order->city}}</b> <br>
                            Payment Method: <b>{{$order->payment_method}}</b> <br>
                            Shipping Method: <b>{{$order->shipping_method}}</b> <br>

                        </p>
                        <div class="space20">&nbsp;</div>
                        <div class="table-responsive">
                            <!-- Shop Products Table -->
                            <table class="table portfolio-table">
                                <tbody><tr>
                                    <th>{{Cart::count()}} Item(s) </th>
                                    <td>by Melkay Cosmetics<br> Expected arrival 1 - 6 days</td>
                                    <td><strong>&#8358;{{number_format($order->sub_total,2,".",",")}}</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Subtotal:</td>
                                    <td>{{number_format($order->sub_total,2,".",",")}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Delivery:</td>
                                    <td>{{$order->shipping_method}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Total:</th>
                                    <td>&#8358;{{number_format($order->total,2,".",",")}}{{Cart::destroy()}}</td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="beta-callout-box beta-callout-box-a">
                    <div class="media">
                        <!--<div class="pull-left"> <i class="fa fa-lightbulb-o"></i> </div>
                        <div class="media-body">
                            <h5>Why Use Custom Box?</h5>
                            <p>Nemo enim ips voluptatem quia volupas sit aspe aut odi sed quia consequuntur magni dolores eos qui ratione.</p>
                            <div class="space10">&nbsp;</div>
                            <a class="beta-btn primary" href="#">Read More <i class="fa fa-chevron-right"></i></a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
<?php Session::flush(); ?>