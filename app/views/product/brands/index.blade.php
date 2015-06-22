<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/26/15
 * Time: 11:45 PM
 */
?>

<?php
require_once("inc/init.php");
?>

@extends("layouts.inner")
@section("content")

<div class="beta-products-list">
    @if($products)
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h4>Products Listing</h4>
        </div>
        {{--*/$x=1/*--}}
        @foreach($products as $latest)
        <div class="col-sm-4 wow fadeInDown">
            <div class="single-item">
                <div class="single-item-header">
                    <?php
                    if($latest->image){
                        if(public_path()){
                            $source_folder = public_path().'/uploads/images/';
                            $destination_folder = public_path(). '/uploads/images/';
                        }else{
                            $source_folder = '/home/melkaycos/public_html/uploads/images/';
                            $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                        }
                    $image_info = pathinfo($source_folder.$latest->image);
                    $image_extension = strtolower($image_info["extension"]); //image extension
                    $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                    $imgName = $image_name_only."-262x311".".".$image_extension;


                    ?>
                    <a href="{{ASSETS_URL}}/product/details/{{$latest->id}}"><img src="{{ASSETS_URL.'/uploads/images/thumbs/'.$imgName}}" style="width:262px !important; height:311px !important" alt=""></a>
                   <?php  } ; ?>
                </div>
                <div class="single-item-body">
                    <p class="single-item-title">{{$latest->title}}</p>
                    <p class="single-item-price">
                        <span>&#8358;{{number_format($latest->price,2,".",",")}}</span>
                    </p>
                </div>
                <div class="single-item-caption">

                    <a class="add-to-cart pull-left" href="javascript:void(0);" pid="{{$latest->id}}"><i class="fa fa-shopping-cart"></i></a>
                    <a class="beta-btn primary" href="{{ASSETS_URL}}/product/details/{{$latest->id}}">Details <i class="fa fa-chevron-right"></i></a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @if(  $x%3 ==0  )
        <div class="space50">&nbsp;</div>
        @endif
        {{--*/$x++/*--}}
        @endforeach
    </div>
    @else
    <div class="row"><div class="col-sm-12 col-lg-12"> <h6>No Product found on this category</h6></div></div>
    @endif
</div>
@stop
@section('aside')
@include('includes.sidebar')
@stop