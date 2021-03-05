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
					<h1 class="post-title"><?=get_the_title()?></h1>
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
						<?php if ( have_posts() ) : ?>
						
						<?php
							/**section-separator
								* woocommerce_before_shop_loop hook.
								*
								* @hooked wc_print_notices - 10
							*/
							do_action( 'woocommerce_before_shop_loop' );
						?>


                        <?php echo do_shortcode("[product_attribute attribute='proizvoditel' filter='".get_the_title()."']"); ?>


						
						<?php while ( have_posts() ) : the_post(); ?>
						
						<?php wc_get_template_part( 'content', 'product' ); ?>
						
						<?php endwhile; // end of the loop. ?>
						
						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
						
						<?php
							/**
								* woocommerce_no_products_found hook.
								*
								* @hooked wc_no_products_found - 10
							*/
							do_action( 'woocommerce_no_products_found' );
						?>
						
						<?php endif; ?>
						
					</div>
					
					
					
					<?php wp_pagenavi(); ?>
						
						
				</section>
			

			</div>
		</div>
	</section>
	
		<section>
		    <div class="container">
		         <div class="row text-brands">
		             <div class="post-media">
                                <div class="thumbnail no-border no-padding">
                                    <div class="media">
                                        <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>" alt="">
									</div>
								</div>
							</div>
				        <div class="post-excerpt"><?=get_the_content()?></div>
				    </div>
		    </div>
				</section>
	
	<div class="section-separator"><i></i></div>
	
	<?php get_footer( 'shop' ); ?>
