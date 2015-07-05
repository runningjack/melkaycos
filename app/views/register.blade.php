<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 4/28/15
 * Time: 12:38 PM
 */
require_once("inc/init.php")
?>
@extends('layouts.nosidebar')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Register</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="#">Home</a> / <span>Register</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content ">


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
            <div class="col-sm-6">
                {{ Form::open(array('url'=>'register/', 'method'=>'POST', "id"=>"frm", 'class'=>'beta-form-checkout', 'files'=>true)) }}
                <h4>Sign Up</h4>
                <div class="space20">&nbsp;</div>

                <div class="form-block">
                    <label for="country">Country*</label>
                    <select name="country" id="country">
                        <option value="">Select a country…</option>
                        @if($countries)
                        @foreach($countries as $country)
                        @if($country->name == "Nigeria")
                        <option value="{{$country->name}}" selected>{{$country->name}}</option>
                        @else
                        <option value="{{$country->name}}">{{$country->name}}</option>
                        @endif
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-block">
                    <label for="firstname">First name*</label>
                    <input type="text" id="firstname" name="firstname" required placeholder="first name" value="{{Input::old('firstname')}}">
                </div>

                <div class="form-block">
                    <label for="your_last_name">Last name*</label>
                    <input type="text" id="lastname" name="lastname" required placeholder="last name" value="{{Input::old('lastname')}}">
                </div>

                <div class="form-block">
                    <label for="company">Company name</label>
                    <input type="text" id="company" name="company" placeholder="company" value="{{Input::old('company')}}">
                </div>

                <div class="form-block">
                    <label for="address">Address*</label>
                    <input type="text" id="address" name="address" placeholder="Street Address" required value="{{Input::old('address')}}">
                    <input type="text" id="apartment" name="apartment" placeholder="Apartment, suite, unit etc." value="{{Input::old('apartment')}}">
                </div>

                <div class="form-block">
                    <label for="town_city">Town / City*</label>
                    <input type="text" id="city" name="city" required placeholder="Town / City*" value="{{Input::old('city')}}">
                </div>

                <div class="form-block">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" placeholder ="State / Country" required value="{{Input::old('state')}}">
                </div>

                <div class="form-block">
                    <label for="email">Email address*</label>
                    <input type="email" id="email" name="email" required placeholder="email" value="{{Input::old('email')}}">
                </div>

                <div class="form-block">
                    <label for="phone">Phone*</label>
                    <input type="text" id="phone" name="phone" placeholder="phone" required value="{{Input::old('phone')}}">
                </div>

                <p>
                    <input type="checkbox" name="ship_billing" id="ship_billing">
                    <label for="ship_billing"><span></span>Use Address as  billing address?</label>
                </p>

                <div class="space20">&nbsp;</div>

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
            </div>
            <div class="col-sm-6">
                <div class="beta-callout-box beta-callout-box-a">
                    <div class="media">
                        <!--<div class="pull-left"> <i class="fa fa-lightbulb-o"></i> </div>-->
                        <div class="media-body">
                            <h5>Sign In</h5>

                            <div class="space40">&nbsp;</div>
                            {{ Form::open(array('action'=>array('Account\AuthController@postAccountLogin'), 'method'=>'POST', 'class'=>'form-horizontal')) }}
                                <p><input type="text" class="col-3" name="email" id="email" placeholder="Email"></p>
                                <p><input type="password" class="col-3" name="password" placeholder="Password"></p>
                                <p><button type="submit" class="btn btn-primary">Sign in</button>
                                    <a href="#">Forgot Password?</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
@stop
<div class="space20">&nbsp;</div>


