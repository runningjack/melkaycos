<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/29/14
 * Time: 4:10 PM
 */


//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");

?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
    <header id="header">
        <!--<span id="logo"></span>-->

        <div id="logo-group">
            <span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo_hr.png" alt="Melkay Cosmetics"> </span>

            <!-- END AJAX-DROPDOWN -->
        </div>

    </header>

    <div id="main" role="main">

        <!-- MAIN CONTENT -->
        <div id="content" class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">


                    <div class="">

                        <div class="pull-left login-desc-box-l">
                            <!--<h4 class="paragraph-header">It's Okay to be Smart. Experience the simplicity of SmartAdmin, everywhere you go!</h4>
                            <div class="login-app-icons">
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>
                            </div>-->
                        </div>


                        <img src="" class="pull-right display-image" alt="" style="width:210px">


                    </div>


                    <div class="row">

                        <!-- <img src="<?php /*echo ASSETS_URL; */?>/img/demo/iphoneview.png" >-->
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="well no-padding">
                        {{ Form::open(array('action'=>array('AuthController@postLogin'), 'method'=>'POST', 'class'=>'form-horizontal')) }}

                            <header>
                                Sign In
                            </header>

                            <fieldset>

                                <section>
                                    <label class="label">E-mail</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="email" name="email">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                                </section>

                                <section>
                                    <label class="label">Password</label>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                    <div class="note">
                                        <a href="#">Forgot password?</a>
                                    </div>
                                </section>

                                <section>
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" >
                                        <i></i>Stay signed in</label>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Sign in
                                </button>
                            </footer>
                        </form>

                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
//include required scripts
include("inc/scripts.php");
?>

    <!-- PAGE RELATED PLUGIN(S)
    <script src="..."></script>-->

    <script type="text/javascript">
        runAllForms();

        $(function() {
            // Validation
            $("#login-form").validate({
                // Rules for form validation
                rules : {
                    email : {
                        required : true,
                        email : true
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 20
                    }
                },

                // Messages for form validation
                messages : {
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    password : {
                        required : 'Please enter your password'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
        });
    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>