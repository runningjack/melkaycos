<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/30/15
 * Time: 1:04 PM
 */
?>

<div class="widget">
    <?php
    if($category && $subcategories){

    echo "<h3 class='widget-title'>Sub Categories</h3>
    <div class='widget-body'>
        <ul class='list-unstyled'>";

                $x=1;
                foreach($subcategories as $category){
                    echo "<li>
                <a href='".ASSETS_URL."/product/category/$category->id'>$category->title</a>

            </li>";
                    $x++;
                }

        echo"</ul>
    </div>";
    }else{
        echo "<h3 class='widget-title'>All Categories</h3>
    <div class='widget-body'>
        <ul class='list-unstyled'>";

        $x=1;
        foreach($categories as $category){
            echo "<li>
                <a href='".ASSETS_URL."/product/category/$category->id'>$category->title</a>

            </li>";
            $x++;
        }

        echo"</ul>
    </div>";
    }
    ?>
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
</div> <!-- price range widget
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