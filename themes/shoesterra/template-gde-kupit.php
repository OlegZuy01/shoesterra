<?/*Template Name: Где купить*/?>

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
				<?if( have_rows('shops') ):?>
				<div class="col-xs-12"><h1><?=get_the_title()?></h1></div>
				<?while ( have_rows('shops') ) : the_row();?>
				<div class="col-xs-12 col-md-3">
					<div class="alert alert-success">
						<h4><strong><?the_sub_field('shop_address');?></strong></h4>
						<h4><b>Режим работы:</b><br><?the_sub_field('shop_worktime');?></h4>
						<h4><b>Телефоны:</b>
							<?if (have_rows('shop_phones')){
								while (have_rows('shop_phones')){ the_row();?>
									<br><?the_sub_field('shop_phone');?>
								<?}?>
							<?}?>
						</h4>
					</div>
				</div>
				<?endwhile;?>
				<div class="col-xs-12 col-md-3"></div>
			    <div class="col-xs-12 col-md-3">
				    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A785c291c35a993b7de196a95779f06a151bb1803ed44171121f19624e8729319&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
				<div class="col-xs-12 col-md-3"></div>
				<?endif;?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>