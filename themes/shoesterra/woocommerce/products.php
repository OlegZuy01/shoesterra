<section class="page-section with-sidebar no-padding-top">
        <div class="container">
            <div class="row">
				<header class="woocommerce-products-header col-sm-12 col-md-12">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
				</header>
			</div>
			<div class="row" style="display: flex;">
                <div class="sidebar-mob-btn filter-btn">Фильтрация товаров</div>
            </div>
			<!-- content -->
            <div class="row">
				<aside class="sidebar col-sm-4 col-md-3">
				    <? include('filter.php')?>
					<?php //dynamic_sidebar( 'widgets-product-listing' ); ?>
				</aside>
				<section class="content col-sm-8 col-md-9">
					<div class="row thumbnails products latest-products">
						<?php if ( have_posts() ) : ?>
						
						<?php
							/**
								* woocommerce_before_shop_loop hook.
								*
								* @hooked wc_print_notices - 10
							*/
							do_action( 'woocommerce_before_shop_loop' );
						?>
						<?php while ( have_posts() ) : the_post(); ?>
						
						<?
						global $product;
						$inStock = true;
						if ( $product->is_type( 'variable' ) ) {
                        	$variations = $product->get_available_variations();
                        	foreach($variations as $key => $value){
                                if ($value['is_in_stock'] > 0){
                                    $inStock = true;
                                    continue;
                                }
                            }
                        } else {
                            $inStock = true;
                        }
                        
                        if($inStock){?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
						<?}?>
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
		<div class="container">
		    <div class="row cat-text">
	            <?php do_action( 'woocommerce_archive_description' ); ?>
		    </div>
		</div>
	</section>
  
	<div class="section-separator"><i></i></div>