<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 1/16/15
 * Time: 9:43 AM
 */
?>
<?php

//initilize the page

require_once("inc/init.php");

require_once("inc/config.ui.php");


$page_css[] = "your_style.css";
?>
<!DOCTYPE html>
<html>
<head>
    @include('includes.head2')
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/jquery.simple-dtpicker.css" type="text/css" />
    <script src="<?php echo ASSETS_URL; ?>/js/jquery.simple-dtpicker.js"></script>
    <!--<script type="text/javascript" src="<?php /*echo ASSETS_URL; */?>/js/plugin/datepicker/js/eye.js"></script>
        <script type="text/javascript" src="<?php /*echo ASSETS_URL; */?>/js/plugin/datepicker/js/utils.js"></script>-->
</head>
<body>
@include('includes.header2')



<div class="row">
    <div class="row">&nbsp;</div>

    <div class="col-md-12 col-lg-12 col ">
<h2>Clients Satisfaction Survey</h2>
<article class="col-sm-12 col-md-12 col-lg-12 ">
Dear Customer,

<p>Thank you for choosing Stanbic IBTC Stockbrokers Limited as your preferred Stockbroking firm. To help us serve you better, kindly take a few minutes to share with us your experience on the service we render. We appreciate your business and want to constantly make sure we meet and surpass your expectations.</p>

<h4>INSTRUCTIONS:</h4>
<ul>
    <li>Using a scale of 1 to 10 (with 1 being the lowest and 10 being the highest)</li>
    <li>Using "par" (with significantly below par the lowest and significantly above par being the highest).</li>
