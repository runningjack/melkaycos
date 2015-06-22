<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/22/14
 * Time: 10:26 AM
 */
?>

@extends("layouts.inner")
@section("content")

            @if (isset($page))
            <h2>{{ $page->title }}</h2>

            {{ $page->p_content }}
            @else
            <h2>Welcome</h2>

            <p>The CMS public section can now be viewed at {{ HTML::link(url('/'), url('/')) }}</p>

            <p>The CMS admin can now be viewed at {{ HTML::link(url('admin'), url('admin')) }}</p>

            <p>The CMS backend can now be viewed at {{ HTML::link(url('backend'), url('backend')) }}</p>
            @endif

@stop