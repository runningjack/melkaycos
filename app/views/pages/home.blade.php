<?php
require_once("inc/init.php");
?>
@extends("layouts.default")
@section("content")
<div class="space10">&nbsp;</div>
<div class="dg">
    <div class="col-6">
        <div class="beta-banner">
            <img src="<?php echo ASSETS_URL?>/uploads/images/banners/banner2.png" alt="">
            <h2
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 1000,
										"delay" : 100,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"top" : [20, 20, "px"],
											"right" : [-300, 25, "px"]
										}
									}'
                >Skin Toning</h2>
            <p
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 1000,
										"delay" : 400,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"top" : [65, 65, "px"],
											"right" : [-300, 25, "px"]
										}
									}'
                > <br /> </p>
            <a
                class="beta-banner-layer beta-btn text-right"
                href="javascript:void(0)"
                data-animo='{
										"duration" : 1000,
										"delay" : 300,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"bottom" : [20, 20, "px"],
											"right" : [-300, 25, "px"]
										}
									}'
                >Shop Now</a>
        </div>
    </div>
    <div class="col-6">
        <div class="beta-banner">
            <img src="<?php echo ASSETS_URL?>/uploads/images/banners/banner3.png" alt="">
            <h2
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 1000,
										"delay" : 100,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"top" : [20, 20, "px"],
											"right" : [-300, 25, "px"]
										}
									}'
                >Creams &amp; Soaps</h2>
            <p
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 1000,
										"delay" : 400,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"top" : [65, 65, "px"],
											"right" : [-300, 25, "px"]
										}
									}'
                > <br /> </p>
            <a
                class="beta-banner-layer beta-btn text-right"
                href="javascript:void(0)"
                data-animo='{
										"duration" : 1000,
										"delay" : 300,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"bottom" : [20, 20, "px"],
											"right" : [-300, 25, "px"]
										}
									}'
                >Shop Now</a>
        </div>
    </div>
</div>

<div class="space10">&nbsp;</div>
<div class="beta-promobox">
    <h2 class="pull-left "><span class="white">FREE</span> Standard Delivery on orders OVER &#8358;150,000!</h2>
    <a class="beta-btn pull-right mt5" href="javascript:void(0)">Get Coupon</a>
    <div class="clearfix"></div>
</div> <!-- .beta-promobox -->

<div class="space50">&nbsp;</div>
<div class="beta-products-list">
    <h4>Special Products</h4>
    <div class="beta-products-details">
       <!-- <p class="pull-left">438 styles found | <a href="#">View all</a></p>-->
        <p class="pull-right">
            <span class="sort-by">Sort by </span>
            <select name="sortproducts" class="beta-select-primary">
                <option value="desc">Latest</option>
                <option value="popular">Popular</option>
                <option value="rating">Rating</option>
                <option value="best">Best</option>
            </select>
        </p>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        @if($specialproducts)
        @foreach($specialproducts as $latest)
        <div class="col-sm-4 wow fadeInDown">
            <div class="single-item">
                <div class="ribbon-wrapper"><div class="ribbon sale">Special</div></div>
                <div class="single-item-header">

                    <?php
                   if($latest->image != ""){
                       if(public_path()){
                           $source_folder = public_path().'/uploads/images/';
                           $destination_folder = public_path(). '/uploads/images/';
                           $image_info = pathinfo(public_path().'/uploads/images/'.$latest->image);
                       }else{
                           $source_folder = '/home/melkaycos/public_html/uploads/images/';
                           $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                           $image_info = pathinfo('/home/melkaycos/public_html/uploads/images/'.$latest->image);
                       }

                    $image_extension = strtolower($image_info["extension"]); //image extension
                    $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                    $img2 = \Image::make($source_folder.$latest->image);
                    $img2->resize(262,311);
                    $imgName = $image_name_only."-262x311".".".$image_extension;
                    $img2->save($destination_folder."thumbs/".$imgName);


                    echo "<a href='".url()."/product/details/".$latest->id."'><img src='".url()."/uploads/images/thumbs/".$imgName."' style='width:262px !important; height:311px !important'></a>";
                    }?>
                </div>
                <div class="single-item-body">
                    <p class="single-item-title">{{$latest->title}}</p>
                    <p class="single-item-price">
                        <span class="beta-sales-price">&#8358;{{number_format($latest->price,2,".",",")}}</span>
                    </p>
                </div>
                <div class="single-item-caption">
                    <!--<a class="add-to-cart pull-left" href="javascript:void(0)" pid="{{$latest->id}}"><i class="fa fa-shopping-cart"></i></a>-->
                    <a class="beta-btn primary" href="{{ASSETS_URL}}/product/details/{{$latest->id}}">Details <i class="fa fa-chevron-right"></i></a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div> <!-- .beta-products-list -->

