<?php

// [product_categories_grid]

vc_map(array(
   "name"			=> "Product Categories - Grid",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "product_categories_grid",
   "class"			=> "",
   "icon"			=> "product_categories_grid",
   //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "How many product categories to display?",
			"param_name"	=> "number",
			"value"			=> 9,
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order By",
			"param_name"	=> "orderby",
			"value"			=> array(
				'',
				__( 'Date', 'js_composer' ) => 'date',
				__( 'ID', 'js_composer' ) => 'ID',
				__( 'Author', 'js_composer' ) => 'author',
				__( 'Title', 'js_composer' ) => 'title',
				__( 'Modified', 'js_composer' ) => 'modified',
				__( 'Random', 'js_composer' ) => 'rand',
				__( 'Comment count', 'js_composer' ) => 'comment_count',
				__( 'Menu order', 'js_composer' ) => 'menu_order',
			),
			"std"			=> "title",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order",
			"param_name"	=> "order",
			"value"			=> array(
				__( 'Descending', 'js_composer' ) => 'DESC',
				__( 'Ascending', 'js_composer' ) => 'ASC',
			),
			"std"			=> "DESC",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Hide Empty",
			"param_name"	=> "hide_empty",
			"value"			=> array(
				"Yes"	=> "1",
				"No"	=> "0"
			),
			"std"			=> "1",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Parent",
			"description"	=> "Set the parent paramater to 0 to only display top level categories.",
			"param_name"	=> "parent",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "IDs",
			"description"	=> "Set ids to a comma separated list of category ids to only show those.",
			"param_name"	=> "ids",
			"value"			=> "",
		),
   )
   
));