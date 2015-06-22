<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/4/15
 * Time: 9:03 AM
 */
require_once ('inc/init.php');
?>
@extends('layouts.nosidebar')
@section('content')
<div class="container">
    <div id="content ">
        <div class="row">

        <div class="col-6">
<div class="center">
    <div class="row">
        <div class="col-6">

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
    <div class="beta-callout-box beta-callout-box-a">
        <div class="media">
            <!--<div class="pull-left"> <i class="fa fa-lightbulb-o"></i> </div>-->
            <div class="media-body">
                <h5>Sign In</h5>

                <div class="space40">&nbsp;</div>
                {{ Form::open(array('action'=>array('AuthController@postAccountLogin'), 'method'=>'POST', 'class'=>'form-horizontal')) }}
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
</div>
@stop