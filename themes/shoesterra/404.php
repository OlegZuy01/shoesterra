<?php get_header();
function header_content() { ?>
	<div class="head-wrap" style="background:url('<?=get_field('backgr-404','option')?>') 50% 50%; background-size:cover;">
			<div class="head-opac"></div>
			<h1>Страница не найдена</h1>
			<div class="bread-wrap">
				<? breadcrumbs(); ?>
			</div>
			</div>
<? }

?>
<link rel='stylesheet' id='js_composer_front-css'  href='http://stix.tid24.ru/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=4.11.2.1' type='text/css' media='all' />
<div class="container">
<div class="vc_row">
	<div class="vc_col-sm-12">
		<p style="text-align:center">Страница, которую Вы запрашиваете, не может быть найдена.</p>
		<div class="sep-list sep-list-center"><img src="/wp-content/themes/stix/images/leaf.png"></div>
	</div>
</div>
</div>

<?php get_footer(); ?>