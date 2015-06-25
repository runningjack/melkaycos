<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	| Route::get('/', 'HomeController@showWelcome');
	|
	*/
    public $image_invention_folder = "/uploads/images/";
    public $image_relative_path     ="http://melkaycosmetics.com/uploads/images/";
    //public $url  = url("/");

	public function showWelcome()
	{
		return View::make('hello');
	}

    public function index()
    {
        if(Request::ajax()){
            if(isset($_GET['pid'])){
                $item = Product::find($_GET['pid']);
                Cart::add(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price, 'options' => array('size' => Input::get("size"),'buying'=>Input::get('buying'),'volume'=>Input::get("volume"),'weight'=>Input::get("weight"))));

                $content = Cart::content();

                return Response::json($content);
                exit;
            }
        }

        $latestproducts =DB::table('products')
            ->orderBy('created_at', 'asc')->take(6)
            //
            ->get();
        $newproducts =DB::table('products')
            ->orderBy('created_at', 'desc')->take(6)->get();
        $specialproducts =DB::table('products')->where("tag","special")
            ->orderBy('created_at', 'desc')->take(3)->get();
        return View::make('pages.home')->with("page_title","Welcome")
            ->with("categories",DB::table("categories")->where("parent_id",0)->get())
            ->with("brands",DB::table("brands")->get())
            ->with("newproducts",$newproducts)
            ->with("specialproducts",$specialproducts)
            ->with("latestproducts",$latestproducts)
            ->with('pages',DB::table("posts")->where("type","category")->orWhere("type","custom menu")->get());
    }

    public function postIndex(){
        if(Request::ajax()){
            if(isset($_POST['buypid'])){
                $optionprice = $name = DB::table('products_options')->where('product_id', $_POST['buypid'])->where("option_value",$_POST['buyoption'])->pluck('price');
                return $optionprice;
                exit;
            }
            if(isset($_POST['pid'])){
            $item = Product::find($_POST['pid']);
            Cart::add(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price, 'options' => array('size' => Input::get("size"),'buying'=>Input::get('buying'),'volume'=>Input::get("volume"),'optionid'=>Input::get("optid"),'weight'=>Input::get("weight"))));
            $content = Cart::content();
            Session::put("cartItems",$content);
            $total = Cart::total();

            $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
            if($content){
                foreach($content as $itemRow){
                    $product = Product::find($itemRow->id);
                    if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                        $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                    }
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
                $itemHtml .="</div>";
                echo $itemHtml;
            }



            if(isset($_POST['delid'])){
                //$item = Product::find($_POST['delid']);
                Cart::remove($_POST['delid']);   //(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                        $img2 = \Image::make($source_folder .$product->image);
                        $img2->resize(50,50);
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .="</div>";
                echo $itemHtml;
            }


            //return ($itemHtml);

            //exit;

        }
    }

    public function getRegister(){
        return View::make("register")
            ->with("countries",DB::table("country")->get())
            ->with("categories",DB::table("categories")->where("parent_id",0)->get());
    }
    public function getCart(){
        return View::make("cart")
            ->with("categories",DB::table("categories")->where("parent_id",0)->get());
    }

    public function postCart(){
        if(Request::ajax()){
            if(isset($_POST['buypid'])){
                $optionprice = $name = DB::table('products_options')->where('product_id', $_POST['buypid'])->where("option_value",$_POST['buyoption'])->pluck('price');
                return $optionprice;
                exit;
            }
            if(isset($_POST['pid'])){
                $item = Product::find($_POST['pid']);
                Cart::update($_POST['rowid'],array( 'qty' => $_POST['qty'], ));
                $content = Cart::content();

                $total = Cart::total();

                $itemHtml ="";
                /*$itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";*/
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                        if($itemRow->options){
                            foreach($itemRow->options as $key=>$value){
                                if($value != ""){
                                    $itemHtml .=$value."&mdash";
                                }
                            }
                        }

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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                /*$itemHtml .= "</div>";*/
                echo $itemHtml;
            }

            if(isset($_POST['delid'])){
                //$item = Product::find($_POST['delid']);
                Cart::remove($_POST['rowid']);   //(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                /*$itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";*/

                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                        $thml ="";
                        if($itemRow->options){
                            foreach($itemRow->options as $key=>$value){
                                if($value != ""){
                                    $thml .= " —".$value;
                                }
                            }
                            $thml = preg_replace("/^ —/","",$thml);
                        }


                        $itemHtml .= $thml."</span>";

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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                /*$itemHtml .="</div>";*/

                echo $itemHtml;
            }

            //return ($itemHtml);

            //exit;

        }
    }

    public function getCheckout(){
        return View::make("checkout")
            ->with("countries",DB::table("country")->get())
            ->with("categories",DB::table("categories")->where("parent_id",0)->get());
    }

    public function postCheckout(){
        $input = Input::get();
        $lastid = DB::table("orders")->max("id");
        $invoice_no = Order::invoiceNo($lastid);
        $input['invoice_no'] = $invoice_no;
        if (Auth::account()->check()) {

            $order = new Order();
            $user  = Auth::account()->get();
            $order->invoice_no              =   $invoice_no;
            $order->firstname               =   $user->firstname;
            $order->lastname                =   $user->lastname;
            $order->phone                   =   $user->phone;
            $order->email                   =   $user->email;
            $order->company                 =   $user->company;
            $order->address                 =   $user->address;
            $order->apartment               =   $user->apartment;
            $order->city                    =   $user->city;
            $order->state                   =   $user->state;
            $order->country                 =   $user->country;
            $order->customer_id             =   $user->id;
            if(isset($_POST['ship_billing'])){
                $order->shipping_firstname      =   $input['firstname'];
                $order->shipping_lastname       =   $input['lastname'];
                $order->shipping_company        =   $input['company'];
                $order->shipping_address_1      =   $input['apartment'];
                $order->shipping_address_2      =   $input['address'];
                $order->shipping_city           =   $input['city'];
                $order->state                   =   $input['state'];
                $order->shipping_country        =   $input['country'];
            }else{
                $order->shipping_firstname      =   $input['shipping_firstname']; //Auth::account()->firstname;
                $order->shipping_lastname       =   $input['shipping_lastname']; //Auth::account()->lastname;
                $order->shipping_company        =   $input['shipping_company'];//Auth::account()->company;
                $order->shipping_address_1      =   $input['shipping_apartment'];//Auth::account()->apartment;
                $order->shipping_address_2      =   $input['shipping_address']; //Auth::account()->address;
                $order->shipping_city           =   $input['shipping_city'];//Auth::account()->city;
                $order->shipping_state          =   $input['shipping_state']; //Auth::account()->state;
                $order->shipping_country        =   $input['shipping_country'];//Auth::account()->country;
            }
            $order->payment_firstname       =   $input['firstname'];
            $order->payment_lastname        =   $input['lastname'];
            $order->payment_company         =   $input['company'];
            $order->payment_address_1       =   $input['apartment'];
            $order->payment_address_2       =   $input['address'];
            $order->payment_city            =   $input['city'];
            $order->payment_state           =   $input['state'];
            $order->payment_method          =   $input['payment_method'];
            //$order->payment_postcode    =   $input['']
            $order->payment_country         =   $input['country'];

            $order->shipping_method         =   $input['shipping_method'];
            $order->notes                   =   $input['notes'];
            $order->total                   =   Cart::total();
            $order->sub_total               =   Cart::total();
            /*Add independent items to the item table*/
            $input['email'] = $user->email;
            /**
             * Took away order->save
             */



        }else{
            if(isset($input['create_account'])){
                $validation = Customer::validate(Input::all());
                $input = Input::all();
                if($validation->fails()){
                    return Redirect::back()->withErrors($validation)->withInput();
                }else{
                    array_forget($input,"_token");
                    array_forget($input,"confirmpassword");
                    array_forget($input,"submit");
                    array_forget($input,"ship_billing");
                    $customer = new Customer();
                    $customer->firstname               =   $input['firstname'];
                    $customer->lastname                =   $input['lastname'];
                    $customer->phone                   =   $input['phone'];
                    $customer->email                   =   $input['email'];
                    $customer->company                 =   $input['company'];
                    $customer->address                 =   $input['address'];
                    $customer->apartment               =   $input['apartment'];
                    $customer->city                    =   $input['city'];
                    $customer->country                 =   $input['country'];

                    $customer->password     =  Hash::make(Input::get("password"));
                    if($customer->save()){
                        /*Send Email to customer --TODO*/
                        $lastid = DB::table("orders")->max("id");
                        $invoice_no = Order::invoiceNo($lastid);
                        $input['invoice_no'] = $invoice_no;

                        $order = new Order();
                        $order->customer_id             =   $customer->id;
                        $order->invoice_no              =   $invoice_no;
                        $order->firstname               =   $input['firstname'];
                        $order->lastname                =   $input['lastname'];
                        $order->phone                   =   $input['phone'];
                        $order->email                   =   $input['email'];
                        $order->company                 =   $input['company'];
                        $order->address                 =   $input['address'];
                        $order->apartment               =   $input['apartment'];
                        $order->city                    =   $input['city'];
                        $order->country                 =   $input['country'];
                        $order->payment_firstname       =   $input['firstname'];
                        $order->payment_lastname        =   $input['lastname'];
                        //$order->payment_company         =   $input['company'];
                        $order->payment_address_1       =   $input['apartment'];
                        $order->payment_address_2       =   $input['address'];
                        $order->payment_city            =   $input['city'];
                        $order->payment_method          =   $input['payment_method'];
                        $order->payment_country         =   $input['country'];
                        if(isset($_POST['ship_billing'])){
                            $order->shipping_firstname      =   $input['firstname'];
                            $order->shipping_lastname       =   $input['lastname'];
                            $order->shipping_company        =   $input['company'];
                            $order->shipping_address_1      =   $input['apartment'];
                            $order->shipping_address_2      =   $input['address'];
                            $order->shipping_city           =   $input['city'];
                            $order->state                   =   $input['state'];
                            $order->shipping_country        =   $input['country'];
                        }else{
                            $order->shipping_firstname      =   $input['shipping_firstname'];
                            $order->shipping_lastname       =   $input['shipping_lastname'];
                            $order->shipping_company        =   $input['shipping_company'];
                            $order->shipping_address_1      =   $input['shipping_apartment'];
                            $order->shipping_address_2      =   $input['shipping_address'];
                            $order->shipping_city           =   $input['shipping_city'];
                            $order->shipping_state          =   $input['shipping_state'];
                            $order->shipping_country        =   $input['shipping_country'];
                        }
                        $order->shipping_method         =   $input['shipping_method'];
                        $order->notes                   =   $input['notes'];
                        $order->total                   =   Cart::total();
                        $order->sub_total               =   Cart::total();

                        /**
                        took away order->save for new customer
                         */
                    }
                }
            }else{ //Section to be executed if customer does not want to register an account

                $lastid = DB::table("orders")->max("id");
                $invoice_no = Order::invoiceNo($lastid);
                $input['invoice_no'] = $invoice_no;
                $order = new Order();
                $order->invoice_no              =   $invoice_no;
                $order->firstname               =   $input['firstname'];
                $order->lastname                =   $input['lastname'];
                $order->phone                   =   $input['phone'];
                $order->email                   =   $input['email'];
                $order->company                 =   $input['company'];
                $order->address                 =   $input['address'];
                $order->apartment               =   $input['apartment'];
                $order->city                    =   $input['city'];
                $order->country                 =   $input['country'];
                //$order->customer_id             =   $invoice_id;
                if(isset($_POST['ship_billing'])){
                    $order->shipping_firstname      =   $input['firstname'];
                    $order->shipping_lastname       =   $input['lastname'];
                    $order->shipping_company        =   $input['company'];
                    $order->shipping_address_1      =   $input['apartment'];
                    $order->shipping_address_2      =   $input['address'];
                    $order->shipping_city           =   $input['city'];
                    $order->shipping_country        =   $input['country'];
                }else{
                    $order->shipping_firstname      =   $input['shipping_firstname'];
                    $order->shipping_lastname       =   $input['shipping_lastname'];
                    $order->shipping_company        =   $input['shipping_company'];
                    $order->shipping_address_1      =   $input['shipping_apartment'];
                    $order->shipping_address_2      =   $input['shipping_address'];
                    $order->shipping_city           =   $input['shipping_city'];
                    $order->shipping_state          =   $input['shipping_state'];
                    $order->shipping_country        =   $input['shipping_country'];
                }
                $order->payment_firstname       =   $input['firstname'];
                $order->payment_lastname        =   $input['lastname'];
                $order->payment_company         =   $input['company'];
                $order->payment_address_1       =   $input['apartment'];
                $order->payment_address_2       =   $input['address'];
                $order->payment_city            =   $input['city'];
                $order->payment_method          =   $input['payment_method'];
                //$order->payment_postcode    =   $input['']
                $order->payment_country         =   $input['country'];

                $order->shipping_method         =   $input['shipping_method'];
                $order->notes                   =   $input['notes'];
                $order->total                   =   Cart::total();
                $order->sub_total               =   Cart::total();
               /**
               Took away order->save on non- registering customer
                */

            }
        }

        //save order and perform other functionality

        /*Add independent items to the item table*/
        if($order->save()){
            $orderitems   =   Cart::content();
            foreach($orderitems as $orderitem){

                /*
                *|This section check for if product has a whole sale buying
                *|option i.e. if there is bulk purchase on carton or in Dozen
                *|$order item price changes to the carton or bulk purchase price
                *|chosen
                */


                /*
                *|insert purchased item(s) in to the orders_products
                *|table
                */
                /*Todo find betta way to do this with single object insert*/
                $total = $orderitem->qty * $orderitem->price;

                \DB::table('orders_products')->insert(
                    ['product_id' => $orderitem->id, 'order_id' => $order->id, 'product_name'=>$orderitem->name,
                        'price'=>$orderitem->price, 'quantity'=>$orderitem->qty,'total'=>$total]
                );
                /*
                *|insert into order_option table to store
                *|product option selected by customers
                */
                /*Todo find betta way to do this with single object insert*/

                if($orderitem->options && count($orderitem->options) > 0){
                    foreach($orderitem->options as $key=>$value ){


                        $productoption = DB::table("products_options")->where("product_id","=",$orderitem->id)->where("option_value","=",$value)->get();
                        if(count($productoption)>0 ){
                        DB::table("orders_options")->insert(
                            ['order_id'=>$order->id,'product_id'=>$orderitem->id,'product_option_id'=>$productoption[0]->product_option_value_id,'product_option_value_id'=>$productoption[0]->option_value_id,'name'=>$productoption[0]->option_type,"value"=>$productoption[0]->option_value]
                        );
                        }
                    }
                }
            }

            /* TODO Section to load options on products*/

            /*Send order info to customer as an invoice or notification*/
            $input['order_message'] = "";
            $input['order_footnote']="";
            $input['order_id']= $order->id;

            Mail::send('emails.orderconfirmation', $input, function($message) use($input) {
                $message->from("orders@melkaycosmetics.com", "Melkay Cosmetics ");
                $message->to($input['email'], "order@melkaycosmetics.com")->cc('ahmed@chroniclesoft.com')->subject("Order Confirmation: ". $input['invoice_no']);
            });

        }

        /*return View::make("success")->with("categories",DB::table("categories")->get())
            ->with("order",Order::find($order->id));*/
        return Redirect::route("success")
            ->with("order",Order::find($order->id));


    }

    public function getContact()
    {
        $contact = Post::where("type",'page')
            ->where('permalink', 'contact')
            ->first();
        return  View::make('contactus')

            ->with('contact', $contact);
    }

    public function getPages($pagelink){

        $sliders  = \DB::table("posts")->where("type","slideshow")->where("status","published")->get();
        $page = new Post();
        try{
            $page = Post::where('permalink', '=', $pagelink)->where("status","published")->first();
        }catch(Exception $e){
            Redirect::to('pages/error')->with('title',"Page not found")
                ->with("categories", DB::table("categories")->get());
        }
        if(count($page)==1  ){
            if(strtolower($page->permalink) == "contact" || strtolower($page->permalink) == "contact-us"){
                return View::make('pages.contactus')->with('title',"Contact Us")
                    ->with("categories", DB::table("categories")->get())
                    ;
                exit;
            }
            if($page->type=="post"){
                return View::make('posts.post')->with('page',$page)->with('title',$page->title)
                    ->with("categories", DB::table("categories")->get())
                   ;
            }elseif($page->type=="page"){
                return View::make('pages.page')->with('page',$page)->with('title',$page->title)
                    ->with("categories", DB::table("categories")->get())
                    ;
            }elseif($page->type == "category"){

                $categories  = DB::table("posts")->where("parent_id",$page->id)->paginate(20);
                return View::make("posts.category")->with('page',$page)->with('title',$page->title)
                    ->with("categories", DB::table("categories")->get());
            }

        }else{
            //return View::makeRedirect::to
            return View::make('pages/error')->with('title',"Page not found")
                ->with("categories", DB::table("categories")->get())
                ;
        }
    }

    public function getSuccess(){
        return View::make("success")->with("categories",DB::table("categories")->get());
    }

    public function postRegister(){
        $validation = Customer::validate(Input::all());
        $input = Input::all();
        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $customer = new Customer();
            if(isset($input['ship_billing'])){
                $customer->shipping_firstname      =   $input['firstname'];
                $customer->shipping_lastname       =   $input['lastname'];
                $customer->shipping_company        =   $input['company'];
                $customer->shipping_address_1      =   $input['apartment'];
                $customer->shipping_address_2      =   $input['address'];
                $customer->shipping_city           =   $input['city'];
                $customer->shipping_country        =   $input['country'];
            }
            array_forget($input,"_token");
            array_forget($input,"confirmpassword");
            array_forget($input,"submit");
            array_forget($input,"ship_billing");

            foreach($input as $key=>$value){
                $customer->$key = $value;
            }

            $customer->password     =  Hash::make(Input::get("password"));
            if($customer->save()){

                Mail::send('emails.register', $input, function($message) use($input) {
                    $message->from("info@melkaycosmetics.com", "Melkay Cosmetics ");
                    $message->to($input['email'], "info@melkaycosmetics.com")->cc('ahmed@chroniclesoft.com')->subject("Registration ");
                });

                Session::put("success_message","Your Registration was successful");
                return Redirect::back();
            }else{
                Session::put("error_message","Your registration was not successful, please try again next time");
                return Redirect::back();
            }
        }
    }

    public function postPages($pagelink){
        $input = Input::all();

       // if(Request::ajax()){
            if($pagelink == "contact-us"){
                $input = Input::all();
                // print_r($input);
                $rules = array(
                    'email' => 'required|min:5|email',
                    'name' => 'required',
                    'message_text' => 'required',
                );

                try {
                    $validator = Validator::make(Input::all(), $rules);


                    if($validator->passes()){

                        Mail::send('emails.contactus', $input, function($message) use($input) {
                            $message->from($input['email'], "Melkaycosmetics.com Contact Page ". $input['name']);
                            $message->to("melkamson@yahoo.co.uk", "Melkay Cosmtics")->cc('amedora09@gmail.com')
                                ->subject($input['subject']);
                        });

                        Session::put("success_message","Thank you for contacting us! ");
                        return Redirect::back();

                    }else{

                        return Redirect::back()->withErrors($validator)->withInput();
                    }
                    //

                } catch (Exception $e) {
                    return Redirect::back()
                        ->withInput()
                        ->with('error_message', $e->getMessage());
                } catch(ValidationException $e) {
                    return Redirect::back()
                        ->withInput()
                        ->with('error_message', $e->getMessage());
                }catch(Swift_RfcComplianceException $e){
                    return Redirect::back()
                        ->withInput()
                        ->with('error_message', $e->getMessage());
                }


            }

       // }
    }



    public function postProduct($id=""){
        if(Request::ajax()){

            if(isset($_POST['buypid'])){
                $optionprice = $name = DB::table('products_options')->where('product_id', $_POST['buypid'])->where("option_value",$_POST['buyoption'])->pluck('price');
                return $optionprice;
                exit;
            }


        if(isset($_POST['pid'])){
        $item = Product::find((int)$_POST['pid']);

                if(isset($_POST['buying']) && $_POST['buying'] !=""){
                    $item->price =  DB::table('products_options')->where('product_id', (int)$_POST['pid'])->where("option_value",$_POST['buying'])->pluck('price');

                }


                Cart::add(array('id' => $item->id, 'name' => $item->title, 'qty' => Input::get("qty"), 'price' => $item->price,'options'=>array("size"=>Input::get("size"),"buying"=>Input::get("buying"),"volume"=>Input::get("volume"))));
                $content = Cart::content();

                $total = Cart::total();

                $itemHtml ="";
               $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);

                        if(public_path()){
                            $source_folder = public_path().'/uploads/images/';
                            $destination_folder = public_path(). '/uploads/images/';
                        }else{
                            $source_folder = '/home/melkaycos/public_html/uploads/images/';
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
                                     <span class='cart-item-title'>".$itemRow->name."</span>";
                        $itemHtml .="<span class='cart-item-options'>";
                        $thml ="";
                        if($itemRow->options){
                            foreach($itemRow->options as $key=>$value){
                                if($value != ""){
                                    $thml .= " —".$value;
                                }
                            }
                            $thml = preg_replace("/^ —/","",$thml);
                        }


                        $itemHtml .= $thml."</span>";

                        $itemHtml .=  "<span class='cart-item-amount'>$itemRow->qty*<span>&#8358;".number_format($itemRow->price,2,'.',',')."</span>
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .= "</div>";
                echo $itemHtml;
            }



        if(isset($_POST['delid'])){
                //$item = Product::find($_POST['delid']);
                Cart::remove($_POST['delid']);   //(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                                     <span class='cart-item-title'>".$itemRow->name."</span>";
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .="</div>";
                echo $itemHtml;
            }

    }
    }

