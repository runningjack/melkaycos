<?php
require_once("inc/init.php");
?>

@extends("layouts.nosidebar")
@section("content")
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{$title}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{ASSETS_URL}}">Home</a> / <span>Contact Us</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content" class="space-top-none">

        <div class="space50">&nbsp;</div>
        <div class="row">
            <div class="col-sm-8">
                <h2>Contact Form</h2>
                <div class="space20">&nbsp;</div>
                <p>Send us an email.</p>
                <div class="space20">&nbsp;</div>
                <form action="contact-form-handler.php" method="post" class="contact-form">
                    <div class="form-block">
                        <input name="name" type="text" placeholder="Your Name (required)">
                    </div>
                    <div class="form-block">
                        <input name="email" type="email" placeholder="Your Email (required)">
                    </div>
                    <div class="form-block">
                        <input name="subject" type="text" placeholder="Subject">
                    </div>
                    <div class="form-block">
                        <textarea name="message" placeholder="Your Message"></textarea>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <h2>Contact Information</h2>
                <div class="space20">&nbsp;</div>

                <h6 class="contact-title">Address</h6>
                <p>
                    62 Ologunkutere Street,<br>
                    Parkview Lagos, <br>
                    Nigeria
                </p>
                <div class="space20">&nbsp;</div>
                <h6 class="contact-title">Business Enquiries</h6>
                <p>
                    For Business enquiries, partnership and more
                    . <br>
                    <a href="mailto:biz@melkaycosmetics.com">biz@melkaycosmetics.com</a>
                </p>
                <div class="space20">&nbsp;</div>
                <h6 class="contact-title">Employment</h6>
                <p>
                    We’re always looking for talented persons to <br>
                    join our team. <br>
                    <a href="hr@melkaycosmetics.com">hr@melkaycosmetics.com</a>
                </p>
            </div>
        </div>
    </div> <!-- #content -->
</div>
@stop

<!-- PAGE RELATED PLUGIN(S) -->


