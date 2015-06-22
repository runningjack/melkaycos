<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 1/18/15
 * Time: 11:01 AM
 */

?>
@extends("layouts.inner")
@section("content")

<div class="col-sm-12">
    <div class="text-center error-box">
        <h1 class="error-text-2 bounceInDown animated"> Error 404 <span class="particle particle--c"></span><span class="particle particle--a"></span><span class="particle particle--b"></span></h1>
        <h2 class="font-xl"><strong><i class="fa fa-fw fa-warning fa-lg text-warning"></i> Page <u>Not</u> Found</strong></h2>
        <br />
        <p class="lead">
            The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from
        </p>

        <br>
       <!-- <div class="error-search well well-lg padding-10">
            <div class="input-group">
                <input class="form-control input-lg" type="text" placeholder="let's try this again" id="search-error">
                <span class="input-group-addon"><i class="fa fa-fw fa-lg fa-search"></i></span>
            </div>
        </div>-->



    </div>

</div>

@stop