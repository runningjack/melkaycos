<?php

//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);
/*navigation array config
ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_self",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)
*/
$page_nav = array(
	"dashboard" => array(
		"title" => "Dashboard",
		"url" => '/melkay/public/backend/dashboard/index',
		"icon" => "fa-home"
	),
	"pages" => array(
		"title" => "Pages",
		"icon" => "fa-code",
		"sub" => array(
			"list" => array(
				"title" => "All Pages",
				"url" => '/melkay/public/backend/pages/index'
			),
			"addnew" => array(
				"title" => "Add New",
				"url" => '/melkay/public/backend/pages/addnew'
			)
		)
	),
	"posts" => array(
		"title" => "Posts",
		"icon" => "fa-bar-chart-o",
		"sub" => array(
			"list" => array(
				"title" => "All Post",
				"url" => '/melkay/public/backend/posts/index',

			),
			"addnew" => array(
				"title" => "Add New",
				"url" => '/melkay/public/backend/posts/addnew'
			),
            "categories" => array(
                "title" => "All Categories",
                "url" => "/melkay/public/backend/categories/index"
            )
		)
	),
    "catalogue"=>array(
        "title"=>"Catalogue",
        "icon"=>"fa-shopping-cart",
        "sub"=>array(
            "category"=>array(
                "title"=>"Categories",
                "icon"=>"fa-columns",
                "sub"=>array(
                    "list"=>array(
                        "title"=>"Category Listing",
                        "icon"=>"fa-list-ol",
                        "url"=>"/melkay/public/backend/pcategory/index",
                    ),
                    "addnew"=>array(
                        "title"=>"Add New",
                        "icon"=>"fa-plus",
                        "url"=>"/melkay/public/backend/pcategory/addnew"
                    )
                )
            ),
            "product"=>array(
                "title"=>"Products",
                "icon"=>"fa-cubes",
                "sub"=>array(
                    "list"=>array(
                        "title"=>"Product Listing",
                        "icon"=>"fa-list-ol",
                        "url"=>"/melkay/public/backend/products/index",
                    ),
                    "addnew"=>array(
                        "title"=>"Add New",
                        "icon"=>"fa-plus",
                        "url"=>"/melkay/public/backend/products/addnew"
                    )
                )
            ),
            "brand"=>array(
                "title"=>"Brands",
                "icon"=>"fa-square",
                "sub"=>array(
                    "list"=>array(
                        "title"=>"Brand Listing",
                        "icon"=>"fa-list-ol",
                        "url"=>"/melkay/public/backend/brands/index",
                    ),
                    "addnew"=>array(
                        "title"=>"Add New",
                        "icon"=>"fa-plus",
                        "url"=>"/melkay/public/backend/brands/addnew"
                    )
                )
            ),
            "option"=>array(
                "title"=>"Options",
                "icon"=>"fa-columns",
                "sub"=>array(
                    "list"=>array(
                        "title"=>"Option Listing",
                        "icon"=>"fa-list-ol",
                        "url"=>"/melkay/public/backend/options/index"
                    ),
                    "addnew"=>array(
                        "title"=>"Add New",
                        "icon"=>"fa-plus",
                        "url"=>"/melkay/public/backend/options/addnew"
                    )
                )
            )
        )
    ),
	"frontend" => array(
		"title" => "Frontend",
		"icon" => "fa-windows",
		"sub" => array(
			"slideshow" => array(
		        "title" => "Slide Show",
		        "icon" => "fa-file",
		        "sub" => array(
		            "list" => array(
		                "title" => "All Slides",
		                "url" => "/melkay/public/backend/sliders/index"
		            ),
		            "slideimage" => array(
		                "title" => "Manage Slide Image",
		                "url" => "/melkay/public/backend/sliders/manageimages"
		            )
		        )
		    ),
            "menu" => array(
				"title" => "Manage Frontend Menu",
				"url" => "/melkay/public/backend/menu/index"
			),
            "preview" => array(
				"title" => "Preview Website",
				"url" => "/melkay/public"
			),
            "pageblock"=>array(
                "title"=>"Page Blocks",
                "url"=>"/melkay/public/backend/pageblocks/index"
            )
		)
	),
    "admin"=>array(
        "title"=>"Administrator",
        "icon"=>"fa-users",
        "sub"=>array(
            "list"=>array(
                "title"=>"Admin Listing",
                "url"=>"/melkay/public/backend/administrators/index"
            ),
            "addnew"=>array(
                "title"=>"Add New",
                "url"=>"/melkay/public/backend/administrators/addnew"
            )
        )
    ),
    "setting"=>array(
        "title"=>"Settings",
        "icon"=>"fa-wrench",
        "url"=>"/melkay/public/backend/settings"
    )
);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>