<?php get_header();
function header_content() { 
	$n = single_term_title('',0);
	$mass = get_term_by('name', $n, 'categorys', 'ARRAY_A');
	global $catid_main;
	$catid_main = $mass['term_id'];

	$img_ID = get_field('img-cat','categorys_'.$catid_main);
	if ($img_ID) {
		$img_info = wp_get_attachment_image_src($img_ID, 'large');
		$img_link = $img_info[0];
	} else {
		$img_link = get_field('backgr-catalog','option');
	}
	?>
	<div class="head-wrap" style="background:url('<?=$img_link?>') 50% 50%; background-size:cover;">
			<div class="head-opac"></div>
			<h1><?=$n?></h1>
			<div class="bread-wrap">
				<? breadcrumbs(); ?>
			</div>
			</div>
<? }
$tch = _get_term_hierarchy('categorys');
?>
<link rel='stylesheet' id='js_composer_front-css'  href='http://stix.tid24.ru/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=4.11.2.1' type='text/css' media='all' />
<div class="container">
	<div class="vc_row">
		<div class="vc_col-sm-2"></div>
		<div class="vc_col-sm-8 cat-desc">
			<?=category_description($catid_main)?>
		</div>
		<div class="vc_col-sm-2"></div>
	</div>
	<div class="vc_row side7">
		<div class="vc_col-sm-3">
		<ul class="list-cat">
<?
$arg = array(
	'type' => 'catalog',
	'taxonomy' => 'categorys',
	'hide_empty'   => 0,
	'orderby'   => 'menu_order',
	'order'     => 'ASC',
	'parent' => '0'
);
$cats = get_categories($arg);
foreach ($cats as $cat) {
	$catid = $cat->cat_ID;
	$cl='';
	if ($catid == $catid_main) $cl=' active';
	$zapis = '';
	if ($catid == 22) $zapis='<ul><li class="children"><a href="#ppkf" class="zapis">Записаться на обучение</a></li></ul>';
	if ($catid == 27) $zapis='<ul><li class="children"><a href="#pkdl" class="zapis">Записаться на обучение</a></li></ul>';
?>
	<li class="parents<?=$cl?>"><a href="<?=get_term_link($catid)?>"><?=$cat->cat_name?></a>
	<? if ( $tch[$catid] ) {
		$arg = array(
				'type' => 'catalog',
				'taxonomy' => 'categorys',
				'hide_empty'   => 0,
				'orderby'   => 'menu_order',
				'order'     => 'ASC',
				'parent' => $catid
			);
		$cats_ch = get_categories($arg);
		echo "<ul>";
		foreach ($cats_ch as $children) {
			$catid_ch = $children->cat_ID;
			$cl='';
			$pud='';
			if ($catid_ch == $catid_main) $cl=' active';
			if ( $tch[$catid_ch] ) $pud = '<i class="par_ch_up"></i>';
			echo '<li class="children'.$cl.'"><a href="'.get_term_link($catid_ch).'">'.$children->cat_name.'</a>'.$pud;
				if ( $tch[$catid_ch] ) {
					$arg = array(
							'type' => 'catalog',
							'taxonomy' => 'categorys',
							'hide_empty'   => 0,
							'orderby'   => 'menu_order',
							'order'     => 'ASC',
							'parent' => $catid_ch
						);
					$cats_ch_ch = get_categories($arg);
					echo "<ul class='children_ch'>";
					foreach ($cats_ch_ch as $children_ch) {
						$catid_ch_ch = $children_ch->cat_ID;
						$cl='';
						if ($catid_ch_ch == $catid_main) $cl=' active';
						echo '<li class="children_ch'.$cl.'"><a href="'.get_term_link($catid_ch_ch).'">'.$children_ch->cat_name.'</a>';
						
						echo '</li>';
					}
					echo "</ul>";
				}
			echo '</li>';
		}
		echo "</ul>";
	} 
	echo $zapis; ?>
	</li>
<? } ?>
</ul>
		</div>
		<div class="vc_col-sm-9 no-pad">
			<div class="vc_row">
				<?
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array( 
					'post_type' => 'catalog',
					'posts_per_page' => '10',
					'orderby'   => 'menu_order',
					'order'     => 'ASC',
					'paged' => $paged,
					'tax_query' => array( 
						 array( 
						'taxonomy' => 'categorys', 
						'field' => 'id', 
						 'terms' => $catid_main
						 ) 
					 	) 
					 ); 
					query_posts( $args );
					$i = 1;
					while(have_posts()) :
the_post();
?>
<div class="vc_col-sm-6 wrap-prod">
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
if ($i%2 == 0) {?>
	<div style="width: 100%;float: left;"></div>
<? } $i++;
 endwhile; ?>
			</div>
			<div class="vc_row navig nav-tax">
				<div class="vc_col-sm-12">
					<? paging_nav(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>