/*Returns a product detail
*
*/
    public function getProduct($path){
        if($path !=""){
            $product = Product::find($path);

            $product_option_data = array();

            //$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "products_options po LEFT JOIN `" . DB_PREFIX . "options` o ON (po.option_id = o.option_id)
            //LEFT JOIN " . DB_PREFIX . "option_values od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$path . "'");
            $product_option_query =DB::table('products_options')
                ->leftJoin('options', 'products_options.option_id', '=', 'options.id')
                ->leftJoin("options_values",'options.id',"=","options_values.option_id")
                ->where("products_options.product_id","=",$path)->groupBy("options_values.title")
                ->get();

            //print_r($product_option_query);
            if($product_option_query){
            foreach($product_option_query as $optionquery){
                $product_option_value_query =DB::table("products_options")
                    ->leftJoin("options_values","products_options.option_value_id","=","options_values.id")
                    ->where("products_options.product_id","=",$path)->groupBy('products_options.option_type')->get();
                foreach ($product_option_value_query as $product_option_value) {
                    $product_option_value_data[] = array(
                        'product_option_value_id' => $product_option_value->product_option_value_id,
                        'option_value_id'         => $product_option_value->option_value_id,
                        'name'                    => $product_option_value->option_value,
                        'type'                    => $product_option_value->option_type,
                        'image'                   => $product_option_value->image,
                        'quantity'                => $product_option_value->quantity,
                        'subtract'                => $product_option_value->subtract,
                        'price'                   => $product_option_value->price,
                        'price_prefix'            => $product_option_value->price_prefix,
                        'weight'                  => $product_option_value->weight,
                        'weight_prefix'           => $product_option_value->weight_prefix
                    );
                }
                $product_option_data[] = array(
                    'product_option_id' => $optionquery->product_id,
                    'option_id'         => $optionquery->option_id,
                    'name'              =>$optionquery->title,
                    'type'              => $optionquery->type,
                    'option_value'      => $product_option_value_data,
                    'product_option_value_id' => $optionquery->product_option_value_id,
                    'required'          => "");//$optionquery->required);
            }
            }

            //print_r($product_option_value_query);

            if($product){
                return View::make("product.details.index")->with("myproduct",$product)
                    ->with("product",$product)
                ->with("moptions",$product_option_data)
                    ->with("categories",DB::table("categories")->get())
                    ->with("options",DB::table("options_values")->get())
                    ->with("productoptions",DB::table("products_options")->where("product_id","=",$product->id)->get())
                    ->with("related",DB::table("products")->where("brand_id",$product->brand_id)->where("id","!=",$product->id)->get())
                    ->with("brands",DB::table("brands")->get());
            }
        }
    }