<div class="space50">&nbsp;</div>
<div class="beta-products-list">
    <h4>New Products</h4>
    <div class="space50">&nbsp;</div>

    @if($newproducts)
    {{--*/$x=1/*--}}
    @foreach($newproducts as $latest)
    @if( $x==1 || $x%3 ==1  )
    <div class="space50">&nbsp;</div>
    <div class="row">
        @endif

        @if($x <= 6)
        <div class="col-sm-4 wow fadeInDown">
            <div class="single-item">
                <div class="single-item-header">

                    <?php
                    if($latest->image != ""){
                        if(public_path()){
                            $source_folder = public_path().'/uploads/images/';
                            $destination_folder = public_path(). '/uploads/images/';
                            $image_info = pathinfo(public_path().'/uploads/images/'.$latest->image);
                        }else{
                            $source_folder = '/home/melkaycos/public_html/uploads/images/';
                            $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                            $image_info = pathinfo('/home/melkaycos/public_html/uploads/images/'.$latest->image);
                        }

                        $image_extension = strtolower($image_info["extension"]); //image extension
                        $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                        $img2 = \Image::make($source_folder.$latest->image);
                        $img2->resize(262,311);
                        $imgName = $image_name_only."-262x311".".".$image_extension;
                        $img2->save($destination_folder."thumbs/".$imgName);


                        echo "<a href='".url()."/product/details/".$latest->id."'>
                    <img src='".url()."/uploads/images/thumbs/".$imgName."' style='width:262px !important; height:311px !important'></a>";
                    }
                    ?>
                </div>
                <div class="single-item-body">
                    <p class="single-item-title">{{$latest->title}}</p>
                    <p class="single-item-price">
                        <span class="beta-sales-price">&#8358;{{number_format($latest->price,2,".",",")}}</span>
                    </p>
                </div>
                <div class="single-item-caption">
                    <!--<a class="add-to-cart pull-left" href="javascript:void(0)" pid="{{$latest->id}}"><i class="fa fa-shopping-cart"></i></a>-->
                    <a class="beta-btn primary" href="{{ASSETS_URL}}/product/details/{{$latest->id}}">Details <i class="fa fa-chevron-right"></i></a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @endif
        @if($x%3 ==0 )
    </div>
    @endif
    {{--*/$x++/*--}}
    @endforeach
    @endif

    

</div>

<div class="space50">&nbsp;</div>

<div class="dg">
    <div class="col-6 ">
        <div class="beta-banner beta-banner-a">
            <img src="<?php echo ASSETS_URL?>/uploads/images/banners/banner4.png" alt="">
            <img
                class="beta-banner-layer"
                src="<?php echo ASSETS_URL?>/uploads/images/banners/4/layer1.png"
                data-animo='{
										"delay" : 200,
										"template" : {
											"opacity" : [0, 1],
											"scale" : [0, 1],
											"top" : [25, 25, "px"],
											"left" : [92, 92, "px"]
										}
									}'
                alt="">
            <h6
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 800,
										"delay" : 300,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"bottom" : [-100, 45, "px"],
											"left" : [30, 30, "px"]
										}
									}'
                >Accessories</h6>
            <p
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 800,
										"delay" : 400,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"bottom" : [-100, 23, "px"],
											"left" : [62, 62, "px"]
										}
									}'
                >shop collection</p>
        </div>
    </div>
    <div class="col-6 ">
        <div class="beta-banner beta-banner-a">
            <img src="<?php echo url() ?>/uploads/images/banners/banner5.png" alt="">
            <img
                class="beta-banner-layer"
                src="<?php echo url() ?>/uploads/images/banners/5/layer1.png"
                data-animo='{
										"delay" : 200,
										"template" : {
											"opacity" : [0, 1],
											"scale" : [0, 1],
											"top" : [25, 25, "px"],
											"left" : [76, 76, "px"]
										}
									}'
                alt="">
            <h6
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 800,
										"delay" : 300,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"bottom" : [-100, 45, "px"],
											"left" : [30, 30, "px"]
										}
									}'
                >Holiday Essentials</h6>
            <p
                class="beta-banner-layer text-right"
                data-animo='{
										"duration" : 800,
										"delay" : 400,
										"easing" : "easeOutSine",
										"template" : {
											"opacity" : [0, 1],
											"bottom" : [-100, 23, "px"],
											"left" : [62, 62, "px"]
										}
									}'
                >shop collection</p>
        </div>
    </div>
</div>

<div class="space50">&nbsp;</div>
<div class="beta-products-list">
    <h4>Top Products</h4>


        @if($latestproducts)
        {{--*/$x=1/*--}}
            @foreach($latestproducts as $latest)
            @if( $x==1 || $x%3 ==1  )
            <div class="space50">&nbsp;</div>
                <div class="row">
            @endif

                @if($x <= 6)
                <div class="col-sm-4 wow fadeInDown">
                    <div class="single-item">
                        <div class="single-item-header">

                            <?php
                            if($latest->image != ""){
                                if(public_path()){
                                    $source_folder = public_path().'/uploads/images/';
                                    $destination_folder = public_path(). '/uploads/images/';
                                    $image_info = pathinfo(public_path().'/uploads/images/'.$latest->image);
                                }else{
                                    $source_folder = '/home/melkaycos/public_html/uploads/images/';
                                    $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                                    $image_info = pathinfo('/home/melkaycos/public_html/uploads/images/'.$latest->image);
                                }

                                $image_extension = strtolower($image_info["extension"]); //image extension
                                $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                                $img2 = \Image::make($source_folder.$latest->image);
                                $img2->resize(262,311);
                                $imgName = $image_name_only."-262x311".".".$image_extension;
                                $img2->save($destination_folder."thumbs/".$imgName);


                                echo "<a href='".url()."/product/details/".$latest->id."'>
                    <img src='".url()."/uploads/images/thumbs/".$imgName."' style='width:262px !important; height:311px !important'></a>";
                            }
                            ?>
                        </div>
                        <div class="single-item-body">
                            <p class="single-item-title">{{$latest->title}}</p>
                            <p class="single-item-price">
                                <span class="beta-sales-price">&#8358;{{number_format($latest->price,2,".",",")}}</span>
                            </p>
                        </div>
                        <div class="single-item-caption">
                            <!--<a class="add-to-cart pull-left" href="javascript:void(0)" pid="{{$latest->id}}"><i class="fa fa-shopping-cart"></i></a>-->
                            <a class="beta-btn primary" href="{{ASSETS_URL}}/product/details/{{$latest->id}}">Details <i class="fa fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                @endif
            @if($x%3 ==0 )
                </div>
            @endif
    {{--*/$x++/*--}}
            @endforeach
        @endif


</div> <!-- .beta-products-list -->
@stop
@section('aside')
@include('includes.sidebarIndex')
@stop