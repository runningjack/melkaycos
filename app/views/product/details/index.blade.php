<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/23/15
 * Time: 1:32 PM
 */
?>

<?php
require_once("inc/init.php");
?>

@extends("layouts.detail")
@section("content")
@if($myproduct)
<div class="row">
    <div class="col-sm-4">
        <?php
            if($myproduct->image != ""){
                if(public_path()){
                    $source_folder      = public_path().'/uploads/images/';
                    $destination_folder = public_path(). '/uploads/images/';
                }else{
                    $source_folder      = '/home/melkaycos/public_html/uploads/images/';
                    $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                }

                $image_info = pathinfo($source_folder.$myproduct->image);
                $image_extension = strtolower($image_info["extension"]); //image extension
                $image_name_only = strtolower($image_info["filename"]);//file name only, no extension
                
                $imgName = $image_name_only."-262x311".".".$image_extension;
            echo "<img src='".ASSETS_URL."/uploads/images/thumbs/".$imgName."' alt=''>";
        }?>
    </div>
    <div class="col-sm-8">
        <div class="single-item-body">
            <p class="single-item-title"><h4>{{$myproduct->title}}</h4></p>

            <p class="single-item-price">
                @if(isset($price) && $price >0 )
                <span>&#8358;{{number_format($price,2,".",",")}}</span>
                @else
                <span>&#8358;{{number_format($myproduct->price,2,".",",")}}</span>
                @endif

            </p>

        </div>
        <div class="clearfix"></div>
        <div class="space20">&nbsp;</div>

        <div class="single-item-desc">
            <p>

                <?php
                $highligt_stream = "";
                if($myproduct->description !=""){
                    $cat =($myproduct->description);
                    // echo $cat;
                    $higlights = explode(" ",$myproduct->description);

                    $z=1;

                    foreach($higlights as $higlight){
                        $highligt_stream .= $higlight." ";
                        $z++;
                        if(count($higlights) > 50){
                            if($z == 50){
                                goto a;
                            }
                        }
                    }
                }else{

                }
                a:100;
                ?>
            {{$highligt_stream}}

            </p>
        </div>
        <div class="space20">&nbsp;</div>

        <p>Available Options:</p>
        <div class="single-item-options">
           <b>Quantity</b>    <select type="text" placeholder="enter quantity" name="qty" id="qty" class="wc-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                </select>
           <?php
           $size =1;
           $price = 0;
           if($moptions && count($moptions)>0){
               foreach($moptions as $moption){
                   // $optionvalues = DB::table("options_")
                   if(strtolower($moption['name']) =="buying"){
                       $values = Productoptions::where("product_id",$myproduct->id)->where("option_type","buying")->get();
                       if(count($values) > 0){

                           echo "<input type='hidden' name='buyoid' id='pobj' value='".$values[0]['product_option_value_id']."' >
                        <select optid='".$values[0]['product_option_value_id']."' pid='".$myproduct->id."' class='wc-select buying' name='".$moption['name']."'>";
                           echo "<option value=''>--Package--</option>";
                           $p=1;
                           foreach ($values as $value) {
                               if($p==1){
                                   $price = $value->price;
                               }
                               //if($option_value['type'] === "size" ){
                               echo "<option value='".$value->option_value."' price='".$value->price."'>".$value->option_value."</option>";
                               //}
                               $p++;
                           }
                           echo "</select>";
                       }
                   }

                   if(strtolower($moption['name']) =="size"){
                       $values = Productoptions::where("product_id",$myproduct->id)->where("option_type","size")->get();
                       if(count($values) >0){
                           echo "<input type='hidden' name='sizeoid'  value='".$values[0]['product_option_value_id']."' >";
                           echo "<select optid='".$moption['product_option_value_id']."' pid='".$myproduct->id."' class='wc-select size' name='".$moption['name']."'>";
                           echo "<option value=''>--Size--</option>";

                           foreach ($values as $value) {
                               //if($option_value['type'] === "size" ){
                               echo "<option value='".$value->option_value."' price='".$value->price."' pref='".$value->price_prefix."'>".$value->option_value."</option>";
                               //}
                           }
                           echo "</select>";
                       }
                   }

                   if(strtolower($moption['name']) =="volume"){
                       $values = Productoptions::where("product_id",$myproduct->id)->where("option_type","volume")->get();
                       if(count($values)>0 ){
                           echo "<input type='hidden' name='volumeoid'  value='".$values[0]['product_option_value_id']."' >
                        <select optid='".$values[0]['product_option_value_id']."' pid='".$myproduct->id."' class='wc-select volume' name='".$moption['name']."'>";
                           echo "<option value=''>--Volume--</option>";
                           foreach ($values as $value) {
                               //if($option_value['type'] === "size" ){
                               echo "<option value='".$value->option_value."' price='".$value->price."' pref='".$value->price_prefix."'>".$value->option_value."</option>";
                               //}
                           }
                           echo "</select>";
                       }
                   }

                   if(strtolower($moption['name']) =="color"){
                       $values = Productoptions::where("product_id",$myproduct->id)->where("option_type","color")->get();
                       if(count($values) > 0){
                           echo "<input type='hidden' name='coloroid'  value='".$values[0]['product_option_value_id']."' >
                        <select optid='".$values[0]['product_option_value_id']."' pid='".$myproduct->id."' class='wc-select color' name='".$moption['name']."'>";
                           echo "<option value=''>--Color--</option>";
                           foreach ($values as $value) {
                               //if($option_value['type'] === "size" ){
                               echo "<option value='".$value->option_value."' price='".$value->price."' pref='".$value->price_prefix."'>".$value->option_value."</option>";
                               //}
                           }
                           echo "</select>";
                       }
                   }

               }
           }


        ?>


            <a class="add-to-cart" href="javascript:void(0);" pid="{{$myproduct->id}}"><i class="fa fa-shopping-cart"></i></a>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endif
