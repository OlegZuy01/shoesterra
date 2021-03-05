<?php get_header();?>
<div class="content-area">
	
    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs">
        <div class="container">
            <? breadcrumbs(); ?>
		</div>
	</section>
    <!-- /BREADCRUMBS -->
	
    <!-- Контент -->
    <section class="page-section no-padding-top with-sidebar brands">
        <div class="container">
	        <div class="row">
				<div class="col-xs-12"><h1>Бренды</h1></div>
				<div class="col-xs-12">

				    
	<?$args = array(                 
				'post_type' => 'brands',
				'order'     => 'ASC',
				'orderby'   => 'menu_order',
				'posts_per_page' => -1
				);
				
				$wp_query = new WP_Query( $args );
				if ( $wp_query -> have_posts() ) {?>
				<?while ( $wp_query -> have_posts() ) {
					$wp_query -> the_post();?>
					<div class="col-md-3 single_brand"><a href="<?=get_permalink();?>"><img src="<?=get_the_post_thumbnail_url();?>" alt=""></a></div>
				<?} }
				wp_reset_query(); ?> 
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>