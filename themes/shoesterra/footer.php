<?if(get_the_ID() != 23128){?>
<div class="container">
    <div class="section-separator"><i></i></div>
    
    	<div class="partners-carousel">
    		<div class="owl-carousel" id="partners">
    		<?
    		foreach(get_terms(['hide_empty' => false]) as $term){
    		    if($term->parent == 335){
    			    $image = wp_get_attachment_url( get_term_meta( $term->term_id, 'thumbnail_id', true ));
    			    if($image != ''){?>
    				    <div>
    				        <a href="<?=get_term_link($term->term_id);?>">
    				            <img src="<?=$image?>" alt="">
    				        </a>
    				    </div>
    			    <?}
    		    }
    		}
    		?>
            </div>
    	</div>
    	<div style="text-align: center;">
    	    <a href="/product-category/brands/" class="more-brands-btn">все бренды</a>
        </div>
    <div class="section-separator"><i></i></div>
</div>

<?}?>

<!-- Футер -->
<!-- Футер -->
<footer class="footer bg-white">
    <div class="container bg-white">
        <div class="footer-top row">
            <div class="col-sm-6 col-md-3">
                <h4>Каталог</h4>
                <ul>
                    <li><a href="/product-category/muzhskaja-obuv/">Мужская обувь</a></li>
                    <li><a href="/product-category/zhenskaja-obuv/">Женская обувь</a></li>
                    <li><a href="/product-category/brands/">Бренды</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h4>Покупателю</h4>
                <ul>
                    <li><a href="/dostavka/">Доставка</a></li>
                    <li><a href="/oplata/">Способы оплаты</a></li>
                    <li><a href="/obmen-vozvrat/">Обмен-возврат</a></li>
                    <li><a href="/publichnaja-oferta/">Публичная оферта</a></li>
                    <li><a href="/garantija/">Гарантия</a></li>
                    <li><a href="/diskontnaja-programma/">Дисконтная программа</a></li>
                    <li><a href="/pravila-prodazhi/">Правила продажи</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h4>О компании</h4>
                <ul>
                    <li><a href="/o-nas/">О нас</a></li>
                    <li><a href="/gde-kupit/">Магазины</a></li>
                </ul>
                <?echo do_shortcode('[wcas-search-form]');?>
            </div>
            <div class="col-sm-6 col-md-3">
                <h4>Контакты</h4>
                <ul class="contacts-footer">
                    <li>
                        <span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20ZM13.2315 11.3615L14.7758 12.9095C15.0826 13.218 15.0734 13.7285 14.7552 14.0481L14.3143 14.4809L14.3048 14.4724C14.1187 14.6184 13.9041 14.7404 13.6745 14.8303C13.4607 14.9135 13.2504 14.966 13.031 14.9923C12.9302 15.003 10.5948 15.2225 7.69672 12.318C5.60017 10.2167 4.82763 8.66816 5.03155 6.97378C5.05537 6.76249 5.10746 6.55163 5.19112 6.33066C5.28187 6.09852 5.40383 5.88325 5.54977 5.69661L5.53788 5.68477L5.97313 5.24603C6.29194 4.92641 6.80157 4.91708 7.10845 5.22461L8.6528 6.7728C8.95968 7.08075 8.95089 7.59116 8.63208 7.91078L8.37536 8.1684L7.85318 8.69099C7.87656 8.73198 7.90019 8.77484 7.92462 8.81914C7.92868 8.8265 7.93276 8.83389 7.93686 8.84133L7.93842 8.84413C8.21135 9.33664 8.58476 10.0105 9.29315 10.7204C10.0008 11.4301 10.6732 11.8041 11.1646 12.077C11.2181 12.107 11.2689 12.1354 11.3181 12.1626L12.0961 11.3829C12.4145 11.0638 12.9239 11.0544 13.2315 11.3615Z" fill="#41020D"/>
                            </svg>
                        </span>
                        <a href="tel:+375 29 342-92-67">+375 29 342-92-67</a>
                        <br>
                        <a href="tel:+375 29 656-73-47">+375 29 656-73-47</a>
                    </li>
                    <li>
                        <span>
                            <svg style="margin-left: -2px;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" fill="#41020D"/>
                                <path d="M13.3992 7.2C13.3992 6.53726 12.862 6 12.1992 6C11.5365 6 10.9992 6.53726 10.9992 7.2V12C10.9992 12.6627 11.5365 13.2 12.1992 13.2H16.9992C17.662 13.2 18.1992 12.6627 18.1992 12C18.1992 11.3373 17.662 10.8 16.9992 10.8H13.3992V7.2Z" fill="white"/>
                            </svg>
                        </span>
                        <p>Пн-Вс: 10.00-21.00</p>
                    </li>
                    <li>
                        <span>
                            <svg style="margin-left: -2px;"  width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 7C2 5.89543 2.89543 5 4 5H20C21.1046 5 22 5.89543 22 7V17C22 18.1046 21.1046 19 20 19H4C2.89543 19 2 18.1046 2 17V7Z" fill="#41020D"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7764 13.1793L19.7764 8.17925V7.00195H17.8865L11.7764 10.8208L5.66628 7.00195H3.77637V8.17925L11.7764 13.1793Z" fill="white"/>
                            </svg>
                        </span>
                        <a href="mailto:shoesterra@yandex.ru">shoesterra@yandex.ru</a>
                    </li>
                    <li>
                        <span>
                            <img src="/wp-content/uploads/2021/01/image-16.png">
                        </span>
                        <a href="https://www.instagram.com/shoesterra/">@shoesterra</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-midle">
            <div class="row">
                <div class="col-sm-6">
                    <p>ЧТУП «Глобал Шуз»<br>
