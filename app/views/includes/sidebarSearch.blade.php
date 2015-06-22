<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/29/15
 * Time: 5:28 PM
 */
?>
<div class="widget">
    <h3 class="widget-title">Categories</h3>
    <div class="widget-body">
        <ul class="list-unstyled">
            <?php
            if($categories){
                $x=1;
                foreach($categories as $category){
                    echo "<li>
                <a href='".ASSETS_URL."/product/category/$category->id?s=$qstring'>$category->title</a>

            </li>";
                    $x++;
                }
            }
            ?>
        </ul>
    </div>
</div> <!-- colors widget -->
<div class="widget">
    <h3 class="widget-title">Brands</h3>
    <div class="widget-body">
        <ul class="list-unstyled">
            <?php
            if($brands){
                $x=1;
                foreach($brands as $brand){
                    echo "<li>
                <a href='".ASSETS_URL."/product/brands/$brand->title?s=$qstring'>$brand->title</a>

            </li>";
                    $x++;
                }
            }
            ?>
        </ul>
    </div>
</div> <!-- brands widget -->
<!-- twitter feeds widget
<div class="widget">
    <h3 class="widget-title">Twitter Feeds</h3>
    <div class="widget-body">
        <div class="twitter-feed beta-lists">
            <div class="tweet">
                <i class="fa fa-twitter"></i>
                <div class="tweet-body">
                    <p><a href="#">@ShopaHolic</a> Proin feugiat mattis ante sed adipiscing velit sodales.</p>
                    <small class="tweet-time">25 Minutes ago</small>
                </div>
            </div>
            <div class="tweet">
                <i class="fa fa-twitter"></i>
                <div class="tweet-body">
                    <p>Proin feugiat mattis ante sed adipiscing velit sodales. <a href="#">http://shopaholic.com</a></p>
                    <small class="tweet-time">25 Minutes ago</small>
                </div>
            </div>
        </div>
    </div>-->
</div> <!-- twitter feeds widget -->