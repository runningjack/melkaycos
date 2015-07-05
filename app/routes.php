<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
//	return View::make('hello');
//});


Route::get('/',array("as"=>"home", "uses"=> 'HomeController@index'));
Route::post('/',array("as"=>'homepost',"uses"=>"HomeController@postIndex"));


Route::get('pages/home', 'HomeController@index');
Route::get('pages/{permalink}',array('as'=>'pages','uses'=>'HomeController@getPages'));
Route::get('posts/{permalink}',array('as'=>'pages','uses'=>'HomeController@getPages'));
Route::Post('pages/{permalink}',array('as'=>'pages','uses'=>'HomeController@postPages'));

Route::get("pages/contactus",array("as"=>"cont","uses"=>"HomeController@getContact"));

Route::get("product/details/{path}",array("as"=>"proddetail","uses"=>"HomeController@getProduct"));
Route::post("product/details/{path}",array("as"=>"postproddetail","uses"=>"HomeController@postProduct"));
Route::get("product/category/{path}",array("as"=>"catalogue","uses"=>"HomeController@getCatalogue"));
Route::post("product/category/{path}",array("as"=>"postcatalogue","uses"=>"HomeController@postCatalogue"));
Route::get("product/brands/{path}",array("as"=>"brand","uses"=>"HomeController@getBrand"));
Route::post("product/brands/{path?}",array("as"=>"postbrands","uses"=>"HomeController@postCatalogue"));
Route::get("/catalog/{search?}", array("as"=>"search","uses"=>"HomeController@getSearch"));
Route::post("/catalog/{search?}", array("as"=>"postsearch","uses"=>"HomeController@postCatalogue"));
Route::get("register",array("as"=>"register","uses"=>"HomeController@getRegister"));
Route::get("cart",array("as"=>"cart","uses"=>"HomeController@getCart"));
Route::post("cart",array("as"=>"postcart","uses"=>"HomeController@postCart"));
Route::get("checkout",array("as"=>"checkout","uses"=>"HomeController@getCheckout"));
Route::post("checkout",array("as"=>"postcheckout","uses"=>"HomeController@postCheckout"));
Route::get("success",array("as"=>"success","uses"=>"HomeController@getSuccess"));
Route::post("register",array("as"=>"pregister","uses"=>"HomeController@postRegister"));


Route::post("pages/contactus/{id?}",array("as"=>"cont","uses"=>"HomeController@postContact"));


Route::group(array('prefix' => 'account'), function() {
Route::get("/index/",array("as"=>"account_home",'before' => 'auth',"uses"=>"Account\HomeController@getAccountIndex"));
});

Route::get('uploads/images/{path}', function() {
    // Invoke croppa
})->where('path', 'croppa-pattern');

//Route::get('/login', array('as'=>'login','uses' => 'HomeController@showLogin'));

/*
  |--------------------------------------------------------------------------
  | Backend Routes
  |--------------------------------------------------------------------------
 */