Юридический адрес: г.Минск, ул.Веры Хоружей, д.6б, пом. 23а<br>
Свидетельство о государственной регистрации выдано Мингорисполкомом от 7.04.2017 УНП 192799956<br>
Зарегистрирован в Торговом реестре 12 января 2021 г. Регистрационный номер 500230</p>
                </div>
                <div class="col-sm-6 img-block">
                    <div class="">
                        <img src="/wp-content/uploads/2021/01/image-7.png">
                        <img src="/wp-content/uploads/2021/01/image-8.png">
                        <img src="/wp-content/uploads/2021/01/image-12.png">
                        <img src="/wp-content/uploads/2021/01/image-13.png">
                        <img src="/wp-content/uploads/2021/01/image-14.png">
                        <img src="/wp-content/uploads/2021/01/image-9.png">
                        <img src="/wp-content/uploads/2021/01/image-15.png">
                        <img src="/wp-content/uploads/2021/01/image-11.png">
                        <img src="/wp-content/uploads/2021/01/image-10.png">
                        <img src="/wp-content/uploads/2021/01/Card_MAX-1.png">
                        <img src="/wp-content/uploads/2021/01/Card_MIX-1.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="footer-meta">
		<div class="container">
			<div class="row">
				<div class="col-md-6 copyright">
					<span><?=get_field('copyright','option')?></span>
				</div>
				<div class="col-md-6 text-right">
					<p class="websfera">Разработано:<br> <a href="http://websfera.by" rel="nofollow" target="_blank">WebSfera</a></p>
				</div>
			</div>
			
			
		</div>
	</div>
</footer>
<!-- /Футер -->

<div class="modal-cart modal-select-size">
    <div class="inner">
        <p>Пожалуйста, выберите имеющийся в наличии размер</p>
        <button class="close-modal">Закрыть</button>
        <p class="close-modal-small"></p>
    </div>
</div>

<div class="modal-cart modal-success-to-cart">
    <div class="inner">
        <p>Добавлено в вашу корзину</p>
        <div class="cart-info">
            <div class="cart-success-text">
                <p class="title"></p>
                <p class="size">Размер: <span class="size-int"></span></p>
                <p class="price"></p>
                
            </div>
        </div>
        <div class="btn-cont">
            <button class="close-modal">Продолжить</button>
            <a class="white-btn" href="<?php echo wc_get_cart_url() ?>">В корзину</a>
        </div>
        <p class="close-modal-small"></p>
    </div>
</div>
<div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

</div>
<!-- /Обертка -->

<div id="callbacky-phone-widget-send-btn-container">
	<a href="#phones" id="callbacky-phone-widget-send-btn" class="drag-zone"></a>
	<div id="callbacky-phone-widget-phone-icon"></div>
	<div id="callbacky-phone-widget-animation"></div>
</div>

<div id="phones" class="modalDialog">
	<div>
		<a href="#close" title="Закрыть" class="close">X</a>
		<div class="phones">
			<h2>Наши телефоны</h2>
			<a href="tel:+375291298552"><p>+375 (29) 129-85-52</p></a>
			<a href="tel:+375293374149"><p>+375 (29) 337-41-49</p></a>
			<a href="tel:+375296567347"><p>+375 (29) 656-73-47</p></a>
			<a href="tel:+375297517123"><p>+375 (29) 751-71-23</p></a>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
