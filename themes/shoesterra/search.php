<?php get_header();
function header_content() { 
	?>
	<div class="head-wrap" style="background:url('<?=get_field('backgr-search','option')?>') 50% 50%; background-size:cover;">
			<div class="head-opac"></div>
			<h1>Результаты поиска</h1>
			<div class="bread-wrap">
				<? breadcrumbs(); ?>
			</div>
	</div>
<? } ?>
<link rel='stylesheet' id='js_composer_front-css'  href='http://stix.tid24.ru/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=4.11.2.1' type='text/css' media='all' />
<div class="container">
	<div class="vc_row side7">
		<?
		$i = 1;
		while(have_posts()) :
		the_post();
		?>
		<div class="vc_col-sm-4 wrap-prod wrap-prod-search">
	<a href="<?=get_permalink()?>">
		<div class="prod-in-catal">
			<img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>">
			<p class="artikul">Артикул <?=get_field('artikul')?></p>
			<p class="long-name"><?=get_the_title()?></p>
			<p class="short-name"><?=get_field('short-title')?></p>
		</div>
	</a>
</div>
<?
if ($i%3 == 0) {?>
	<div style="width: 100%;float: left;"></div>
<? } $i++;
 endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>