Route::group(array('prefix' => 'backend'), function() {
    Route::group(array('before' => 'auth'), function(){
        Route::controller('filemanager', 'FilemanagerLaravelController');
    });
    Route::any('/', 'Backend\HomeController@getIndex');
    Route::get('dashboard/index', array("as"=>"dashboard",'before' => 'auth', "uses"=>'Backend\HomeController@getIndex'));
    Route::get('pages/index',array("as"=>"pageslisting",'before' => 'auth','uses'=>'Backend\HomeController@getPagesList'));
    Route::get('pages/addnew/{type?}',array('as'=>'addnewpage','before' => 'auth','uses'=>'Backend\HomeController@getAddPage'));
    Route::get('categories/index',array('as'=>'listcat','before' => 'auth','uses'=>'Backend\HomeController@getCategoriesIndex'));
    Route::post('categories/addnew',array('as'=>'addnew','before' => 'auth','uses'=>'Backend\HomeController@PostCategory'));
    Route::post('pages/addnew/{type?}',array('as'=>'adnewpage','before' => 'auth','uses'=>'Backend\HomeController@postAddPage'));

    Route::get('pages/editpage/{id}',array('as'=>'editpage','before' => 'auth','uses'=>'Backend\HomeController@getEditPage'));
    Route::post('pages/editpage/{id}',array('as'=>'editpage','before' => 'auth','uses'=>'Backend\HomeController@postEditPage'));
    Route::get('posts/index',array("as"=>"postslisting",'before' => 'auth','uses'=>'Backend\HomeController@getPostsList'));
    Route::get('posts/addnew', array('as'=>'addnewpost','before' => 'auth','uses'=>'Backend\HomeController@getAddPost'));
    Route::post('posts/addnew/{type?}', array('as'=>'adnewpost','before' => 'auth','uses'=>'Backend\HomeController@postAddPage'));
    Route::get('post/editpost/{id}',array('as'=>'editpost','before' => 'auth','uses'=>'Backend\HomeController@getEditPost'));
    Route::post('post/editpost/{id}',array('as'=>'editpostp','before' => 'auth','uses'=>'Backend\HomeController@postEditPage'));
    Route::get("menu/index",array("as"=>"menuhome",'before' => 'auth',"uses"=>"Backend\HomeController@getMenuHome"));
    Route::post("menu/index",array("as"=>"index",'before' => 'auth',"uses"=>'Backend\HomeController@postMenuHome'));

    Route::get("sliders/index",array("as"=>"slidehome",'before' => 'auth',"uses"=>"Backend\HomeController@getSlideHome"));
    Route::post("sliders/index/{type?}",array("as"=>"slidehome2",'before' => 'auth',"uses"=>"Backend\HomeController@postSlideHome"));


    Route::get("sliders/manageimages", array("as"=>'mimage','before' => 'auth', "uses"=>"Backend\HomeController@getSlideImages"));
    Route::post("sliders/manageimages/{type?}",array("as"=>'eimage','before' => 'auth',"uses"=>"Backend\HomeController@postSlideImages"));

    Route::get("administrators/index", array("as"=>'userlist','before' => 'auth',"uses"=>"Backend\UserController@getUserIndex"));
    Route::get("administrators/addnew", array("as"=>'useradd','before' => 'auth',"uses"=>"Backend\UserController@getAddUser"));
    Route::get("administrators/edituser/{id?}", array("as"=>'useredit','before' => 'auth',"uses"=>"Backend\UserController@getEditUser"));
    Route::post("administrators/edituser/{id?}", array("as"=>'useredit','before' => 'auth',"uses"=>"Backend\UserController@postEditUser"));
    Route::post("administrators/addnew", array("as"=>'useradd','before' => 'auth',"uses"=>"Backend\UserController@postAddUser"));
    Route::get("pageblocks/index",array("as"=>"pgblock",'before' => 'auth',"uses"=>"Backend\HomeController@getPageBlockIndex"));
    Route::get("pageblocks/addnew",array("as"=>"pgblockaddn",'before' => 'auth',"uses"=>"Backend\HomeController@getAddPageBlock"));
    Route::post("pageblocks/addnew/{id?}",array("as"=>"postpgblockadd",'before' => 'auth',"uses"=>"Backend\HomeController@postAddPageBlock"));
    Route::get("pageblocks/editpage/{id?}",array("as"=>"editpgblock",'before' => 'auth',"uses"=>"Backend\HomeController@getEditPageBlock"));
    Route::post("pageblocks/editpage/{id?}",array("as"=>"postpgblockedit",'before' => 'auth',"uses"=>"Backend\HomeController@postAddPageBlock"));
//08113022193

    Route::get("/settings",array("as"=>"settings","before"=>"auth","uses"=>"Backend\HomeController@getSettings"));
    Route::post("/settings",array("as"=>"settings","before"=>"auth","uses"=>"Backend\HomeController@postSettings"));


    Route::get("pcategory/index",array("as"=>"pcategory","before"=>"auth","uses"=>"Backend\CatalogueController@getCategoryIndex"));
    Route::get("pcategory/addnew",array("as"=>"addpcategory","before"=>"auth","uses"=>"Backend\CatalogueController@getCategoryAddNew"));
    Route::post("pcategory/addnew/{id?}",array("as"=>"postaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@postCategoryAddNew"));
    Route::get("pcategory/edit/{id?}",array("as"=>"editpcategory","before"=>"auth","uses"=>"Backend\CatalogueController@getCategoryEdit"));
    Route::post("pcategory/edit/{id?}",array("as"=>"postaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@postCategoryEdit"));


    Route::get("products/index",array("as"=>"prodindex","before"=>"auth","uses"=>"Backend\CatalogueController@getProductIndex"));
    Route::get("products/addnew/{id?}",array("as"=>"prodaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@getProductAddNew"));
    Route::post("products/addnew/{id?}",array("as"=>"postprodaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@postProductAddNew"));
    Route::get("products/edit/{id?}",array("as"=>"prodedit","before"=>"auth","uses"=>"Backend\CatalogueController@getProductEdit"));

    Route::get("brands/index", array("as"=>"brandlist","before"=>"auth","uses"=>"Backend\CatalogueController@getBrandIndex"));
    Route::get("brands/addnew/{id?}", array("as"=>"brandadd","before"=>"auth","uses"=>"Backend\CatalogueController@getBrandAddNew"));
    Route::post("brands/addnew/{id?}", array("as"=>"brandaddpost","before"=>"auth","uses"=>"Backend\CatalogueController@postBrandAddNew"));
    Route::get("brands/edit/{id?}", array("as"=>"brandedit","before"=>"auth","uses"=>"Backend\CatalogueController@getBrandEdit"));

    /*
     * Route for options setting
    */
    Route::get("options/index", array("as"=>"optionlist","before"=>"auth","uses"=>"Backend\CatalogueController@getOptionIndex"));
    Route::get("options/addnew/{id?}", array("as"=>"optionadd","before"=>"auth","uses"=>"Backend\CatalogueController@getOptionAddNew"));
    Route::post("options/addnew/{id?}", array("as"=>"optionaddpost","before"=>"auth","uses"=>"Backend\CatalogueController@postOptionAddNew"));
    Route::get("options/edit/{id?}", array("as"=>"optionedit","before"=>"auth","uses"=>"Backend\CatalogueController@getOptionEdit"));

    /**
     *Route for sales group
     */

    Route::get("sales/customers/index", array("as"=>"cuslist","before"=>"auth","uses"=>"Backend\SalesController@getCustomerIndex"));
    Route::get("sales/customers/add/{id?}", array("as"=>"cusadd","before"=>"auth","uses"=>"Backend\SalesController@getCustomerAdd"));
    Route::post("sales/customers/add/{id?}", array("as"=>"cusaddpost","before"=>"auth","uses"=>"Backend\SalesController@postCustomerAdd"));
    Route::get("sales/customers/edit/{id?}", array("as"=>"cusedit","before"=>"auth","uses"=>"Backend\SalesController@getCustomerEdit"));


    Route::get("sales/orders/index", array("as"=>"ordlist","before"=>"auth","uses"=>"Backend\SalesController@getOrderIndex"));
    Route::post("sales/orders/index", array("as"=>"postordlist","before"=>"auth","uses"=>"Backend\SalesController@postOrderIndex"));
    Route::get("sales/orders/add/{id?}", array("as"=>"ordadd","before"=>"auth","uses"=>"Backend\SalesController@getOrderAdd"));
    Route::post("sales/orders/add/{id?}", array("as"=>"ordaddpost","before"=>"auth","uses"=>"Backend\SalesController@postOrderAdd"));
    Route::get("sales/orders/edit/{id?}", array("as"=>"ordedit","before"=>"auth","uses"=>"Backend\SalesController@getOrderEdit"));

    //End of sales groping route

});


//Route::get('backend/login', 'AuthController@getLogin');
Route::get('login/{target?}',array("as"=>"login","uses"=>'AuthController@getLogin'));
Route::get('account/login/{target?}',array("as"=>"accountlogin","uses"=>'AuthController@getAccountLogin'));
Route::post('account/login/{target?}',array("as"=>"acc_log","uses"=>'Account\AuthController@postAccountLogin') );
//Route::post('login', 'AuthController@postLogin');
Route::post('login/{target?}', 'AuthController@postLogin');
Route::get('logout', array("as"=>"logout","uses"=>'AuthController@getLogout'));
Route::get('logout2', array("as"=>"logout2","uses"=>'AuthController@getAccountLogout'));
Route::post('forgot_password', 'AuthController@postForgotPassword');
Route::get('reset_password/{id}/{token}/{target?}', 'AuthController@getResetPassword');
Route::post('reset_password', 'AuthController@postResetPassword');