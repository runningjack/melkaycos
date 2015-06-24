<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/22/14
 * Time: 10:26 AM
 */
?>

@extends("layouts.nosidebar")
@section("content")
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{$page->title}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{url()}}">Home</a> / <span>{{$page->title}}</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content">
        @if (isset($page))
       <!-- <h2>{{ $page->title }}</h2>-->

        {{ $page->p_content }}
        @else

        @endif
    </div>
</div>


@stop