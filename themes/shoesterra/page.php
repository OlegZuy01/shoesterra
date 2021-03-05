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
    <section class="page-section no-padding-top with-sidebar">
        <div class="container">
            <div class="row">
  
                <!-- content -->
                <section id="content" class="content col-sm-8 col-md-12">
					<h1><?=get_the_title()?></h1>
					
					 <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>" alt="" style="width: auto;max-width: 500px;">
					
					<?php if (have_posts()): while (have_posts()): the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</section>
			
			</div>
		</div>
	</section>


<?php get_footer(); ?>