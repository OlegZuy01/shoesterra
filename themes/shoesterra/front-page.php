<? get_header(); ?>

<!-- Контент -->
<div class="content-area">
	<?if(have_rows('slider')){?>
		<div id="main">
			<!-- Слайдер -->
			<section class="page-section no-padding">
				<div class="container full-width">
					<div id="main-slider" class="owl-carousel owl-theme">
						<? while(have_rows('slider')){?>
							<?the_row();?>
							<div class="item page slide1">
								<a href="<?=the_sub_field('slider_link'); ?>" class="slide-img" style="display:block;background-image:url(<?=the_sub_field('slide'); ?>)">
									<div class="caption">
										<div class="container">
											<div class="div-table">
												<div class="div-cell">
													<?if(get_sub_field('slide_title') || get_sub_field('slide_desc')){?>  
														<div class="caption-content" style="margin:0;display:none">
															<?/*if(get_sub_field('slide_title')){?>
																<div class="caption-title">
																	<?=the_sub_field('slide_title');?>
																</div>
															<?}?>
															<?if(get_sub_field('slide_desc')){?>
																<div class="caption-subtitle"><?=the_sub_field('slide_desc'); ?></div>
															<?}*/?>
															<?/*if(get_sub_field('slider_link')){?>
																<p class="caption-text">
																	<a href="<?=the_sub_field('slider_link'); ?>">Перейти в каталог</a>
																</p>
															<?}*/?>
														</div>
													<?}?>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						<?}?>
					</div>
				</div>
			</section>
			<!-- /Слайдер -->
		</div>
	<?}?>

	<section class="page-section color sm-padding">
		<div class="container">
			<div class="text-banner" style="color: #f7e9ae;font-size: 27px;margin-bottom:0;">
				<h1 class="relative" style="color: #f7e9ae;font-size: 27px;margin-bottom:0;margin-top:0;"><?=get_field('slogan');?></h1>
			</div>
		</div>
	</section>

	<!-- Категории -->
	<section class="page-section light" id="category">
		<div class="container">

			<?if (get_field('catalog_title')):?>
			<h2 class="section-title"><?=the_field('catalog_title');?><small><?=the_field('catalog_subtitle');?></small>
			</h2>
			<?endif;?>

			<div class="clearfix text-center front-collections">
			<!--	<ul class="filtrable clearfix">
					<li><a href="/product-category/zhenskaja-obuv/">Женская обувь <img src="https://shoesterra.by/wp-content/themes/shoesterra/img/img_cat/woman_botik.jpg"></a></li>
					<li><a href="/product-category/muzhskaja-obuv/">Мужская обувь</a></li>
					<li><a href="/product-category/sale/">Скидки</a></li>
					<li><a href="/product-category/novinki/">Новинки</a></li>
				</ul>-->
				
				<div class="col-md-6 item_category">
					<a class="filtrable_items" href="/product-category/zhenskaja-obuv/">
						<!--<span>Женская обувь</span>-->
						<div style="background:url(https://shoesterra.by/wp-content/uploads/2020/04/women1.jpg) 50% 70% / cover">
							<div class="title_itm">Женская обувь</div>
							<div class="hidde_capt">
								<div>Коллекция женской обуви</div>
								<p>Смотреть</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 item_category">
					<a class="filtrable_items" href="/product-category/muzhskaja-obuv/">
						<!-- <span>Мужская обувь</span>-->
						<div style="background:url(https://shoesterra.by/wp-content/uploads/2020/04/man1.jpg) 50% 50% / cover">
							<div class="title_itm">Мужская обувь</div>
							<div class="hidde_capt">
								<div>Коллекция мужсой обуви</div>
								<p>Смотреть</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 item_category">
					<a class="filtrable_items" href="/product-category/sale/">
						<!--<span>Скидки</span>-->
						<div style="background:url(https://shoesterra.by/wp-content/uploads/2020/04/skidki1.jpg) 50% 50% / cover">
							<div class="title_itm">Скидки</div>
							<div class="hidde_capt">
								<div>Наши скидки</div>
								<p>Смотреть</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 item_category">
					<a class="filtrable_items" href="/product-category/novinki/">
						<!--<span>Новинки</span>-->
						<div style="background:url(https://shoesterra.by/wp-content/uploads/2020/04/new1.jpg) 50% 50% / cover">
							<div class="title_itm">Новинки</div>
							<div class="hidde_capt">
								<div>Наши новинки</div>
								<p>Смотреть</p>
							</div>
						</div>
					</a>
				</div>
				
				
				
			</div>

			<div class="row thumbnails products category latest-products">
				<?=do_shortcode('[product_category per_page="8" columns="4" category="zhenskaja-obuv, muzhskaja-obuv" orderby="rand"]')?>
			</div>

		</div>
	</section>
	<!-- /Категории -->

	<!-- Услуги\предложения -->
	<section class="page-section instagram" id="features">
	    <h2 class="section-title">instagram</h2>
	     <? echo do_shortcode('[instagram-feed]'); ?>
	</section>
	<section class="page-section" id="features">
		<div class="container">

			<!-- предложения -->

			<h2 class="section-title">О компании</h2>

			<? if(get_field('about')): ?>
			<div class="media-body">
				<?=the_field('about');?>
			</div>
			<? endif; ?>

		</div>
		
	</section>
	  
    <section class="container" style="margin:0 auto;float:none">
        <div style="width:100%" class="map-container">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A785c291c35a993b7de196a95779f06a151bb1803ed44171121f19624e8729319&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
        <style>
        .map-container > ymaps{
                    width:100%;
                }
            @media(max-width:550px){
                
                /*.map-container > ymaps > ymaps{*/
                /*    width:100% !important;*/
                /*}*/
            }
        </style>
        </div>		    
    </section>
				
	<!-- /Услуги\предложения -->
    
	<!-- Акции -->
	<section class="page-section no-padding image promotions" id="promotions">
		<div class="container full-width">

			<div id="promotions-slider" class="owl-carousel owl-theme promotions-slider">
				<? if(get_field('slider_akcia')): ?>
				<?$i = 1;?>
				<? while(the_repeater_field('slider_akcia')): ?>
				<div class="item slide<?=$i;?>">
					<div class="container">
						<img class="slide-img" src="<? the_sub_field('akcia_image'); ?>" alt="slide1">
						<div class="caption">
							<div class="div-table">
								<div class="div-cell">
									<div class="caption-content">
										<div class="caption-title">Внимание акция!</div>
										<div class="caption-price">
											<? the_sub_field('akcia_title'); ?>
										</div>
										<p class="caption-text">
											<? the_sub_field('akcia_desc'); ?>
										</p>
										<div><a class="btn btn-theme" href="shop.html">Заказать сейчас!</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<? $i++; ?>
				<? endwhile; ?>
				<? endif; ?>
			</div>

		</div>
	</section>

	<!-- /Акции -->
	<section class="page-section latest-blog no-padding-bottom">
		<div class="container">
			<? $args = array(
				'post_type' => 'news',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'date',
				'order'        => 'DESC',
				'posts_per_page' => 4,
				);
				
				$query = new WP_Query( $args );
				
			if ( $query->have_posts() ) { ?>
			<h2 class="section-title">Новости сайта</h2>
			<div class="row">
				<? while ( $query->have_posts() ) {
					$query->the_post();?>
				<div class="col-md-3 col-sm-6">
					<article class="post-wrap">
						<div class="post-media">
							<div class="thumbnail no-border no-padding">
								<div class="media">
									<a class="media-link" href="<?=get_permalink()?>">
										<div class="single-news-img" style="background:url(<?=get_the_post_thumbnail_url(get_the_ID())?>) 50% 50% / 100% no-repeat;background-color:#fff;"></div>
										<i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="post-header">
							<div class="post-meta"><?=get_The_date('j F Y')?></div>
							<div class="post-title"><a href="<?=get_permalink()?>"><?=get_the_title()?></a></div></h2>
						</div>
						<div class="post-body">
							<div class="post-excerpt"><?=get_the_excerpt()?></div>
						</div>
					</article>
				</div>
				<? } ?>
			</div>
			<? } 
			wp_reset_postdata(); ?>

			

		</div>
	</section>

</div>
<!-- /Контент -->

<?php get_footer(); ?>