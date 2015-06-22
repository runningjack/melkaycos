<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 2/23/15
 * Time: 5:54 PM
 */
?>

<?php
require_once("inc/init.php");
require_once("inc/config.ui.php");
$page_css[] = "your_style.css";
?>
<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    <style>
        ul.imglist {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        ul.imglist li{
            float: left;
            margin-right: 10px;
            border: 5px solid #f3f3f3;
            position: relative;
            -webkit-transition: box-shadow 0.5s ease;
            -moz-transition: box-shadow 0.5s ease;
            -o-transition: box-shadow 0.5s ease;
            -ms-transition: box-shadow 0.5s ease;
            transition: box-shadow 0.5s ease;
        }

        ul.imglist li label input[type="radio"] {
            margin: 0;
            margin-top:-10px;
            margin-left: -40px;
            position: absolute;
        }

        ul.imglist li:hover {
            border: 5px solid #eee;
            cursor: pointer;
            -webkit-box-shadow: 0px 0px 7px rgba(255,255,255,0.9);
            box-shadow: 0px 0px 7px rgba(255,255,255,0.9);
        }
    </style>
</head>
<body id="page-top" >
@include('includes.header')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Category</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ASSETS_URL}}">Home</a> / <span></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-9 main-content pull-right">
                @yield('content')
            </div>
            <div class="col-sm-3 aside">
                @yield('aside')
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
<?php
//include required scripts
//include("inc/scripts.php");
?>

<script src="<?php echo ASSETS_URL ?>/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/waypoints.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/wow.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/animo/Animo.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/dug/dug.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/scripts.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/loading-overlay.min.js"></script>


<script>
    //color
    jQuery(document).ready(function($) {


        $(".cart-item-delete").each(function(){
            $(this).on("click",function(){
                var target = $(this).parents("div.cart-body");
                //if (target.hasClass('loading')) {

                //} else {
                target.loadingOverlay();
                //};
                var request = $.ajax({
                    url : "",
                    type:"post",
                    data:{delid:$(this).attr("pid"),currency:""},
                    dataType:"html"
                })
                request.done(function(data){
                    $(".cart").html(data);
                    target.loadingOverlay('remove');
                    jQuery(".cart .beta-select").on("click",function(){return jQuery(".cart-body").slideToggle(),!1});
                    var a=jQuery(".cart");jQuery(document).mouseup(function(b){a.is(b.target)||0!==a.has(b.target).length||jQuery(".cart-body").slideUp()})
                    //e.stopImmediatePropagation()
                })
                request.fail(function(){

                })

            })
        })


        $(".add-to-cart").each(function(){
            var cartData = "";
            var target = $(this);
            var qty = target.siblings("input#qty")
            if(qty==""){
                alert("Enter Quantity")
                return false
            }
            var buying =""
            var volume =""
            var size =""
            var weight =""
            var optid =""

            if($(this).siblings('select[name="buying"]').length > 0){
                buying = ($(this).siblings('select[name="buying"]').val())
                optid = ($(this).siblings('select[name="buying"]').attr("optid"))

            }
            if($(this).siblings('select[name="volume"]').length > 0){
                volume = ($(this).siblings('select[name="volume"]').val())
                optid = ($(this).siblings('select[name="volume"]').attr("optid"))
            }
            if($(this).siblings('select[name="size"]').length > 0){
                size = ($(this).siblings('select[name="size"]').val())
                optid = ($(this).siblings('select[name="size"]').attr("optid"))
            }
            $(this).on("click",function(){
                target.loadingOverlay();
                var request = $.ajax({
                    url:"",
                    type:"post",
                    data:{pid:$(this).attr("pid"),qty:qty.val(),buying:buying,volume:volume,size:size,weight:weight,optid:optid},
                    dataType:"html"
                });
                request.done(function(data){
                    //console.log(data)
                    //cartData = JSON.stringify(data);
                    $(".cart").html(data);

                    target.loadingOverlay('remove');
                    jQuery(".cart .beta-select").on("click",function(){return jQuery(".cart-body").slideToggle(),!1});
                    var a=jQuery(".cart");jQuery(document).mouseup(function(b){a.is(b.target)||0!==a.has(b.target).length||jQuery(".cart-body").slideUp()})
                    //e.stopImmediatePropagation()
                })
                request.fail(function(){
                    alert("Request failed: ")

                })

                return false

            })
        })


    });
</script>
</body>
</html>