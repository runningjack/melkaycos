<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 4/29/15
 * Time: 1:56 PM
 */
require_once ('inc/init.php');
?>
<?php
if(Auth::account()->check()){
    $user = Auth::account()->get();
}

?>
@extends('layouts.nocart')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Checkout</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{ASSETS_URL}}">Home</a> / <span>Checkout</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="pull-left">
            <p class="beta-checkout-help">Need help? Call customer services on 08033142237.</p>
        </div>
        <div class="pull-right menu-underline">
            <a  href="mailto:info@melkaycosmetics.com">Email customer care</a>
            <a href="<?php echo url()."pages/terms-and-conditions" ?>">Shipping information</a>
            <a href="<?php echo url()."pages/terms-and-conditions" ?>">Returns &amp; exchange</a>
            <a href="#">F.A.Q.'s</a>
        </div>
        <div class="clearfix"></div>
        <div class="space20">&nbsp;</div>

        <!--<div class="beta-message">
            <i class="fa fa-ticket pull-left"></i>
            <span class="pull-left beta-message-text">Have a coupon? Click here to enter your code</span>
            <div class="clearfix"></div>
        </div>-->
        <div class="space30">&nbsp;</div>
        @if(!$user)
        <p class="beta-checkout-help">Returning customer? Login here</p>
        <div class="space50">&nbsp;</div>
        @endif

        {{ Form::open(array('action'=>array('HomeController@postCheckout'), 'method'=>'POST',"id"=>"frm", 'class'=>'beta-form-checkout', 'files'=>true)) }}
        <div class="row">
            <div class="col-12">
                @if(Session::has('error_message'))
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
                </div>
                @endif
                @if(Session::has('success_message'))
                <div class="alert alert-success fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-check"></i>{{Session::get('success_message')}}
                </div>
                @endif
                @if ( ! empty( $errors ) )
                @foreach ( $errors->all() as $error )
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-times"></i>{{$error}}
                </div>
                @endforeach
                @endif
            </div>
        </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Billing Address</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="country">Country*</label>
                        <select name="country" id="country">
                            <option value="">Select a country…</option>

                            @if($countries)
                            @foreach($countries as $country)
                                @if($country->name == "Nigeria")
                                    <option value="{{$country->name}}" selected>{{$country->name}}</option>
                                @else
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                @endif
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-block">
                        <label for="firstname">First name*</label>
                        <input type="text" id="firstname" name="firstname" required placeholder="first name" value="<?php
                        if($user){
                            echo $user->firstname;
                        }else{
                            Input::old("firstname");
                        }
                        ?> ">
                    </div>

                    <div class="form-block">
                        <label for="your_last_name">Last name*</label>
                        <input type="text" id="lastname" name="lastname" required placeholder="last name" value="<?php
                        if($user){
                            echo $user->lastname;
                        }else{
                            Input::old("lastname");
                        }
                        ?> ">
                    </div>

                    <div class="form-block">
                        <label for="company">Company name</label>
                        <input type="text" id="company" name="company" placeholder="company"
                               value="<?php
                               if($user){
                                   echo $user->company;
                               }else{
                                   Input::old("company");
                               }
                               ?> "
                            >
                    </div>

                    <div class="form-block">
                        <label for="address">Address*</label>
                        <input type="text" id="address" name="address" placeholder="Street Address" required value="<?php
                        if($user){
                            echo $user->address;
                        }else{
                            Input::old("address");
                        }
                        ?> ">
                        <input type="text" id="apartment" name="apartment" placeholder="Apartment, suite, unit etc." required value="<?php
                        if($user){
                            echo $user->apartment;
                        }else{
                            Input::old("apartment");
                        }
                        ?> ">
                    </div>

                    <div class="form-block">
                        <label for="city">Town / City*</label>
                        <input type="text" id="city" name="city" required placeholder="Town / City*" value="<?php
                        if($user){
                            echo $user->city;
                        }else{
                            Input::old("city");
                        }
                        ?> ">
                    </div>

                    <div class="form-block">
                        <label for="state">State/Region</label>
                        <input type="text" id="state" name="state" placeholder ="State / Region" value="<?php
                        if($user){
                            echo $user->state;
                        }else{
                            Input::old("state");
                        }
                        ?> ">
                    </div>

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" required placeholder="email" value="<?php
                        if($user){
                            echo $user->email;
                        }else{
                            Input::old("email");
                        }
                        ?> ">
                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone" name="phone" placeholder="phone" required value="<?php
                        if($user){
                            echo $user->phone;
                        }else{
                            Input::old("phone");
                        }
                        ?> ">
                    </div>

                    <div class="space20">&nbsp;</div>
                    @if(!$user)
                    <p>
                        <input type="checkbox" name="create_account" id="create_account">
                        <label for="create_account"><span></span> Create an account?</label>


                    </p>

                    <div id="caccount" style="display:none">
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="username" >User Name:</label>
                            <input type="text" name="username" id="username"  value="{{Input::old('username')}}">
                        </div>

                        <div class="form-block">
                            <label for="password" >Password:</label>
                            <input type="password"  name="password" id="password" >
                        </div>

                        <div class="form-block">
                            <label for="confirmpassword" >Confirm Password:</label>
                            <input type="password" name="confirmpassword"  id="confirmpassword" >
                        </div>
                    </div>
                    @endif
                    <p>
                        <input type="checkbox" checked name="ship_billing" id="ship_billing">
                        <label for="ship_billing"><span></span> Deliver to Address Above</label>
                    </p>
                    <div class="space30">&nbsp;</div>
                    <div id="diffshipping" style="display:none">

                        <h4>Deliver To</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="shipping_country">Country*</label>
                            <select name="shipping_country" id="shipping_country">
                                <option value="">Select a country…</option>

                                @if($countries)
                                @foreach($countries as $country)
                                @if($country->name == "Nigeria")
                                <option value="{{$country->name}}" selected>{{$country->name}}</option>
                                @else
                                <option value="{{$country->name}}">{{$country->name}}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-block">
                            <label for="shipping_firstname">First name*</label>
                            <input type="text" id="shipping_firstname" name="shipping_firstname"  placeholder="first name">
                        </div>

                        <div class="form-block">
                            <label for="shiping_lastname">Last name*</label>
                            <input type="text" id="shiping_lastname" name="shipping_lastname"  placeholder="last name">
                        </div>

                        <div class="form-block">
                            <label for="shipping_company">Company name</label>
                            <input type="text" id="shipping_company" name="shipping_company" placeholder="company">
                        </div>

                        <div class="form-block">
                            <label for="shipping_address">Address*</label>
                            <input type="text" id="shipping_address" name="shipping_address" placeholder="Street Address" >
                            <input type="text" id="shipping_apartment" name="shipping_apartment" placeholder="Apartment, suite, unit etc." >
                        </div>

                        <div class="form-block">
                            <label for="shipping_city">Town / City*</label>
                            <input type="text" id="shipping_city" name="shipping_city"   placeholder="Town / City*">
                        </div>

                        <div class="form-block">
                            <label for="shipping_state">State/Region</label>
                            <input type="text" id="shipping_state" name="shipping_state" placeholder ="State / Region">
                        </div>

                        <div class="form-block">
                            <label for="shipping_email">Email address*</label>
                            <input type="email" id="shipping_email" name="shipping_email"  placeholder="email">
                        </div>

                       <!-- <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input type="text" id="phone" name="phone" placeholder="phone" >
                        </div>-->

                    </div>

                    <div class="form-block">
                        <label for="notes">Order notes</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Your Order</h5></div>
                        <div class="your-order-body">


                            <?php
                                $content = Cart::content();
                                $ditem = Session::get('cartItems');
                                $total = Cart::total();
                                $itemHtml ="";
                            if(public_path()){
                                $source_folder = public_path().'/uploads/images/';
                                $destination_folder = public_path(). '/uploads/images/';
                            }else{
                                $source_folder = '/home/melkaycos/public_html/uploads/images/';
                                $destination_folder = '/home/melkaycos/public_html/uploads/images/';
                            }
                                if($content){
                                    foreach($content as $itemRow){
                                        ///home/melkaycos/public_html/uploads/images/
                                        $product =Product::find($itemRow->id);
                                        $image_info = pathinfo($source_folder.$product->image);
                                        $image_extension = strtolower($image_info["extension"]); //image extension
                                        $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                                        $imgName = $image_name_only."-262x311".".".$image_extension;

                                        echo"
                                        <div class='your-order-item'>
                                <div class='pull-left'>
                                    <div class='media'>
                                        <img src='".ASSETS_URL.'/uploads/images/thumbs/'.$imgName."' alt='' class='pull-left'>
                                        <div class='media-body'>
                                            <p class='font-large'>$product->title</p>";
                                        if($itemRow->options){
                                            echo " <span class='pink'>";
                                            $thml ="";
                                            $z=0;
                                            foreach($itemRow->options as $key=>$value){

                                                if($value !=""){

                                                    $thml .= " —".$value;

                                                }
                                            }
                                            $thml = preg_replace("/^ —/","",$thml);
                                            echo $thml;
                                            echo "</span>";

                                        }
                                            echo "<span class='color-gray your-order-info'>Qty: $itemRow->qty</span>
                                        </div>
                                    </div>
                                </div>
                                <div class='pull-right'><h5 class='color-gray'>&#8358;".number_format($itemRow->price*$itemRow->qty,2,".",",")."</h5></div>
                                <div class='clearfix'></div>
                            </div>

                                        ";
                                    }
                                }
                            ?>



                            <div class="your-order-item pbn">
                                <div class="pull-left">
                                    <p class="your-order-f18">Subtotal:</p>
                                    <p class="your-order-f18">Shipping:</p>
                                </div>
                                <div class="pull-right" id="cart-subtotal">
                                    <h5 class="color-gray text-right" data-subtotal="{{Cart::total()}}" >&#8358;{{number_format(Cart::total(),2,".",",")}}</h5>
                                    <p class="your-order-f18 color-gray text-right">Free Shipping</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Total:</p></div>
                                <div class="pull-right" id="cart-total" data-total="{{Cart::total()}}"><h5 class="color-black" >&#8358;{{number_format(Cart::total(),2,".",",")}}</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="your-order-head"><h5>Shipping Method</h5></div>

                        <div class="your-order-body">
                            <ul class="shipping_methods methods">
                                <li class="shipping_method_standard">
                                    <input id="shipping_method_standard" type="radio" class="input-radio" name="shipping_method" value="standard" checked="checked" data-order_button_text="">
                                    <label for="shipping_method_standard">Standard Shipping</label>
                                    <div class="shipping_box shipping_method_standard" style="display: block;">
                                        Your order will be delivered at the Shipping Address you supplied.<br>
                                        <strong>Shipping Time:</strong> 1 - 6 days
                                        Free
                                    </div>
                                </li>

                                <li class="shipping_method_express">
                                    <input id="shipping_method_express" type="radio" class="input-radio" name="shipping_method" value="express" data-order_button_text="">
                                    <label for="shipping_method_express">Express Shipping </label>
                                    <div class="shipping_box shipping_method_express" style="display: none;">
                                        Your order will be delivered at the Shipping Address you supplied.<br>
                                        <strong>Shipping Time:</strong> 1

                                    </div>
                                </li>

                                <li class="shipping_method_pickup">
                                    <input id="shipping_method_pickup" type="radio" class="input-radio" name="shipping_method" value="pickup" data-order_button_text="">
                                    <label for="shipping_method_pickup">Pickup Station</label>
                                    <div class="shipping_box shipping_method_pickup" style="display: none;">
                                        Selecting this indicate that
                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div class="your-order-head"><h5>Payment Method</h5></div>

                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">
                                    <label for="payment_method_bacs">Direct Bank Transfer </label>
                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
                                    </div>
                                </li>

                                <li class="payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="">
                                    <label for="payment_method_cheque">Cheque Payment </label>
                                    <div class="payment_box payment_method_cheque" style="display: none;">
                                        Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                    </div>
                                </li>

                                <li class="payment_method_paypal">
                                    <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to WebPay">
                                    <label for="payment_method_paypal">Webpay (Interswitch)</label>
                                    <div class="payment_box payment_method_paypal" style="display: none;">
                                        Pay using you credit card;
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center"><button class="beta-btn primary">Checkout <i class="fa fa-chevron-right"></i></button></div>

                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@stop