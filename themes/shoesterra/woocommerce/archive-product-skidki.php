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
	
    <section class="page-section with-sidebar no-padding-top">
        <div class="container">
            <div class="row">
				<header class="woocommerce-products-header col-sm-12 col-md-12">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
				</header>
			</div>
			<!-- content -->
            <div class="row">
				<aside class="sidebar col-sm-4 col-md-3">
					<?php dynamic_sidebar( 'widgets-product-listing' ); ?>
				</aside>
				<section class="content col-sm-8 col-md-9">
					<div class="row thumbnails products latest-products">
						<div class="wcapf-before-products">
						<? 
						echo do_shortcode('[sale_products columns="3"]');	
						?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</section>
	
	<div class="section-separator"><i></i></div>
	
	<?php get_footer( 'shop' ); ?>
