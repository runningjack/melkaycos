<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 2/25/15
 * Time: 6:19 AM
 */
?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; tyme2015</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms of Use</a>
                    </li>
                </ul><!---->
            </div>
        </div>
    </div>
</footer>
<!-- jQuery
<script src="<?php echo ASSETS_URL ?>/js/jquery.js"></script>-->
<link href="<?php echo ASSETS_URL ?>/js/plugin/jPlayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/jPlayer/lib/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/jPlayer/dist/jplayer/jquery.jplayer.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo ASSETS_URL ?>/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo ASSETS_URL ?>/js/jquery.easing.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/classie.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/cbpAnimatedHeader.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/lightGallery.min.js"></script>
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/lightGallery.css" type="text/css"/>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?php echo ASSETS_URL ?>/js/plugin/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>



<!-- Contact Form JavaScript
<script src="<?php echo ASSETS_URL ?>/js/jqBootstrapValidation.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/contact_me.js"></script>-->

<!-- Custom Theme JavaScript -->
<script src="<?php echo ASSETS_URL ?>/js/agency.js"></script>

<script>
    $(document).ready(function(){
        $('.gallery li a').fancybox();
    })
</script>