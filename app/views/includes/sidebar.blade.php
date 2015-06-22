<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/20/15
 * Time: 6:12 AM
 */
?>
<div class="widget">
    <h3 class="widget-title">Categories</h3>
    <div class="widget-body">

        <ul class="list-unstyled">

            <?php
            if($categories){
                $x=1;
                foreach($categories as $brand){
                    echo "<li>
                <input type='checkbox' name='category' id='category-abs$x' value='$brand->title'>
                <label for='category-abs$x'><span></span> $brand->title</label>
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
                <input type='checkbox' name='brands' id='brands-abs$x' value='$brand->title'>
                <label for='brands-abs$x'><span></span> $brand->title</label>
            </li>";
                    $x++;
                }
            }
            ?>
        </ul>
    </div>
</div> <!-- brands widget -->



<div class="widget">
    <h3 class="widget-title">Price Range</h3>
    <div class="widget-body">
        <div class="price-filter">
            <div id="price-filter-range"></div>
            <span class="pull-left">Price: <span id="price-filter-amount"></span></span>
            <a href="#" class="beta-btn primary pull-right">Filter <i class="fa fa-chevron-right"></i></a>
            <div class="clearfix"></div>
        </div>
    </div>
</div> <!-- price range widget -->

<!--<div class="widget">
    <h3 class="widget-title">Best Sellers</h3>
    <div class="widget-body">
        <div class="beta-sales beta-lists">
            <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
                <div class="media-body">
                    Sample Woman Top
                    <span class="beta-sales-price">$34.55</span>
                </div>
            </div>
            <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/2.png" alt=""></a>
                <div class="media-body">
                    Sample Woman Top
                    <span class="beta-sales-price">$34.55</span>
                </div>
            </div>
            <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
                <div class="media-body">
                    Sample Woman Top
                    <span class="beta-sales-price">$34.55</span>
                </div>
            </div>
            <div class="media beta-sales-item">
                <a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/4.png" alt=""></a>
                <div class="media-body">
                    Sample Woman Top
                    <span class="beta-sales-price">$34.55</span>
                </div>
            </div>
        </div>
    </div>
</div>--> <!-- best sellers widget -->
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