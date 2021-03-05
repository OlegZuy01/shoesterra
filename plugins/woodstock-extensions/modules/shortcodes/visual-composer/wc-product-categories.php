<?php

// [product_categories]

vc_map(array(
   "name"			=> "Product Categories - Thumbs",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "product_categories",
   "class"			=> "",
   "icon"			=> "product_categories",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "How many product categories to display?",
			"param_name"	=> "number",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Columns",
			"param_name"	=> "columns",
			"value"			=> "",
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