/*
 * Gets item for the catalogue in categories
 * */
    public function getCatalogue($path){
        if($path !=""){

            $category = Category::find($path);

            //$catego = DB::select('select * from categories_products where id = '".$path."', array('value'));
            //$subcategory = DB::table("categories")
            $catego = DB::table("categories_products")->where("category_id",$path)->get();
            $catlist = "";
            if($category){

                foreach($catego as $mecat){
                    $catlist .=$mecat->product_id.",";
                }
                $catlist = explode(",",$catlist);
                //var_dump($catlist);
                return View::make("product.category.index")
                    ->with("category",Category::find($path))
                    ->with("products",DB::table("products")->whereIn('id', $catlist)->get())
                    ->with("categories",DB::table("categories")->get())
                    ->with("options",DB::table("products_options")->where("product_id","=",$path)->groupBy("option_type")->get())
                    ->with("subcategories",DB::table("categories")->where("parent_id",$path)->get())
                    ->with("brands",DB::table("brands")->get());
            }else{
                foreach($catego as $mecat){
                    $catlist .=$mecat->product_id.",";
                }
                $catlist = explode(",",$catlist);
                //var_dump($catlist);
                return View::make("product.category.index")
                    ->with("category",Category::find($path))
                    ->with("subcategories",DB::table("categories")->where("parent_id",$path)->get())
                    ->with("products",DB::table("products")->whereIn('id', $catlist)->get())
                    ->with("options",DB::table("products_options")->where("product_id","=",$path)->groupBy("option_type")->get())
                    ->with("categories",DB::table("categories")->get())
                    ->with("brands",DB::table("brands")->get());
            }
        }
    }

    public function postCatalogue($id=""){
        if(Request::ajax()){
            if(isset($_POST['buypid'])){
                $optionprice = $name = DB::table('products_options')->where('product_id', $_POST['buypid'])->where("option_value",$_POST['buyoption'])->pluck('price');
                return $optionprice;
                exit;
            }
            if(isset($_POST['pid'])){
                $item = Product::find(preg_replace('#[^0-9]#i','',$_POST['pid']));
                Cart::add(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price,'options' => array('size' => Input::get("size"),'buying'=>Input::get('buying'),'volume'=>Input::get("volume"),'optionid'=>Input::get("optid"),'weight'=>Input::get("weight"))));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                      <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .= "</div>";
                echo $itemHtml;
            }


            if(isset($_POST['delid'])){
                //$item = Product::find($_POST['delid']);
                Cart::remove($_POST['delid']);   //(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .="</div>";
                echo $itemHtml;
            }
        }
    }

    public function getBrand($link){
        if($link !="" && !isset($_GET['s']) ){
            $pbrand = DB::table("brands")->where("title",$link)->first();
        }
        if($link !="" && isset($_GET['s']) ){
            $pbrand = DB::table("brands")->where("title",$link)->first();
        }

        if ($pbrand){
            return View::make("product.brands.index")
                ->with("title",$pbrand->title)->with("products",DB::table("products")->where("brand_id",$pbrand->id)->get())
                ->with("categories",DB::table("categories")->get())
                ->with("brands",DB::table("brands")->get());
        }
    }

    public function postBrand(){
        if(Request::ajax()){
            if(isset($_POST['buypid'])){
                $optionprice = $name = DB::table('products_options')->where('product_id', $_POST['buypid'])->where("option_value",$_POST['buyoption'])->pluck('price');
                return $optionprice;
                exit;
            }
            if(isset($_POST['pid'])){
                $item = Product::find($_POST['pid']);
                Cart::add(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price, 'options' => array('size' => Input::get("size"),'buying'=>Input::get('buying'),'volume'=>Input::get("volume"),'optionid'=>Input::get("optid"),'weight'=>Input::get("weight"))));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                $itemHtml .="</div>";
                echo $itemHtml;
            }

            if(isset($_POST['delid'])){
                //$item = Product::find($_POST['delid']);
                Cart::remove($_POST['delid']);   //(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                        $itemHtml .="
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .="</div>";
                echo $itemHtml;
            }
        }
    }

    public function getProductFilter(){

    }

    public function getSearch($item=""){
        if(isset($_GET["s"]) && $_GET["s"] != ""){
                $cats = DB::table("categories")
                    ->orWhere("description","LIKE","%".Input::get("s")."%")
                    ->orWhere("title","LIKE","%".Input::get("s")."%")->get();
            if($cats){

            }else{
                $cats = DB::table("categories")->get();
            }


                return View::make("catalog")
                    ->with("title","products containing ".$_GET["s"])
                    ->with("qstring",$_GET["s"])
                    ->with("products",DB::table("products")
                        ->orWhere("description","LIKE","%".Input::get("s")."%")
                        ->orWhere("title","LIKE","%".Input::get("s")."%")->paginate(15))
                    ->with("categories",$cats)
                    ->with("brands",DB::table("brands")->get());



        }elseif(isset($_GET["s"]) && $_GET["s"] == ""){
            return View::make("catalog")->with("title","No Product found for this query!")
                ->with("categories",DB::table("categories")
                    ->orWhere("description","LIKE","%".Input::get("s")."%")
                    ->orWhere("title","LIKE","%".Input::get("s")."%")->get())
                ->with("brands",DB::table("brands")->get());

        }else{
            return View::make("catalog")->with("title",$item." Search ")
                ->with("categories",DB::table("categories")->get())
                ->with("brands",DB::table("brands")->get());
        }


    }

    public function postSearch($item=""){
        if(Request::ajax()){
            if(isset($_POST['buypid'])){
                $optionprice = $name = DB::table('products_options')->where('product_id', $_POST['buypid'])->where("option_value",$_POST['buyoption'])->pluck('price');
                return $optionprice;
                exit;
            }
            if(isset($_POST['pid'])){
                $item = Product::find($_POST['pid']);
                Cart::add(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price,'options' => array('size' => Input::get("size"),'buying'=>Input::get('buying'),'volume'=>Input::get("volume"),'optionid'=>Input::get("optid"),'weight'=>Input::get("weight"))));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
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
                $itemHtml .="</div>";
                echo $itemHtml;
            }

            if(isset($_POST['delid'])){
                //$item = Product::find($_POST['delid']);
                Cart::remove($_POST['delid']);   //(array('id' => $item->id, 'name' => $item->title, 'qty' => 1, 'price' => $item->price));
                $content = Cart::content();
                Session::put("cartItems",$content);
                $total = Cart::total();

                $itemHtml ="";
                $itemHtml .="<div class='beta-select'><i class='fa fa-shopping-cart'></i><span id='cart-count'> Cart (".Cart::count().")</span> <i class='fa fa-chevron-down'></i></div>
                     <div class='beta-dropdown cart-body'>";
                if($content){
                    foreach($content as $itemRow){
                        $product = Product::find($itemRow->id);
                        if($itemRow->options->has('buying') && $itemRow->options->buying !=""){
                            $itemRow->price  = DB::table('products_options')->where("product_option_value_id",$itemRow->optionid)->pluck('price');
                        }
                        $image_info = pathinfo($source_folder .$product->image);
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
                        $itemHtml .= "
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
                             </div></div>";



                }else{
                    $itemHtml .= "Cart is empty";
                }
                $itemHtml .="</div>";
                echo $itemHtml;
            }
        }
    }


}
