<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 1/22/15
 * Time: 1:40 PM
 */

?>
<div id="header">
<div class="header-top">
    <div class="container">
        <div class="pull-left auto-width-left">
            <ul class="top-menu menu-beta l-inline">
                <li><a href="<?php echo ASSETS_URL ?>"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-sitemap"></i> Sitemap</a></li>
            </ul>
        </div>
        <div class="pull-right auto-width-right">
            <ul class="top-details menu-beta l-inline">
                @if(Auth::account()->check())
                <li><a href="{{ASSETS_URL}}/account/index"><i class="fa fa-user"></i> Your Account</a></li>
                <li>{{HTML::decode(HTML::linkRoute('logout2','<i class="fa  fa-power-off"></i> Logout'))}}</li>
                @else
                <li> {{HTML::decode(HTML::linkRoute('register','<i class="glyphicon glyphicon-plus"></i> Register'))}} </li>
                <li>{{HTML::decode(HTML::linkRoute('register','<i class="fa  fa-power-on"></i> Login'))}}<!--<a  data-toggle="modal" href="#myModal" >Login</a>--></li>
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

            <div class="beta-comp mcom">
                 <div class="cart">
                     <div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart ({{Cart::count()}})</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>
                         <?php
                         $content = Cart::content();

                         if(count($content) > 0){
$total = Cart::total();

                             $itemHtml ="";

                             if($content){
                                 foreach($content as $itemRow){
                                     $product = Product::find($itemRow->id);
                                     if(public_path()){
                                         $source_folder      = public_path().'/uploads/images/';
                                         $destination_folder = public_path(). '/uploads/images/';
                                     }else{
                                         $source_folder      = '/home/melkaycos/public_html/uploads/images/';
                                         $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                                     }
                                     $image_info = pathinfo($source_folder.$product->image);
                                     $image_extension = strtolower($image_info["extension"]); //image extension
                                     $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                                     $imgName = $image_name_only."-50x50".".".$image_extension;

                                     $itemHtml .= "<div class='cart-item'>
                             <!--<a class='cart-item-edit' pid='".$itemRow->rowid."' href=\"javascript:void(0);\"><i class='fa fa-pencil'></i></a>-->
                             <a class='cart-item-delete' pid='".$itemRow->rowid."' href=\"javascript:void(0);\"><i class='fa fa-times'></i></a>
                             <div class='media'>
                                 <a class='pull-left' href=\"javascript:void(0);\"><img src='".url()."/uploads/images/thumbs/$imgName' alt=''></a>
                                 <div class='media-body'>
                                     <span class='cart-item-title'>".$itemRow->name."</span>
                                     ";
                                     $itemHtml .="<span class='cart-item-options'>";
                                     $itemHtml .=($itemRow->options->has('size') ? " - Size: ".$itemRow->options->size : '');
                                     $itemHtml .=($itemRow->options->has('buying') ? " - Buying Option: ".$itemRow->options->buying : '');
                                     $itemHtml .=($itemRow->options->has('volume') ? " - Volume: ".$itemRow->options->volume : '');


                                     $itemHtml .= "</span>";
                                     $itemHtml .=  "
                                     <span class='cart-item-amount'>$itemRow->qty*<span>&#8358;".number_format($itemRow->price,2,'.',',')."</span>
                                 </div>
                             </div>
                         </div>

                         ";
                                 }


                                 $itemHtml .="<div class='cart-caption'>
                             <div class='cart-total text-right'>Subtotal: <span class='cart-total-value'>&#8358;".number_format($total,2,".",",")."</span></div>
                             <div class='clearfix'></div>

                             <div class='center'>
                                 <div class='space10'>&nbsp;</div>
                                 <a href='".url()."/cart' class='beta-btn primary text-center'>Checkout <i class='fa fa-chevron-right'></i></a>
                             </div>
                             </div>";

                             }else{
                                 $itemHtml .= "Cart is empty";
                             }

                             echo $itemHtml;
                         }else{
                             echo "Your Cart is Empty";
                         }




                         ?>

</div>
                 </div>  <!--.cart -->
            </div>
        </div>
        <div class="clearfix"></div>
    </div> <!-- .container -->
</div> <!-- .header-body -->
<div class="header-bottom">
    <div class="container">
        <a class="visible-xs beta-menu-toggle pull-right" href="javascript:void()"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
        <div class="visible-xs clearfix"></div>
        <nav class="main-menu">
            <ul class="l-inline ov">
            <?php
                if($categories){
                    echo"<li><a href='".ASSETS_URL."'>Home</a></li>";
                    foreach($categories as $category){
                        if($category->parent_id  == 0){
                            echo "<li><a href='".ASSETS_URL."/product/category/$category->id'>$category->title</a>";
                            $subcategories = Category::where("parent_id","=",$category->id)->get();
                            if($subcategories){
                                echo "<ul class='sub-menu'>";
                                foreach($subcategories as $subcat){
                                    echo "<li><a href='".ASSETS_URL."/product/category/$subcat->id'>$subcat->title</a></li>";
                                }
                                echo"</ul>";
                            }

                            echo" </li>";
                        }
                    }
                }
            ?>
            </ul>
        </nav>
    </div> <!-- .container -->
</div> <!-- .header-bottom -->
</div><!-- #header -->