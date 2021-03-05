<?php
	/**
		* The Template for displaying product archives, including the main shop page which is a post type archive
		*
		* This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
		*
		* HOWEVER, on occasion WooCommerce will need to update template files and you
		* (the theme developer) will need to copy the new files to your theme to
		* maintain compatibility. We try to do this as little as possible, but it does
		* happen. When this occurs the version of the template file will be bumped and
		* the readme will list any important changes.
		*
		* @see 	    https://docs.woocommerce.com/document/template-structure/
		* @author 		WooThemes
		* @package 	WooCommerce/Templates
		* @version     2.0.0
	*/

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

get_header( 'shop' ); ?>
<div class="content-area">
	<!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs">
        <div class="container">
            <? breadcrumbs(); ?>
            
		</div>
	</section>
    <!-- /BREADCRUMBS -->
    <?php
		$category = get_queried_object();
		$cat_id = $category->term_id;
		if($cat_id == 335) {
			include('brands.php');
		} else {
			include('products.php');
		}
    ?>



	<?php get_footer( 'shop' ); ?>
