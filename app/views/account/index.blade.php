<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/4/15
 * Time: 4:57 AM
 */
require_once('inc/init.php');
?>
@extends('layouts.nosidebar')
@section('content')
<div class="container">
    <div id="content">
        <div class="row">
            <div class="tabs-left">
                <ul class="nav nav-tabs tabs-left" id="demo-pill-nav">
                    <li class="active">
                        <a href="#tab-r1" data-toggle="tab"><i class="fa fa-user fa-2x"></i> My Profile </a>
                    </li>
                    <li>
                        <a href="#tab-r2" data-toggle="tab"> <i class="fa fa-list-alt fa-2x"></i> My Orders</a>
                    </li>
                    <li>
                        <a href="#tab-r3" data-toggle="tab"><i class="fa fa-thumbs-up fa-2x"></i> My Favorite</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-r1">
                        <div class="row">
                            <div class="col-12">

                                @if(Session::has('error_message'))
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
                                </div>
                                @endif
                                @if(Session::has('success_message'))
                                <div class="alert alert-success fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-check"></i>{{Session::get('success_message')}}
                                </div>
                                @endif

                                @if ( ! empty( $errors ) )
                                @foreach ( $errors->all() as $error )
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-times"></i>{{$error}}

                                </div>

                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-1"><i class="fa fa-user fa-5x"></i> </div>
                            <div class="col-sm-6">
                                {{ Form::open(array('url'=>'register/', 'method'=>'POST', "id"=>"frm", 'class'=>'beta-form-checkout', 'files'=>true)) }}
                                <div class="space20">&nbsp;</div>
                                <h4>Account Information</h4>
                                <div class="space20">&nbsp;</div>

                                <div class="form-block">
                                    <label for="country">Country*</label>
                                    <select name="country" id="country">
                                        <option value="">Select a country…</option>
                                        @if($countries)
                                        @foreach($countries as $country)
                                        {{--*/ $st = $country->name /*--}}>
                                        @if(Input::old("country") !="")
                                        @if(Input::old("country")==$st)
                                        <option value="{{$country->name}}" selected>{{$country->name}}</option>
                                        @endif
                                        @else
                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="firstname">First name*</label>
                                    {{--*/$me =  Auth::account()->get()/*--}}
                                    <input type="text" id="firstname" name="firstname" required placeholder="first name" value="{{$me->firstname}}">
                                </div>

                                <div class="form-block">
                                    <label for="your_last_name">Last name*</label>
                                    <input type="text" id="lastname" name="lastname" required placeholder="last name" value="{{$me->lastname}}">
                                </div>

                                <div class="form-block">
                                    <label for="company">Company name</label>
                                    <input type="text" id="company" name="company" placeholder="company" value="{{$me->company}}">
                                </div>

                                <div class="form-block">
                                    <label for="address">Address*</label>
                                    <input type="text" id="address" name="address" placeholder="Street Address" required value="{{$me->address}}">
                                    <input type="text" id="apartment" name="apartment" placeholder="Apartment, suite, unit etc." value="{{$me->apartment}}">
                                </div>

                                <div class="form-block">
                                    <label for="town_city">Town / City*</label>
                                    <input type="text" id="city" name="city" required placeholder="Town / City*" value="{{$me->city}}">
                                </div>

                                <div class="form-block">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder ="State / Country" required value="{{$me->state}}">
                                </div>

                                <div class="form-block">
                                    <label for="email">Email address*</label>
                                    <input type="email" id="email" name="email" required placeholder="email" value="{{$me->email}}">
                                </div>

                                <div class="form-block">
                                    <label for="phone">Phone*</label>
                                    <input type="text" id="phone" name="phone" placeholder="phone" required value="{{$me->phone}}">
                                </div>


                                <!--<div class="space20">&nbsp;</div>

                                <div class="form-block">
                                    <label for="username" >User Name:</label>
                                    <input type="text" name="username" id="username" required="required" value="{{Input::old('username')}}">
                                </div>

                                <div class="form-block">
                                    <label for="password" >Password:</label>
                                    <input type="password" class="beta-select" name="password" id="password" required>
                                </div>

                                <div class="form-block">
                                    <label for="confirmpassword" >Confirm Password:</label>
                                    <input type="password" name="confirmpassword" class="beta-select" id="confirmpassword" required>
                                </div>

                                <div class="text-center"><button class="beta-btn primary"><i class="fa fa-save "></i> Register</button></div>
                                </form>
                            </div>-->
                            <!--<div class="col-sm-6">
                                <div class="beta-callout-box beta-callout-box-a">
                                    <div class="media">
                                        <div class="pull-left"> <i class="fa fa-lightbulb-o"></i> </div>-->
                            <!-- <div class="media-body">
                                 <h5>Sign In</h5>


                             </div>
                         </div>
                     </div>-->
                 </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab-r2">
                        <div class="col-sm-1"><i class="fa fa-list-alt fa-5x"></i> </div>
                        <div class="col-sm-6">
                            <div class="space20">&nbsp;</div>
                            <div class="table-responsive">
                                <!-- Shop Products Table -->
                                <table class="table portfolio-table">
                                    <thead>
                                        <tr><th>Order ID</th><th>Order Date</th><th>Total</th><th>Shipping</th><th>Payment</th><th>Status</th></tr>
                                    </thead>
                                    <tbody>

                                        @if($myorders)
                                            @foreach($myorders as $order)
                                            <tr><td>{{$order->invoice_no}}</td><td>{{$order->created_at}}</td><td>{{$order->total}}</td><td>{{$order->shipping_method}}</td><td>{{$order->payment_method}}</td><td>
                                                    <?php
                                                    if($statuses){
                                                        foreach($statuses as $status){
                                                            if($order->order_status_id == $status->id ){
                                                                echo"$status->name";
                                                            }

                                                        }
                                                    }
                                                    ?>
                                            </td></tr>
                                            @endforeach
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-r3">
                        <p>
                        <div class="col-sm-1"><i class="fa fa-thumbs-up fa-5x"></i> </div>
                        <div class="col-sm-6">
                            <div class="space20">&nbsp;</div>
                            <div class="table-responsive">
                                <!-- Shop Products Table -->
                                <!--<table class="table portfolio-table">
                                    <thead>
                                    <tr><th>Order ID</th><th>Order Date</th><th>Total</th><th>Shipping</th><th>Payment</th><th>Status</th></tr>
                                    </thead>
                                    <tbody>

                                    @if($myorders)
                                    @foreach($myorders as $order)
                                    <tr><td>{{$order->invoice_no}}</td><td>{{$order->created_at}}</td><td>{{$order->total}}</td><td>{{$order->shipping_method}}</td><td>{{$order->payment_method}}</td><td></td></tr>
                                    @endforeach
                                    @else
                                    @endif
                                    </tbody>
                                </table>-->
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

<?php

?>