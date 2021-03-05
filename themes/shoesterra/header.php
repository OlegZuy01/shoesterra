<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ru"><!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="yandex-verification" content="3fa1f81c23a27584" />
	<meta name="yandex-verification" content="d30ffadbb1a64d3a" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title('«', true, 'right'); ?> </title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>

	<link href="/wp-content/themes/shoesterra/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/plugins/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/plugins/owlcarousel2/assets/owl.theme.default.min.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/plugins/countdown/jquery.countdown.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/js/slick/slick-1.8.1/slick/slick.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/js/slick/slick-1.8.1/slick/slick-theme.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/style.css" rel="stylesheet">
	<link href="/wp-content/themes/shoesterra/css/woocommerce.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
        
        <link rel="icon" href="/wp-content/uploads/2018/10/cropped-favicon-32x32.png" sizes="32x32">
        <link rel="icon" href="/wp-content/uploads/2018/10/cropped-favicon-192x192.png" sizes="192x192">
 

	
		<!--[if lt IE 9]>
			<script src="/wp-content/themes/shoesterra/plugins/iesupport/html5shiv.js"></script>
			<script src="/wp-content/themes/shoesterra/plugins/iesupport/respond.min.js"></script>
		<![endif]-->
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
			(function (d, w, c) {
				(w[c] = w[c] || []).push(function() {
					try {
						w.yaCounter49928083 = new Ya.Metrika2({
							id:49928083,
							clickmap:true,
							trackLinks:true,
							accurateTrackBounce:true,
							webvisor:true
						});
					} catch(e) { }
				});

				var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
				s.type = "text/javascript";
				s.async = true;
				s.src = "https://mc.yandex.ru/metrika/tag.js";

				if (w.opera == "[object Opera]") {
					d.addEventListener("DOMContentLoaded", f, false);
				} else { f(); }
			})(document, window, "yandex_metrika_callbacks2");
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/49928083" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151017278-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151017278-1');
</script>

<?//print_r($_SERVER);?>
	</head>
	<body <?php body_class('wide'); ?>>
		
		<!-- Wrap all content -->
		<div class="wrapper">
			<!-- Шапка -->
			<header class="header header-sticky">
				<div class="header-wrapper clearfix">
					<div class="container">	
						<!-- Mobile menu toggle button-->
						<a href="#" class="menu-toggle btn"><i class="fa fa-bars"></i></a>
						<!-- /Mobile menu toggle button-->
						
						<div class="top_header col-md-12">
						    <div class="col-md-3 col-xs-3">
								<div class="logo">
									<?php 
                						if( is_page(4) ){
                							echo '<img src="'.get_field('logo','option').'">';
                						} else {
                							echo '<a href="/"><img src="'.get_field('logo','option').'"></a>';
                						}
                						?>
									<!-- <a href="/"><img src="<?=get_field('logo','option')?>"></a> -->
								</div>

							</div>
							
							
							<div class="col-md-2 col-xs-6 inst">
								<a class="insta_link" href=" https://www.instagram.com/shoesterra/" rel="nofollow"><img class="insta_logo" src="/wp-content/themes/shoesterra/img/shoes-insta-icon.png" alt="">@shoesterra</a>
							</div>
							
							
							<div class="col-md-2 col-xs-6 phones">
							    <a href="tel:+37529-3429267" onclick="yaCounter49928083.reachGoal('tel'); return true;">+37529-342-92-67</a>
							    <br>
							   <a href="tel:+375296567347" onclick="yaCounter49928083.reachGoal('tel'); return true;">+37529-656-73-47</a>
							</div>
							
							
							
							<div class="col-md-3 col-xs-5 search">
								
								<div class="private-office">
									<div class="phone">
										<?echo do_shortcode('[wcas-search-form]');?>
									</div>
								</div>
							</div>
							
							<div class="col-md-2 col-xs-4 s-header__basket-wr woocommerce">
                                <?php
                                global $woocommerce; ?>
                                <a href="<?php echo $woocommerce->cart->get_cart_url() ?>" class="basket-btn basket-btn_fixed-xs">
                                    <span class="basket-btn__label">Корзина</span>
                                    <span class="basket-btn__counter">(<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</span>
                                </a>
                            </div>
						
						</div>
						<!-- Left navigation -->
					</div>
					<nav class="navigation closed">
						<div class="container">
							<a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
							<? wp_nav_menu('menu=Main menu&menu_class=sf-menu'); ?>
						</div>
					</nav>
					<!-- /Left navigation -->
				</div>
			</header>
			<!-- /Шапка -->																	<?if(get_field('akcia','option')){?>
                <?if(!is_front_page()){?>
                    <section id="akc">
                        <div class="container">
                            <div class="col-md-12">
                                <p><?=the_field('akcia','option');?></p>
                            </div>
                        </div>
                    </section>
                <?}?>
            <?}?>