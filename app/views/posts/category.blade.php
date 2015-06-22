<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/26/14
 * Time: 3:17 PM
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

<?php
    if(isset($categories)){
        foreach($categories as $category){
           echo "<div class='post-container'>
            <div class='post-head' ><h4>$category->title</h4></div>
                <div class='post-body'>
                    <p>";
            if($category->p_content !=""){
                $cat =($category->p_content);
              // echo $cat;
                $higlights = explode(" ",$category->description);
                $highligt_stream = "";
                $z=1;
                foreach($higlights as $higlight){
                    $highligt_stream .= $higlight." ";
                    $z++;

                    if($z == 50){
                        goto a;
                    }
                }
            }
a:100;
            echo $highligt_stream;
            $clink = explode("/",$category->permalink);
            echo"<a href='".$category->permalink."'>...Read more</a></p>
                </div>
            </div>";
        }
    }
?>
@stop