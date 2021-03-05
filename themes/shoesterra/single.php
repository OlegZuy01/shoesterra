<?php get_header();?>
<div class="content-area">
    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs">
        <div class="container">
            <? breadcrumbs(); ?>
        </div>
    </section>
    <!-- /BREADCRUMBS -->
<? the_post(); ?>

<section class="page-section no-padding-top with-sidebar">
        <div class="container">
            <div class="row">
	            <div class="col-sm-12">
                    <article class="post-wrap">
                        <div class="row">
                            <div class="post-media col-xs-12 col-sm-6 col-md-6">
                                <div class="post-type"><i class="fa fa-picture-o"></i></div>
                                <div class="thumbnail no-border no-padding">
                                    <div class="media">
                                        <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
	                            <div class="post-header">
	                                <div class="post-meta"><?=get_The_date('j F Y')?></div>
	                                <h1 class="post-title"><?=get_the_title()?></h1>
	                            </div>
	                            <div class="post-body">
	                                <div class="post-excerpt"><?=get_the_content()?></div>
	                            </div>
                            </div>
                        </div>
                    </article>
                </div>
                <? wp_reset_query();?>
                <section class="latest-blog col-md-12">
					<div class="h2-center mb30">
					<h2>Последние статьи</h2>
					</div>
					<? $args = array(
					'child_of'     => 0,
					'parent'       => '',
					'orderby'      => 'menu_order',
					'order'        => 'ASC',
					'posts_per_page' => 4,
				);
				
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) { ?>
				<div class="row">
                    <? while ( $query->have_posts() ) {
					$query->the_post();?>
                        <article class="post-wrap col-md-3">
	                            <div class="post-media">
	                                <div class="post-type"><i class="fa fa-picture-o"></i></div>
	                                <div class="thumbnail no-border no-padding">
	                                    <div class="media">
	                                        <a class="media-link" href="<?=get_permalink()?>">
	                                            <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>" alt="">
	                                            <i class="fa fa-plus"></i>
	                                        </a>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="post-header">
	                                <div class="post-meta"><?=get_The_date('j F Y')?></div>
	                                <h2 class="post-title"><a href="<?=get_permalink()?>"><?=get_the_title()?></a></h2>
	                            </div>
	                            <div class="post-body">
	                                <div class="post-excerpt"><?=get_the_excerpt()?></div>
	                            </div>
                        </article>
						<? } ?>
                </div>
				<? } ?>
				<div class="vc_row navig">
					<div class="vc_col-sm-12">
						<? the_posts_pagination( array(
							'prev_text' => __( 'Назад', 'package-underscores' ),
							'next_text' => __( 'Вперед', 'package-underscores' ),
							'end_size' => 2,
						) ); ?>
						<? wp_reset_query();?>
					</div>
				</div>
				</section>
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
        </div>
</section>


<?php get_footer(); ?>