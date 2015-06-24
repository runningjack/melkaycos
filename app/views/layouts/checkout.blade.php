<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 5/7/15
 * Time: 9:52 PM
 */?>
<?php
require_once("inc/init.php");
require_once("inc/config.ui.php");

?>
<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    <style type="text/css">
        input.error { border: 1px solid red; }
        label.error {
            background: url('<?php echo ASSETS_URL ?>/img/unchecked.gif') no-repeat;
            padding-left: 16px;
            margin-left: .3em;
        }
        label.valid {
            background: url('<?php echo ASSETS_URL ?>/img/checked.gif') no-repeat;
            display: block;
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body id="page-top">
@include('includes.header2')
@yield('content')
@include('includes.footer')
<script src="<?php echo ASSETS_URL ?>/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/waypoints.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/wow.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/animo/Animo.js"></script>
<script src="<?php echo ASSETS_URL ?>/vendors/dug/dug.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/scripts.min.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/styleswitcher.js"></script>
<script src="<?php echo ASSETS_URL ?>/js/loading-overlay.min.js"></script>
<!--<script src="<?php /*echo ASSETS_URL */?>/js/jquery.validate.min.js"></script>
<script src="<?php /*echo ASSETS_URL */?>/js/additional-methods.min.js"></script>-->

<script>
    // just for the demos, avoids form submit

</script>
<script>
    $(document).ready(function(){
        /* jQuery.validator.setDefaults({
         debug: false,
         success: "valid"
         });
         $( "#frm" ).validate({
         rules: {
         password: "required",
         confirmpassword: {
         equalTo: "#password"
         }
         }
         });*/

        $("a.update-product").each(function(){

            $(this).on("click",function(){
                var target =$(this)
                target.loadingOverlay()
                var qty = $(this).siblings("input#product-qty").val()
                var amount = qty * $(this).attr("price")
                var amountField = $(this).parents("td.product-quantity").siblings("td.product-subtotal").children("span.amount")
                var cartsub    =$("#cart-subtotal") //element holding subtotal amount
                var carttotal  = $("#cart-total") //element holding total cart amount
                var Dsubtotal  = cartsub.attr("data-cart"); //subtotal amount before quantity was changed
                var Damount     = amountField.attr("data-cart"); //total on item before qunatity is changed
                var Dtotal     = carttotal.attr("data-cart");

                var request = $.ajax({
                    url:"",
                    type:"post",
                    data:{rowid:target.attr("rowid"),pid:target.attr("pid"),qty:qty},
                    dataType:"html"
                })

                request.done(function(data){
                    $(".cart-body").html(data);

                    //&#8358;
                    cartsub.html(parseFloat(Dsubtotal)-(parseFloat(Damount))+parseFloat(amount))
                    carttotal.html(parseFloat(Dtotal)-(parseFloat(Damount))+parseFloat(amount))
                    amountField.html(parseFloat(amount))
                    cartsub.attr("data-cart",parseFloat(Dsubtotal)-(parseFloat(Damount))+parseFloat(amount))
                    carttotal.attr("data-cart",parseFloat(Dtotal)-(parseFloat(Damount))+parseFloat(amount))
                    amountField.attr("data-cart",parseFloat(amount))
                    amountField.formatCurrency();
                    carttotal.formatCurrency();
                    cartsub.formatCurrency();
                    target.loadingOverlay("remove");
                })
            })
        })

        $(".remove").each(function(){
            $(this).on("click",function(){

                var target = $(this);
                //if (target.hasClass('loading')) {

                //} else {
                target.loadingOverlay();
                //};
                var delTrow = $(this).parents("tr")

                var amountField = target.attr("data-cart")

                var cartsub    =$("#cart-subtotal") //element holding subtotal amount
                var carttotal  = $("#cart-total") //element holding total cart amount
                var Dsubtotal  = cartsub.attr("data-cart"); //subtotal amount before quantity was changed
                var Damount     = amountField; //total on item before qunatity is changed
                var Dtotal     = carttotal.attr("data-cart");

                var request = $.ajax({
                    url : "",
                    type:"post",
                    data:{rowid:$(this).attr("rowid"),delid:$(this).attr("pid")},
                    dataType:"html"
                })
                request.done(function(data){
                    $(".cart-body").html(data);
                    cartsub.html(parseFloat(Dsubtotal)-parseFloat(Damount))
                    carttotal.html(parseFloat(Dtotal)-parseFloat(Damount))
                    cartsub.attr("data-cart",parseFloat(Dsubtotal)-parseFloat(Damount))
                    carttotal.attr("data-cart",parseFloat(Dtotal)-parseFloat(Damount))
                    carttotal.formatCurrency();
                    cartsub.formatCurrency();
                    target.loadingOverlay("remove");
                    delTrow.detach();

                })
                request.fail(function(){

                })

            })
        })



        $(".cart-item-delete").each(function(){
            $(this).on("click",function(){
                var target = $(this).parents("div.cart-body");

                //if (target.hasClass('loading')) {

                //} else {
                target.loadingOverlay();
                //};
                var request = $.ajax({
                    url : "",
                    type:"post",
                    data:{delid:$(this).attr("pid"),currency:""},
                    dataType:"html"
                })
                request.done(function(data){
                    $(".cart-body").html(data);
                    target.loadingOverlay('remove');

                })
                request.fail(function(){

                })

            })
        })
    })
</script>
<script>
    (function($){$.formatCurrency={};$.formatCurrency.regions=[];$.formatCurrency.regions[""]={symbol:"₦",positiveFormat:"%s%n",negativeFormat:"(%s%n)",decimalSymbol:".",digitGroupSymbol:",",groupDigits:true};
        $.fn.formatCurrency=function(destination,settings){if(arguments.length==1&&typeof destination!=="string"){settings=destination;destination=false
        }var defaults={name:"formatCurrency",colorize:false,region:"",global:true,roundToDecimalPlace:2,eventOnDecimalsEntered:false};defaults=$.extend(defaults,$.formatCurrency.regions[""]);
            settings=$.extend(defaults,settings);if(settings.region.length>0){settings=$.extend(settings,getRegionOrCulture(settings.region))}settings.regex=generateRegex(settings);
            return this.each(function(){$this=$(this);var num="0";num=$this[$this.is("input, select, textarea")?"val":"html"]();if(num.search("\\(")>=0){num="-"+num
            }if(num===""||(num==="-"&&settings.roundToDecimalPlace===-1)){return}if(isNaN(num)){num=num.replace(settings.regex,"");if(num===""||(num==="-"&&settings.roundToDecimalPlace===-1)){return
            }if(settings.decimalSymbol!="."){num=num.replace(settings.decimalSymbol,".")}if(isNaN(num)){num="0"}}var numParts=String(num).split(".");var isPositive=(num==Math.abs(num));
                var hasDecimals=(numParts.length>1);var decimals=(hasDecimals?numParts[1].toString():"0");var originalDecimals=decimals;num=Math.abs(numParts[0]);
                num=isNaN(num)?0:num;if(settings.roundToDecimalPlace>=0){decimals=parseFloat("1."+decimals);decimals=decimals.toFixed(settings.roundToDecimalPlace);
                    if(decimals.substring(0,1)=="2"){num=Number(num)+1}decimals=decimals.substring(2)}num=String(num);if(settings.groupDigits){for(var i=0;i<Math.floor((num.length-(1+i))/3);
                                                                                                                                                   i++){num=num.substring(0,num.length-(4*i+3))+settings.digitGroupSymbol+num.substring(num.length-(4*i+3))}}if((hasDecimals&&settings.roundToDecimalPlace==-1)||settings.roundToDecimalPlace>0){num+=settings.decimalSymbol+decimals
                }var format=isPositive?settings.positiveFormat:settings.negativeFormat;var money=format.replace(/%s/g,settings.symbol);money=money.replace(/%n/g,num);
                var $destination=$([]);if(!destination){$destination=$this}else{$destination=$(destination)}$destination[$destination.is("input, select, textarea")?"val":"html"](money);
                if(hasDecimals&&settings.eventOnDecimalsEntered&&originalDecimals.length>settings.roundToDecimalPlace){$destination.trigger("decimalsEntered",originalDecimals)
                }if(settings.colorize){$destination.css("color",isPositive?"black":"red")}})};$.fn.toNumber=function(settings){var defaults=$.extend({name:"toNumber",region:"",global:true},$.formatCurrency.regions[""]);
            settings=jQuery.extend(defaults,settings);if(settings.region.length>0){settings=$.extend(settings,getRegionOrCulture(settings.region))}settings.regex=generateRegex(settings);
            return this.each(function(){var method=$(this).is("input, select, textarea")?"val":"html";$(this)[method]($(this)[method]().replace("(","(-").replace(settings.regex,""))
            })};$.fn.asNumber=function(settings){var defaults=$.extend({name:"asNumber",region:"",parse:true,parseType:"Float",global:true},$.formatCurrency.regions[""]);
            settings=jQuery.extend(defaults,settings);if(settings.region.length>0){settings=$.extend(settings,getRegionOrCulture(settings.region))}settings.regex=generateRegex(settings);
            settings.parseType=validateParseType(settings.parseType);var method=$(this).is("input, select, textarea")?"val":"html";var num=$(this)[method]();
            num=num?num:"";num=num.replace("(","(-");num=num.replace(settings.regex,"");if(!settings.parse){return num}if(num.length==0){num="0"}if(settings.decimalSymbol!="."){num=num.replace(settings.decimalSymbol,".")
            }return window["parse"+settings.parseType](num)};function getRegionOrCulture(region){var regionInfo=$.formatCurrency.regions[region];if(regionInfo){return regionInfo
        }else{if(/(\w+)-(\w+)/g.test(region)){var culture=region.replace(/(\w+)-(\w+)/g,"$1");return $.formatCurrency.regions[culture]}}return null}function validateParseType(parseType){switch(parseType.toLowerCase()){case"int":return"Int";
            case"float":return"Float";default:throw"invalid parseType"}}function generateRegex(settings){if(settings.symbol===""){return new RegExp("[^\\d"+settings.decimalSymbol+"-]","g")
        }else{var symbol=settings.symbol.replace("$","\\$").replace(".","\\.");return new RegExp(symbol+"|[^\\d"+settings.decimalSymbol+"-]","g")}}})(jQuery);



</script>
</body>
</html>
