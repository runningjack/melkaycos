<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 2/25/15
 * Time: 6:32 PM
 */
?>

<?php
require_once("inc/init.php");
?>

@extends("layouts.inner")
@section("content")
<section style="background-color: #c2c2c2; padding-bottom: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-heading" ><i class="fa  fa-calendar fa-2x" style="color: #fec503"></i> <span style="padding-bottom: 20px">{{$parent->title}}</span></h2>
                <h3 class="section-subheading text-muted">{{ $parent->p_content }}</h3>
            </div>
        </div>
    </div>
</section>
<section class="bg-light-gray" style="padding-top:20px ">

<div class="container" style="background-color: #fff">

<div class="row">
    <div class="col-lg-9">
            @if (isset($parent))


            <?php $v=1 ?>
            @foreach($events as $event)
        <div class="row">
            <div class="col-lg-12 col">
                <div id="post-{{$event->id}}" class="post-{{$event->id}} post clearfix">

                    <div class="photo">
                        <a href="#"><img style="max-width: 840px;"  src="http://themes.muffingroup.com/limuso/wp-content/uploads/2012/04/blog_21.jpg" class="scale-with-grid wp-post-image" alt="blog_2"></a>
                        <div class="date">
                            <span class="day">{{date_format(date_create($event->start_date),'d')}}</span>
                            <span class="month">{{date_format(date_create($event->start_date),'M Y')}}</span>
                            <span class="arrow"></span>
                        </div>
                    </div>

                    <div class="r_meta">
                        <div class="date"><i class="icon-calendar"></i>{{date_format(date_create($event->start_date),' M d, Y')}}</div>

                    </div>

                    <div class="desc">

                        <div class="l col-lg-9 no-padding" style="padding-left: 0; border-right: 1px solid #222">
                            <h3><a href="#">{{$event->title}}</a></h3>
                            <h5 style="text-transform:none">{{$event->description}}</h5>
                            <p>

                                <?php
            if($event->description !=""){
                $cat =($event->description);
                // echo $cat;
                $higlights = explode(" ",$event->description);
                $highligt_stream = "";
                $z=1;
                foreach($higlights as $higlight){
                    $highligt_stream .= $higlight." ";
                    $z++;

                    if($z == 25){
                        goto a;
                    }
                }
            }

                                a:100;
                                ?>


                                {{$highligt_stream}} […]</p>
                            <a href="{{ASSETS_URL}}/posts/{{$event->permalink}}" class="btn btn-primary button">Read more</a>		</div>

                        <div class="meta col-lg-2">

                            <div class="comments"><i class="fa fa-comment"></i>
                                Comments:
                                <a href="#">0</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>





            {{--*/$v++/*--}}




        <div style="padding-bottom:10px">&nbsp;</div>
        @endforeach
    </div>
    <div class="col-lg-3">
        <aside ><h3>Recent Tweets</h3>
            <a class="twitter-timeline" href="https://twitter.com/big_Tyme_lbr" data-widget-id="331178974505996288">Tweets by @big_Tyme_lbr</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </aside>
    </div>
    </div>

 </div>

            @else
            <h2>Welcome</h2>

            <p>The CMS public section can now be viewed at {{ HTML::link(url('/'), url('/')) }}</p>

            <p>The CMS admin can now be viewed at {{ HTML::link(url('admin'), url('admin')) }}</p>

            <p>The CMS backend can now be viewed at {{ HTML::link(url('backend'), url('backend')) }}</p>
            @endif


</section>

@stop