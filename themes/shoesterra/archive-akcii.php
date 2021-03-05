<?php get_header(); ?>
<div class="content-area">
    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs">
        <div class="container">
            <? breadcrumbs(); ?>
        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <!-- Контент -->
    <section class="page-section no-padding-top with-sidebar">
        <div class="container">
            <div class="row">
                <!-- content -->
                <section class="latest-blog col-sm-8 col-md-12">
					<h1>Акции</h1>
					<? $args = array(
					'post_type' => 'akcii',
					'child_of'     => 0,
					'parent'       => '',
					'orderby'      => 'menu_order',
					'order'        => 'ASC',
					'posts_per_page' => -1,
				);
				
				$query = new WP_Query( $args );
				$i = 1;
				if ( $query->have_posts() ) { ?>
				<div class="row">
                    <? while ( $query->have_posts() ) {
					$query->the_post();?>
					<div class="col-md-4 col-sm-4 col-xs-12">
                        <article class="post-wrap">
                            <div class="post-media">
							<div class="thumbnail no-border no-padding">
                                    <div class="media">
                                        <a class="media-link" href="<?=get_permalink()?>">
                                            <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'shop_single')?>" alt="">
                                            <i class="fa fa-plus"></i>
                                        </a>
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
						$i++;
						} ?>
                </div>
				<? } ?>
				</section>
			</div>
		</div>
	</section>
	<div class="section-separator"><i></i></div>

<?php get_footer(); ?>