</ul>

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">

						<header role="heading">

							<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
							<h2>CLIENTS SATISFATION SURVEY</h2>

						<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                        </header>

						<!-- widget div-->
						<div role="content">

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding">

								<form id="checkout-form" class="smart-form" novalidate="novalidate">

									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="input"> <i class="icon-prepend fa fa-user"></i>
													<input type="text" name="name" placeholder="name">
												</label>
											</section>
											<section class="col col-6">
												<label class="input"> <i class="icon-prepend fa fa-user"></i>
													<input type="text" name="accno" placeholder="Account Number">
												</label>
											</section>
										</div>

										<div class="row">

											<section class="col col-6">
												<label class="input"> <i class="icon-prepend fa fa-phone"></i>
													<input type="tel" name="phone" placeholder="Phone" data-mask="(999) 999-9999">
												</label>
											</section>
                                            <section class="col col-6">
                                                <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                    <input type="email" name="email" placeholder="email" >
                                                </label>
                                            </section>
										</div>
									</fieldset>

									<fieldset>
										<div class="row">
                                            <section class="col col-1">Q1</section>
                                            <section class="col col-6">
                                                <p>How long have you been trading through SISL? (Please include period with
                                                legacy IBTC Asset Management or Stanbic Equities Limited</p>
                                                <input type="hidden" name="input1" value="How long have you been trading through SISL? (Please include period with
                                                legacy IBTC Asset Management or Stanbic Equities Limited">

                                            </section>
                                            <section class="col col-5">
                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" name="radio1" checked="">
                                                        <i></i>0-5 YEARS</label>
                                                    <label class="radio">
                                                        <input type="radio" name="radio1">
                                                        <i></i>6-10 YEARS</label>
                                                    <label class="radio">
                                                        <input type="radio" name="radio1">
                                                        <i></i>10 YEAR AND ABOVE</label>
                                                </div>

                                            </section>
										</div>
                                        <hr>
                                        <div class="row">
                                            <section class="col col-1">Q2</section>
                                            <section class="col col-6">
                                                How would you rate our Staff in terms of the following:
                                                <input type="hidden" id="input2" name="input2" value="How would you rate our Staff in terms of the following:">
                                            </section>
                                        </div>

                                        <div class="row">
                                            <section class="col col-4">
                                                <ol style="margin-left: 20px">
                                                    <li>Courtesy <input type="hidden" value="Courtesy" name="input2_1" > </li>
                                                    <li>Friendliness<input type="hidden" value="Friendliness" name="input2_2" ></li>
                                                    <li>Competence<input type="hidden" value="Competence" name="input2_3" ></li>
                                                    <li>Professionalism<input type="hidden" value="Professionalism" name="input2_4" ></li>

                                                </ol>

                                            </section>
                                            <section class="col col-8">
                                                <ul class="no-bullet" style="list-style: none; margin: 0; padding: 0" >
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_1">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_2">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_3">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio2_4">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                </ul>


                                            </section>
                                        </div>
<hr>
                                        <div class="row">
                                            <section class="col col-1">Q3</section>
                                            <section class="col col-3">
                                                <p>How would you rate us in terms of accessibility?</p>
                                                <input type="hidden" name="input3" value="How would you rate us in terms of accessibility?">
                                            </section>
                                            <section class="col col-8">
                                                <div class="inline-group">
                                                    <div class="inline-group">
                                                        <label class="radio">
                                                            <input type="radio" name="radio3" >
                                                            <i></i>1</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>2</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>3</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3" >
                                                            <i></i>4</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>5</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>6</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3" >
                                                            <i></i>7</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>8</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>9</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio3">
                                                            <i></i>10</label>
                                                    </div>
                                                </div>

                                            </section>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <section class="col col-1">Q4</section>
                                            <section class="col col-11">
                                                <p>How would you rate the following updates and reports received from us</p>
                                                <input name="input4" type="hidden" value="How would you rate the following updates and reports received from us">
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <ol style="margin-left: 20px">
                                                    <li>Market Update <input type="hidden" name="input4_1" value="Market Update"></li>
                                                    <li>Research Reports <input type="hidden" name="input4_2" value="Research Reports"></li>

                                                </ol>
                                            </section>
                                            <section class="col col-8">
                                                <ul style="margin: 0; padding: 0; list-style: none">
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_1">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio4_2">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </section>
                                        </div>
<hr>
                                        <div class="row">
                                            <section class="col col-1">Q5</section>
                                            <section class="col col-5">
                                                <p>Have you ever had any cause to complain about our service or processes? If no, please proceed to  7</p>
                                                <input type="hidden" name="input5" value="Have you ever had any cause to complain about our service or processes? If no, please proceed to  7">
                                            </section>
                                            <section class="col col-6">
                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" name="radio5" checked="">
                                                        <i></i>Yes</label>
                                                    <label class="radio">
                                                        <input type="radio" name="radio5">
                                                        <i></i>No</label>

                                                </div>

                                            </section>
                                        </div>
<hr>
                                    <div class="row">
                                        <section class="col col-1">Q6</section>
                                        <section class="col col-11">
                                            <p>Please rate the quality of our complaints management based on the following?</p>
                                            <input type="hidden" name="input6" value="Please rate the quality of our complaints management based on the following?">
                                        </section>
                                    </div>

                                        <div class="row">
                                            <section class="col col-4">
                                                <ol style="margin-left: 20px">
                                                    <li>Speed of Resolution <input type="hidden" name="input6_1" value="Speed of Resolution"></li>
                                                    <li>Quality of Feedback <input type="hidden" name="input6_2" value="Quality of Feedback"></li>
                                                    <li>Level of Satisfaction <input type="hidden" name="input6_3" value="Level of Satisfaction"></li>
                                                    <li>Online Platform <input type="hidden" name="input6_4" value="Online Platform"></li>
                                                </ol>

                                            </section>
                                            <section class="col col-8">
                                                <ul class="no-bullet" style="list-style: none; margin: 0; padding: 0" >
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_1">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_2">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_3">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4" >
                                                                <i></i>1</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>2</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>3</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4" >
                                                                <i></i>4</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>5</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>6</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4" >
                                                                <i></i>7</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>8</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>9</label>
                                                            <label class="radio">
                                                                <input type="radio" name="radio6_4">
                                                                <i></i>10</label>
                                                        </div>
                                                    </li>
                                                </ul>


                                            </section>
                                        </div>

<hr>
                                        <div class="row">
                                            <section class="col col-1">Q7</section>
                                            <section class="col col-5">
                                                <p>Do you execute trades through other stockbroking firm? If no, please proceed to question 9</p>
                                                <input type="hidden" name="input7" value="Do you execute trades through other stockbroking firm? If no, please proceed to question 9">
                                            </section>
                                            <section class="col col-6">
                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" name="radio7" checked="">
                                                        <i></i>Yes</label>
                                                    <label class="radio">
                                                        <input type="radio" name="radio7">
                                                        <i></i>No</label>

                                                </div>

                                            </section>
                                        </div>
<hr>

                                        <div class="row">
                                            <section class="col col-1">Q8</section>
                                            <section class="col col-3">
                                                <p>Do we supply you with sufficient block flows/trade volumes?</p>
                                                <input type="hidden" name="input8" value="Do we supply you with sufficient block flows/trade volumes?">
                                            </section>
                                            <section class="col col-8">
                                                <div class="inline-group">
                                                    <div class="inline-group">
                                                        <label class="radio">
                                                            <input type="radio" name="radio8" >
                                                            <i></i>1</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>2</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>3</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8" >
                                                            <i></i>4</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>5</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>6</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8" >
                                                            <i></i>7</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>8</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>9</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio8">
                                                            <i></i>10</label>
                                                    </div>
                                                </div>

                                            </section>
                                        </div>
<hr>
                                        <div class="row">
                                            <section class="col col-1">Q9</section>
                                            <section class="col col-3">
                                                <p>When compared with other Stockbroking Firms, how will you rate our services?</p>
                                                <input type="hidden" name="input9" value="When compared with other Stockbroking Firms, how will you rate our services?">
                                            </section>
                                            <section class="col col-8">
                                                <div class="inline-group">
                                                    <div class="inline-group">
                                                        <label class="radio">
                                                            <input type="radio" name="radio9" >
                                                            <i></i>Sufficiently Above PAR</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio9">
                                                            <i></i>Sufficiently Below PAR</label>

                                                    </div>
                                                </div>

                                            </section>
                                        </div>
<hr>
                                        <div class="row">
                                            <section class="col col-1">Q10</section>
                                            <section class="col col-3">
                                                <p>What is your overall assessment of our services? Please tick as appropriate?</p>
                                                <input type="hidden" name="input10" value="What is your overall assessment of our services? Please tick as appropriate?">
                                            </section>
                                            <section class="col col-8">
                                                <div class="inline-group">
                                                    <div class="inline-group">
                                                        <label class="radio">
                                                            <input type="radio" name="radio10" >
                                                            <i></i>Sufficiently Above PAR</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio10">
                                                            <i></i>Sufficiently Below PAR</label>

                                                    </div>
                                                </div>

                                            </section>
                                        </div>
<hr>
                                        <div class="row">
                                            <section class="col col-1">Q11</section>
                                            <section class="col col-3">
                                                <p>Based on your experience with us, would you recommend us to other investors/International brokers</p>
                                                <input type="hidden" name="input11" value="Based on your experience with us, would you recommend us to other investors/International brokers">
                                            </section>
                                            <section class="col col-8">
                                                <div class="inline-group">
                                                    <div class="inline-group">
                                                        <label class="radio">
                                                            <input type="radio" name="radio11" >
                                                            <i></i>1</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>2</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>3</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11" >
                                                            <i></i>4</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>5</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>6</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11" >
                                                            <i></i>7</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>8</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>9</label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio11">
                                                            <i></i>10</label>
                                                    </div>
                                                </div>

                                            </section>
                                        </div>
<hr>
                                    <div class="row">
                                        <section class="col col-1">Q12</section>
                                        <section >
                                            <p>What other value added service(s) or significant improvement would you like to receive from us?</p>
                                            <input type="hidden" name="inputcomment" value="What other value added service(s) or significant improvement would you like to receive from us?">
                                        </section>
                                    </div>

                                            <section >
                                                <label class="textarea">
                                                    <i class="icon-append fa fa-comment"></i>
                                                <textarea rows="4" name="comment"  ></textarea>
                                                    </label>
                                            </section>


                                    </fieldset>



									<footer>
										<button type="submit" class="btn btn-primary">
Submit Survey
</button>
									</footer>
								</form>

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->


</article>

    </div>
    <!--<div class="col-md-3 col-lg-3 col ">

        <div role="content">
            <div class="jarviswidjet ">
                <p><img src="<?php /*echo ASSETS_URL; */?>/img/stanbicibtc_stockbrokers.png"> </p>
            </div>
        </div>
    </div>-->
</div>