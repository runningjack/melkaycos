<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 2/24/15
 * Time: 6:22 AM
 */
?>
<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href="<?php echo ASSETS_URL ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="javascript:void()"><i class="fa fa-sitemap"></i> Sitemap</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::account()->check())
                    <li><a href="{{ASSETS_URL}}/account/index"><i class="fa fa-user"></i> Your Account</a></li>
                    @else
                    <li> {{HTML::decode(HTML::linkRoute('register','<i class="glyphicon glyphicon-plus"></i> Register'))}} </li>
                    <li><a  data-toggle="modal" href="#myModal" >Login</a></li>
                    @endif

                    <!--<li class="hidden-xs">
                        <select name="currency">
                            <option value="usd">USD</option>
                            <option value="eur">EUR</option>
                            <option value="ron">RON</option>
                        </select>
                    </li>-->
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="<?php echo ASSETS_URL ?>" id="logo"><img src="<?php echo ASSETS_URL ?>/img/logo.png" alt=""></a>
                <span class="slogan">Unending Products range ...</span>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{ASSETS_URL}}/catalog">
                        <input type="text" value="" name="s" id="s" placeholder="Search entire store here..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">

                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="javascript:void(0)"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <?php
                    if($categories){
                        echo"<li><a href='".ASSETS_URL."'>Home</a>";
                        foreach($categories as $category){
                            if($category->parent_id  == 0){
                                echo "<li><a href='".ASSETS_URL."/product/category/$category->id'>$category->title</a><ul class='sub-menu'>";
                                $subcategories = Category::where("parent_id","=",$category->id)->get();
                                if($subcategories){
                                    foreach($subcategories as $subcat){
                                        echo "<li><a href='".ASSETS_URL."/product/category/$subcat->id'>$subcat->title</a></li>";
                                    }
                                }
                                echo"</ul>
                             </li>";
                            }
                        }
                    }
                    ?>
                </ul>

                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->