<!--[if lt IE 9]><script src="/wp-content/themes/shoesterra/plugins/jquery/jquery-1.11.1.min.js"></script><![endif]-->
<!--[if gte IE 9]><!--><script src="/wp-content/themes/shoesterra/plugins/jquery/jquery-2.1.1.min.js"></script><!--<![endif]-->
<script src="/wp-content/themes/shoesterra/plugins/modernizr.custom.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/superfish/js/superfish.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/jquery.easing.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/jquery.sticky.min.js"></script>
<script src="/wp-content/themes/shoesterra/js/jquery.lazyload.min.js"></script>

<script src="/wp-content/themes/shoesterra/js/slick/slick-1.8.1/slick/slick.min.js"></script>

<script src="/wp-content/themes/shoesterra/plugins/owlcarousel2/owl.carousel.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/isotope/jquery.isotope.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/waypoints/waypoints.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/countdown/jquery.plugin.min.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/countdown/jquery.countdown.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDR8kQatvyWfWmiLZVveXKtfypqtIRSyxc"></script>
<script src="/wp-content/themes/shoesterra/js/theme.js"></script>
<script src="/wp-content/themes/shoesterra/plugins/owlcarousel2/owl.animate.js"></script>
<!--<script type='text/javascript' src='http://shoesterra.by/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>-->
<script type='text/javascript'>
	/* <![CDATA[ */
	var _wpcf7 = {"loaderUrl":"http:\/\/stix.tid24.ru\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","recaptchaEmpty":"Please verify that you are not a robot.","sending":"\u041e\u0442\u043f\u0440\u0430\u0432\u043a\u0430..."};
	/* ]]> */
</script>
<script type='text/javascript' src='https://raw.githubusercontent.com/jquery-form/form/v4.2.2/dist/jquery.form.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.3.1'></script>

<link rel='stylesheet' id='contact-form-7-css-2'  href='/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.3.1' type='text/css' media='all' />



<div class="gde-kupit-modal-cont">
		    <div class="gde-kupit">
		        <div class="gde-kupit-exit">
		            <span>+</span>
		        </div>
		        <div class="container">
	        <div class="row">
            <div class="col-xs-12"><h2>Где купить</h2></div>
				
				<?foreach(get_field('shops', 16) as $shop){
				?>
				<div class="col-xs-12 col-md-3">
					<div class="alert alert-success">
						<h4><strong><?=$shop['shop_address']?></strong></h4>
						<h4><b>Режим работы:</b><br><?=$shop['shop_worktime']?></h4>
						<h4><b>Телефоны:</b><br>
						<?foreach($shop['shop_phones'] as $phone){?>
						<?=$phone['shop_phone'];?>
						<br>
						<?}?>
						</h4>
					</div>
				</div>
				<?
				}?>
		</div>
		    </div>
		</div>
</div>
		
		<script>
		    $('.gde-kupit-modal-button').click(function(){
		        document.querySelector('.gde-kupit-modal-cont').classList.add('active');
		    })
		    $('.gde-kupit-exit').click(function(){
		        document.querySelector('.gde-kupit-modal-cont').classList.remove('active');
		    })
		</script>
		
		<div class="modal-bron-form-cont">
		    <div class="modal-bron-form">
		         <div class="modal-bron-form-exit">
		            <span>+</span>
		        </div>
		        <? echo do_shortcode('[contact-form-7 id="6008" title="Забронировать пару"]'); ?>
		    </div>
		    
		</div>
    
        <script>
		    $('.modal-bron-form-button').click(function(){
		        document.querySelector('.modal-bron-form-cont').classList.add('active');
		    })
		    $('.modal-bron-form-exit').click(function(){
		        document.querySelector('.modal-bron-form-cont').classList.remove('active');
		    })
		</script>
		
	
		
		<script>
        if(document.querySelector('#menu-main-menu')!=null){
            var items = document.querySelectorAll('.menu-item-has-children');
            
            for (var i=0;i<items.length;i++){
                items[i].onclick = function(){
                    console.log(this);
                    this.classList.toggle('active');
                    this.classList.remove('sfHover');
                }
            }
        }
		</script>

</body>
</html>