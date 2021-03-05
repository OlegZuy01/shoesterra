<?php get_header();
the_post(); ?>
<div class="container">
	<!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs">
        <div class="container">
            <? breadcrumbs(); ?>
        </div>
    </section>
    <!-- /BREADCRUMBS -->
	<div class="row">
		<div class="col-sm-12 h1-center">
			<h1><?=get_the_title()?></h1>
			<h3><?=get_field('sroki')?></h3>
		</div>
		<div class="col-sm-6 col-xs-12 img-center">
			<img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full')?>">
		</div>
		<div class="col-sm-6 col-xs-12">
			<? the_content(); ?>
		</div>
	</div>
	<div class="latest-blog row">
		<div class="col-md-12 h2-center">
			<h2>Другие акции</h2>
		</div>
		<? wp_reset_query();
		$args = array(                 
                        'post_type' => 'akcii',
                        'order'     => 'DESC',
                        'orderby'   => 'date',
                        'posts_per_page' => 3,
                     );

            $wp_query = new WP_Query( $args );
      
        if ( $wp_query -> have_posts() ) : ?><div class="margb"><?while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
?>
            		<div class="col-md-4 col-sm-4 col-xs-12">
                        <article class="post-wrap">
                            <div class="post-media">
                                <div class="post-type"><i class="fa fa-picture-o"></i></div>
                                <div class="thumbnail no-border no-padding">
                                    <div class="media">
                                        <a class="media-link" href="<?=get_permalink()?>">
                                            <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'shop_single')?>" alt="">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
									<div class="countdown-wrapper">
                                        <div id="dealCountdown<?echo ($i);?>" class="defaultCountdown clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-header">
                                <?/*<div class="post-meta"><?=get_The_date('j F Y')?></div>*/?>
                                <h2 class="post-title"><a href="<?=get_permalink()?>"><?=get_the_title()?></a>
                                <span class="sroki"><?=get_field('sroki')?></span></h2>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt"><?=get_the_excerpt()?></div>
                            </div>
                        </article>
                    </div>
          <?
        endwhile;?></div><? endif;
        wp_reset_query();
         ?>
	</div>
	<div class="latest-blog row">
		<div class="col-md-12 h2-center">
			<h2>Скидки</h2>
		</div>
	</div>
	<div class="row thumbnails products">
		<? echo do_shortcode('[sale_products per_page="3" columns="3" orderby="rand"]'); ?>
	</div>
	<div class="latest-blog row">
		<div class="col-md-12 h2-center">
			<h2>Новинки</h2>
		</div>
	</div>
	<div class="row thumbnails products">
		<? echo do_shortcode('[product_category per_page="3" columns="3" category="novinki"]'); ?>
	</div>
	<div style="height:50px"></div>
</div>

<?php get_footer(); ?>