<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 1/22/15
 * Time: 1:46 PM
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
        <meta name="_token" content="{{ csrf_token() }}"/>
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
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-9 main-content pull-right">
                @include('includes.slider')
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
<script src="<?php echo ASSETS_URL ?>/js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/plugin/jquery-form/jquery-form.min.js"></script>



<!--customjs-->
<script type="text/javascript">


    var tpj=jQuery;
    tpj.noConflict();

    tpj(document).ready(function() {

        if (tpj.fn.cssOriginal!=undefined)
            tpj.fn.css = tpj.fn.cssOriginal;

        tpj('.banner').revolution(
            {
                delay:9000,
                startheight:700,
                startwidth:1200,
                hideThumbs:200,
                thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                thumbHeight:50,
                thumbAmount:5,
                navigationType:"bullet",				// bullet, thumb, none
                navigationArrows:"nexttobullets",				// nexttobullets, solo (old name verticalcentered), none
                navigationStyle:"navbar",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
                navigationHAlign:"center",				// Vertical Align top,center,bottom
                navigationVAlign:"bottom",					// Horizontal Align left,center,right
                navigationHOffset:0,
                navigationVOffset:20,
                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"center",
                soloArrowLeftHOffset:20,
                soloArrowLeftVOffset:0,
                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:20,
                soloArrowRightVOffset:0,
                touchenabled:"on",						// Enable Swipe Function : on/off
                onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

                stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

                hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
                hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value

                shadow:1,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                fullWidth:"off"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus


            });



    });

</script>
<script>
    //color
    var target =""
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
                    //$(".cart-body").html(data);
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
            $(this).on("click",function(){
                //target.loadingOverlay();
                //ShowProgressAnimation();
                $(".modal-body").html("<img src='<?php echo  ASSETS_URL ?>/img/loading.gif'><br>ADDING ITEM(S) TO CART")
                var buying =""
                var volume =""
                var size =""
                var weight =""
                var optid = ""

                if($(this).siblings('select[name="buying"]').length > 0){
                    buying = ($(this).siblings('select[name="buying"]').val())
                    optid = $(this).siblings('select[name="buying"]').attr("optid")

                }
                if($(this).siblings('select[name="volume"]').length > 0){
                    volume = ($(this).siblings('select[name="volume"]').val())
                    optid = $(this).siblings('select[name="volume"]').attr("optid")
                }
                if($(this).siblings('select[name="size"]').length > 0){
                    size = ($(this).siblings('select[name="size"]').val())
                    optid = $(this).siblings('select[name="size"]').attr("optid")
                }
                $(".modal").modal("show")
                var request = $.ajax({
                    url:"",
                    type:"post",
                    data:{pid:$(this).attr("pid"),currency:"",buying:buying,volume:volume,size:size,weight:weight,optid:optid},
                    dataType:"html"
                });
                request.done(function(data){
                   $(".cart").html(data);
                  // target.loadingOverlay('remove');
                    jQuery(".cart .beta-select").on("click",function(){
                        return jQuery(".cart-body").slideToggle(),!1
                    });
                    var a=jQuery(".cart");jQuery(document).mouseup(function(b){a.is(b.target)||0!==a.has(b.target).length||jQuery(".cart-body").slideUp()})
                    //e.stopImmediatePropagation()
                    $(".modal-body").html("<img src='<?php echo  ASSETS_URL ?>/img/checked.gif'><br><span style='color:green'>ITEM SUCCESSFULLY ADDED TO CART</span>")
                    setTimeout(function(){
                        $(".modal").modal("hide");
                    }, 3000);

                })
                request.fail(function(){
                    alert("Request failed: ")
                })
                return false
            })
        })

        var $contactForm = $("#login_form").validate({
            // Rules for form validation
            rules : {
                password : {
                    required : true
                },
                email : {
                    required : true,
                    email : true
                }
            },

            // Messages for form validation
            messages : {
                password : {
                    required : 'Please enter your password'
                },
                email : {
                    required : 'Please enter your email address',
                    email : 'Please enter a VALID email address'
                }
            },

            // Ajax form submition
            submitHandler : function(form) {
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
                $(form).ajaxSubmit({
                    success : function(data) {

                        $("#login_form").addClass('submited');
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());

            }
        });

    });

</script>


<script>
    jQuery(document).ready(function($) {
        'use strict';
        try {
            if ($(".animated")[0]) {
                $('.animated').css('opacity', '0');
            }
            $('.triggerAnimation').waypoint(function() {
                    var animation = $(this).attr('data-animate');
                    $(this).css('opacity', '');
                    $(this).addClass("animated " + animation);

                },
                {
                    offset: '80%',
                    triggerOnce: true
                }
            );
        } catch(err) {

        }

        var wow = new WOW(
            {
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       150,          // distance to the element when triggering the animation (default is 0)
                mobile:       false        // trigger animations on mobile devices (true is default)
            }
        );
        wow.init();



        $(function() {
            // this will get the full URL at the address bar
            var url = window.location.href;

            // passes on every "a" tag
            $(".main-menu a").each(function() {
                // checks if its the same on the address bar
                if (url == (this.href)) {
                    $(this).closest("li").addClass("active");
                    $(this).parents('li').addClass('parent-active');
                }
            });
        });
    });

</script>
</body>
</html>