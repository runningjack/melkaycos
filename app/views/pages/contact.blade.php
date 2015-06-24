<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/22/14
 * Time: 4:30 PM
 */
?>
@extends("layouts.inner")
@section('content')
<div class="indent">

    @if (isset($post->extras['contact_coords']))
    <div class="container">
        <div class="grid_12">

            <!-- BEGIN GOOGLE MAP -->
            <div class="map-wrapper">
                <div id="map_canvas"></div>
            </div>
            <!-- END GOOGLE MAP -->

        </div>
    </div>
    @endif

    <div class="container">

        <div class="grid_8">
            <h4 class="alt-title">send us mail:</h4>

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
            <!-- BEGIN CONTACT FORM -->
            {{ Form::open(array('url'=>'contact', 'id'=>'contact-form', 'class'=>'contact-form')) }}
            <div class="grid_5 alpha">
                <div class="field clearfix">
                    {{ Form::textarea('comments', Input::old('comments'), array('id'=>'comments', 'cols'=>'30', 'rows'=>'10', 'placeholder'=>'your comment...')) }}
                </div>
            </div>
            <div class="grid_3 omega">
                <div class="field clearfix">
                    {{ Form::text('name', Input::old('name'), array('id'=>'name', 'placeholder'=>'your name...')) }}
                </div>
                <div class="field clearfix">
                    {{ Form::text('email', Input::old('email'), array('id'=>'email', 'placeholder'=>'your email...')) }}
                </div>
                <div class="field clearfix">
                    {{ Form::text('subject', Input::old('subject'), array('id'=>'subject', 'placeholder'=>'your subject...')) }}
                </div>
                <div class="btn-wrapper">
                    <input type="submit" id="submit" value="send"/><i class="btn-marker"></i>
                </div>
                <div id="response"></div>
            </div>
            {{ Form::close() }}
            <!-- END CONTACT FORM -->

        </div>


    </div>

</div>
@stop