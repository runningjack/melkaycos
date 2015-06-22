<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/3/15
 * Time: 11:26 PM
 */
?>
<?php
require_once("inc/init.php");
require_once("inc/config.ui.php");

?>
<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
</head>
<body id="page-top">
@include('includes.header2')
@yield('content')
@include('includes.footer')
<script src="<?php echo ASSETS_URL ?>/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/waypoints.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/wow.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/animo/Animo.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/dug/dug.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/scripts.min.js"></script>

<script type="text/javascript">
    function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

    $(document).ready(function(){

        $("#create_account").on("click",function(){
            if($(this).prop('checked')){
                $("#caccount").css("display","block")

            }else{
                $("#caccount").css("display","none")
            }
        })

        $("#ship_billing").on("click",function(){
            if($(this).prop('checked')){
                $("#diffshipping").css("display","none")

            }else{
                $("#diffshipping").css("display","block")
            }
        })
    });
</script>