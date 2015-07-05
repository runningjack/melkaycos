<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/23/15
 * Time: 1:35 PM
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
            <h6 class="inner-title">Product</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ASSETS_URL}}">Home</a> / <span>Product</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-9 main-content">
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
<script src="<?php echo ASSETS_URL ?>/js/numeral.min.js"></script>



<script>
    //color
    jQuery(document).ready(function($) {


        $(".add-to-cart").each(function(){

            $(this).on("click",function(){
                var cartData = "";
                var target = $(this);
                var qty = target.siblings("input#qty")
                if(qty.val() ==""){
                    alert("Enter Quantity")
                    return false
                }
                target.loadingOverlay();
                var buying =""
                var volume =""
                var size =""
                var weight =""
                var color =""
                var optid =""

                if($(this).siblings('select[name="buying"]').length > 0){
                    buying = ($(this).siblings('select[name="buying"]').val())
                    optid = $(this).siblings('select[name="buying"]').attr("optid")

                }
                if($(this).siblings('select[name="volume"]').length > 0){
                    volume = ($(this).siblings('select[name="volume"]').val())
                    optid = ($(this).siblings('select[name="volume"]').attr("optid"))
                }
                if($(this).siblings('select[name="size"]').length > 0){
                    size = ($(this).siblings('select[name="size"]').val())
                    optid = ($(this).siblings('select[name="size"]').attr("optid"))
                }

                if($(this).siblings('select[name="color"]').length > 0){
                    color = ($(this).siblings('select[name="color"]').val())
                    optid = ($(this).siblings('select[name="color"]').attr("optid"))
                }

                var request = $.ajax({
                    url:"",
                    type:"post",
                    data:{pid:$(this).attr("pid"),qty:$("#qty").val(),buying:buying,volume:volume,color:color,size:size,weight:weight,optid:optid},
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

                    scrollToElement('.cart');
                })
                request.fail(function(){
                    alert("Request failed: ")

                })

                return false

            })
        })

        $("#qty").on("keypress",function(evt){
            return isNumberKey(evt)
        })


        $("#qty").on("keypress",function(evt){
            return isNumberKey(evt)
        })

        $(".btn_review").on("click",function(){
           // var ip = getIp();
            var request = $.ajax({
                url:"",
                type:"post",
                data:{comment_content:$("#review").val(),comment_author:$("#nickname").val(),summary:$("#summary").val(),email:$("#email").val(),comment_post_id:$("#prodid").val()},
                dataType:"html"
            });

            request.done(function(data){
                $("div.msg").html(data);
            });
        })


        $(".buying").each(function(){
            $(this).on("change",function(){
                var v,element, c,price;c=  $(".single-item-price").children("span");element= $(this).find('option:selected');
                price= element.attr("price");c.html(price);c.formatCurrency;v = "&#8358;"+numeral(c.text()).format('0,0.00'); c.html(v);
            });
        });$(".size,.volume").each(function(){
            $(this).on("change",function(){
                var v,element, c,price,stp, p, t,prf;c=  $(".single-item-price").children("span");stp= c.text();stp=stp.replace("₦","");element= $(this).find('option:selected');prf=element.attr("pref");p=numeral(stp).value();console.log(p);
                price= element.attr("price");price=numeral(price);(prf=="+")?price=price.add(p):price=price.subtract(p);c.html(price.value());c.formatCurrency;v = "&#8358;"+numeral(c.text()).format('0,0.00'); c.html(v);
            })
        })

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


    });
    function getIp(){
        $.getJSON( "",
            function(data){
                return( data.host);
            }
        );
    }


    function scrollToElement(selector, time, verticalOffset) {
        time = typeof(time) != 'undefined' ? time : 1000;
        verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        element = $(selector);
        offset = element.offset();
        offsetTop = offset.top + verticalOffset;
        $('html, body').animate({
            scrollTop: offsetTop
        }, time);
    }
</script>
</body>
</html>