<hr>
<div class="space40">&nbsp;</div>
<div class="woocommerce-tabs">
    <ul class="tabs">
        <li class="active"><a href="#tab-description">Description</a></li>
        <li class=""><a href="#tab-reviews">Reviews (0)</a></li>
    </ul>

    <div class="panel" id="tab-description" style="display: block;">
        <?php
        if($myproduct->description !=""){
            echo $myproduct->description;
        }else{
            echo "";
        }
        ?>
    </div>
    <div class="panel" id="tab-reviews" style="display: none;">
        <p>No Reviews</p>
    </div>
</div>


@stop
@section('aside')
  <h3 class="widget-title"><small>More products from this brand</small></h3>
    @if($related)
        <div class="beta-sale beta-lists">
        @foreach($related as $relate)
            <div class="media beta-sales-item">
                <a class="pull-left" href="{{ASSETS_URL}}/product/details/{{$relate->id}}">

                    @if($relate->image != "")
                    @if(public_path())
                    {{--*/$image_info = pathinfo(public_path().'/uploads/images/'.$relate->image)/*--}}
                    {{--*/$image_extension = strtolower($image_info["extension"])/*--}}
                    {{--*/$image_name_only = strtolower($image_info["filename"])/*--}}
                    {{--*/$destination_folder = public_path().'/uploads/images/'/*--}}
                    @else
                    {{--*/$image_info = pathinfo('/home/melkaycos/public_html/uploads/images/'.$relate->image)/*--}}
                    {{--*/$image_extension = strtolower($image_info["extension"])/*--}}
                    {{--*/$image_name_only = strtolower($image_info["filename"])/*--}}
                    {{--*/$destination_folder = '/home/melkaycos/public_html/uploads/images/'/*--}}
                    @endif

                    {{--*/$imgName = $image_name_only."-50x50".".".$image_extension/*--}}

                {{"<img alt='' src='".ASSETS_URL."/uploads/images/thumbs/".$imgName."'>"}}
                    @endif


                </a>
                <div class="media-body">
                    {{$relate->title}}
                    <br>
                    <span class="beta-sales-price">&#8358;{{number_format($relate->price,2,".",",")}}</span>
                </div>
            </div>
        @endforeach
        </div>
    @endif
@stop