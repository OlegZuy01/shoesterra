'use strict';

// cache
var body = $('body');
var mainSlider = $('#main-slider');
var imageCarousel = $('.img-carousel');
var partnersCarousel = $('#partners');
var promotionsSlider = $('#promotions-slider');
var productImgCarousel = $('.product-img-carousel');
var popupProductView = $('#popup-product-view');
var owlCarouselSelector = $('.owl-carousel');
var isotopeContainer = $('.isotope');
var isotopeFiltrable = $('#filtrable a');
var toTop = $('#to-top');
var hover = $('.thumbnail');
var navigation = $('.navigation');
var superfishMenu = $('ul.sf-menu');

jQuery(document).ready(function () {
    if(Cookies.get('wmc_current_currency') != "BYN"){
        Cookies.set('wmc_current_currency','BYN');
        location.reload();
    }
    if($('.product_filter')){
        $('.product_filter li').each(function(){
            if($(this).find('input[type=checkbox]:checked').length > 0){
                
            $(this).find('>span').toggleClass('open');
            $(this).find('.product-filter-toogle').toggle();
            }
        });
    }
    
    // prevent empty links
    // ---------------------------------------------------------------------------------------
    $('a[href=#]').click(function (event) {
        event.preventDefault();
    });
    // $('li.woocommerce-widget-layered-nav-list__item.wc-layered-nav-term.woocommerce-widget-layered-nav-list__item--chosen.chosen a').click(function (event) {
    //     event.preventDefault();
    // });
    
    $('.current-menu-item>a').click(function (event) {
        event.preventDefault();
    });
    // Sticky header/menu
    // ---------------------------------------------------------------------------------------
    if ($().sticky) {
        $('.header-sticky').sticky({topSpacing:0});
    }
    // superfish menu
    // ---------------------------------------------------------------------------------------
    if ($().superfish) {
        superfishMenu.superfish();
    }
    $('ul.sf-menu a').click(function () {
        body.scrollspy('refresh');
    });
    // fixed menu toggle
    $('.menu-toggle').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    $('.menu-toggle-close').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    // Smooth scrolling
    // ----------------------------------------------------------------------------------------
    $('.sf-menu a, .scroll-to').click(function () {

        $('.sf-menu a').removeClass('active');
        $(this).addClass('active');
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, {
            duration: 1200,
            easing: 'easeInOutExpo'
        });
        return false;
    });
    // BootstrapSelect
    // ---------------------------------------------------------------------------------------
    if ($().selectpicker) {
        $('.selectpicker').selectpicker();
    }
    // prettyPhoto
    // ---------------------------------------------------------------------------------------
    if ($().prettyPhoto) {
        $("a[data-gal^='prettyPhoto']").prettyPhoto({
            theme: 'dark_square'
        });
    }
    // Scroll totop button
    // ---------------------------------------------------------------------------------------
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
            toTop.css({bottom: '15px'});
        } else {
            toTop.css({bottom: '-100px'});
        }
    });
    toTop.click(function () {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });
    // add hover class for correct view on mobile devices
    // ---------------------------------------------------------------------------------------
    /*
    hover.hover(
        function () {
            $(this).addClass('hover');
        },
        function () {
            $(this).removeClass('hover');
        }
    );
    */
    // Single product gallery in popup
    // ---------------------------------------------------------------------------------------
    if (popupProductView.length) {
        popupProductView.on('shown.bs.modal', function (e) {
            //$('.owl-carousel').trigger('refresh');
            /*$('.img-carousel').on('initialize.owl.carousel initialized.owl.carousel ' +
             'initialize.owl.carousel initialize.owl.carousel ' +
             'resize.owl.carousel resized.owl.carousel ' +
             'refresh.owl.carousel refreshed.owl.carousel ' +
             'update.owl.carousel updated.owl.carousel ' +
             'drag.owl.carousel dragged.owl.carousel ' +
             'translate.owl.carousel translated.owl.carousel ' +
             'to.owl.carousel changed.owl.carousel', function(e) {
             //
             });*/

            productImgCarousel.owlCarousel({
                items: 1,
                autoplay: false,
                loop: true,
                margin: 0,
                dots: true,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ]
            });
        });
    }
    // Sliders
    // ---------------------------------------------------------------------------------------
    if ($().owlCarousel) {
        // Main slider
        if (mainSlider.length) {
            mainSlider.owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause:true
            });
        }
		// Partners Slider
		if (partnersCarousel.length) {
            partnersCarousel.owlCarousel({
                autoplay: true,
                loop: true,
                margin: 25,
                dots: false,
                navText: [
                    "<i class='fa fa-caret-left'></i>",
                    "<i class='fa fa-caret-right'></i>"
                ],
                responsive: {
                    0: {items: 3},
                    479: {items: 3},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 4}
                }
            });
        }
        // Images Carousel
        if (imageCarousel.length) {
            imageCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 0,
                dots: true,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
    }
    // countdown
    // ---------------------------------------------------------------------------------------
    if ($().countdown) {
        var austDay = new Date();
        austDay = new Date("Nov 5, 2017 15:37:25");
        $('#dealCountdown1').countdown({until: austDay});
    }
    // countdown
    // ---------------------------------------------------------------------------------------
    if ($().countdown) {
        var austDay1 = new Date();
        austDay1 = new Date("Sep 11, 2017 15:37:25");
        $('#dealCountdown2').countdown({until: austDay1});
    }
    // Google map
    // ---------------------------------------------------------------------------------------
    if (typeof google === 'object' && typeof google.maps === 'object') {
        if ($('#map-canvas').length) {
            var map;
            var marker;
            google.maps.event.addDomListener(window, 'load', function () {
                var mapOptions = {
                    scrollwheel: false,
                    zoom: 14,
                    center: new google.maps.LatLng(53.916086, 27.612617)
                };
                map = new google.maps.Map(document.getElementById('map-canvas'), // map coordinates
                    mapOptions);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(53.876838, 27.516726), // marker coordinates
                    map: map,
                });
                var marker2 = new google.maps.Marker({
                    position: new google.maps.LatLng(53.920231, 27.581919), // marker coordinates
                    map: map,
                });
                var marker3 = new google.maps.Marker({
                    position: new google.maps.LatLng(53.918902, 27.579380), // marker coordinates
                    map: map,
                });
                var marker4 = new google.maps.Marker({
                    position: new google.maps.LatLng(53.919637, 27.580792), // marker coordinates
                    map: map,
                })
            });
        }
    }
    
    $('.wcapf-layered-nav ul li a').on('click',function(){
	   $(this).parent().toggleClass('chosen');
    });
    
    $('.search-button').on('click',function(){
	    $('.field-search').addClass('active');
    });
    $('.field-search .fa-times').on('click',function(){
	    $('.field-search').removeClass('active');
    });
});

jQuery(window).load(function () {
    // preloader
    $('#status').fadeOut();
    $('#preloader').delay(200).fadeOut(200);
    // Init Isotope
    /*if ($().isotope) {
        isotopeContainer.isotope({ // initialize isotope
            itemSelector: '.isotope-item' // options...
            //,transitionDuration: 0 // disable transition
        });
        isotopeFiltrable.click(function () { // filter items when filter link is clicked
            var selector = $(this).attr('data-filter');
            isotopeFiltrable.parent().removeClass('current');
            $(this).parent().addClass('current');
            isotopeContainer.isotope({filter: selector});
            return false;
        });
        isotopeContainer.isotope('reLayout'); // layout/reLayout
    }*/
    // scroll to hash
    if (location.hash != '') {
        var hash = '#' + window.location.hash.substr(1);
        if (hash.length) {
            body.delay(0).animate({
                scrollTop: jQuery(hash).offset().top
            }, {
                duration: 1200,
                easing: "easeInOutExpo"
            });
        }
    }
    // scrollspy
    body.scrollspy({offset: 100, target: '.navigation'});
    body.scrollspy('refresh');
    // refresh owl sliders
    owlCarouselSelector.trigger('refresh');
    owlCarouselSelector.trigger('refresh.owl.carousel');
});

jQuery(window).resize(function () {
    body.scrollspy('refresh');
    owlCarouselSelector.trigger('refresh');
    owlCarouselSelector.trigger('refresh.owl.carousel');
    if ($().isotope) {
        isotopeContainer.isotope('reLayout'); // layout/relayout on window resize
    }
});

jQuery('.product-size-input').on('change', function(){
        checkProductInCart(jQuery(this).val());
    jQuery('label.active').removeClass("active");
    jQuery("label[for='" + jQuery(this).attr('id') + "']").addClass("active");
    var value = jQuery("label[for='" + jQuery(this).attr('id') + "']").text();
    if(typeof jQuery(this).parent().attr('data-product-id') !== typeof undefined && jQuery(this).parent().attr('data-product-id') !== false){  
        jQuery('#'+jQuery(this).parent().attr('data-product-id')+' .add-to-card').attr('data-id', jQuery(this).val());
    } else {
        jQuery('.add-to-card').attr('data-id', jQuery(this).val());
    }
    
    jQuery('.wpcf7-form .siza-m select').hide();
    jQuery('.wpcf7-form .siza-m select option[value="'+value+'"]').attr('selected', 'true');
    if(jQuery('.wpcf7-form .siza-m .size-value').length > 0){
        jQuery('.wpcf7-form .siza-m .size-value').text(value);
    } else{
        jQuery('.wpcf7-form .siza-m').append('<p class="size-value">'+value+'</p>');
    }
    
    jQuery('.wpcf7-form .siza-w select').hide();
    jQuery('.wpcf7-form .siza-w select option[value="'+value+'"]').attr('selected', 'true');
    if(jQuery('.wpcf7-form .siza-w .size-value').length > 0){
        jQuery('.wpcf7-form .siza-w .size-value').text(value);
    } else{
        jQuery('.wpcf7-form .siza-w').append('<p class="size-value">'+value+'</p>');
    }
});
jQuery('.btn-modal-category-cart').on('click', function(){
    
    jQuery('#'+jQuery(this).attr('data-modal')+'.modal-category-cart').show();    
});

jQuery('.add-to-card').on('click', function(){
    if(!jQuery(this).hasClass('disable')){
        var attr = jQuery(this).attr('data-id');
        var type = jQuery(this).attr('data-type');
        if(typeof attr !== typeof undefined && attr !== false){   
            $.ajax({
              type: 'POST',
              url: '/add-to-cart.php',
              data: 'id='+attr,
              dataType: 'JSON',
              success: function(data){
                jQuery('.modal-success-to-cart .cart-info img').remove();
                jQuery('.modal-success-to-cart .cart-info').append(data.product_image);
                jQuery('.modal-success-to-cart .cart-success-text .title').text(data.product_name);
                jQuery('.modal-success-to-cart .cart-success-text .size-int').text(data.product_size);
                jQuery('.modal-success-to-cart .cart-success-text .price').html(data.price_html);

                //debugger;  
                jQuery('.modal-success-to-cart').show();
                var pastCount = jQuery('.s-header__basket-wr .basket-btn__counter').text();
                var newCount = parseInt(pastCount.slice(1).slice(0, -1)) + 1;
                jQuery('.s-header__basket-wr .basket-btn__counter').text('('+newCount+')');
                checkProductInCart(attr);
              }
            });
        } else {
            jQuery('.modal-select-size').show();
        }
    }
    
});
jQuery('.modal-cart .close-modal, .modal-cart .close-modal-small').on('click', function(){
    jQuery('.modal-cart').hide();
});

function checkProductInCart(id){
    $.ajax({
      type: 'POST',
      url: '/check-in-cart.php',
      data: 'id=' + id,
      dataType: 'JSON',
      success: function(data){
        if(data.isset == true){
            jQuery('.add-to-card').addClass('disable').text('УЖЕ В КОРЗИНЕ');
        } else {
            jQuery('.add-to-card').removeClass('disable').text('ДОБАВИТЬ В КОРЗИНУ');
        }
      }
    });
}
/*
$('.product .slider-single').slick({
 	slidesToShow: 1,
 	slidesToScroll: 1,
 	arrows: false,
 	fade: false,
 	adaptiveHeight: true,
 	infinite: false,
	useTransform: true,
 	speed: 400,
 	cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
 });
$('.product .slider-nav')
 	.on('init', function(event, slick) {
 		$('.slider-nav .slick-slide.slick-current').addClass('is-active');
 	})
 	.slick({
 		slidesToShow: 3,
 		slidesToScroll: 1,
 		dots: false,
 		focusOnSelect: false,
 		infinite: false
 	});

$('.slider-single').on('afterChange', function(event, slick, currentSlide) {
 	$('.slider-nav').slick('slickGoTo', currentSlide);
 	var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
 	$('.slider-nav .slick-slide.is-active').removeClass('is-active');
 	$(currrentNavSlideElem).addClass('is-active');
 });


 $('.slider-nav').on('click', '.slick-slide', function(event) {
 	event.preventDefault();
 	var goToSingleSlide = $(this).data('slick-index');

 	$('.slider-single').slick('slickGoTo', goToSingleSlide);
 });

$('.product .slick-prev').on('click', function(){
    $('.product .slider-single').slick('slickPrev');
    $('.product .slider-nav').slick('slickPrev');
});
$('.product .slick-next').on('click', function(){
    $('.product .slider-single').slick('slickNext');
    $('.product .slider-nav').slick('slickNext');
});
*/
$('.product .slider-single').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.product .slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-single',
  dots: false,
  centerMode: true,
  focusOnSelect: true
});

$('.product_filter .parent-li span').on('click', function(){
    $(this).toggleClass('open');
    $(this).parent().find('.product-filter-toogle').toggle();
});

$('#product_filter input').on('change', function(){
    var thisInput = $(this);
    var dataForm = new FormData(document.getElementById('product_filter'));
    $.ajax({
        type: "POST",
        url: "/wp-content/themes/shoesterra/filterCheckProduct.php",
        data: dataForm,
		dataType: 'json',
		contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            $('.filter-info-btn .info-number span').text('');
            var top = thisInput.offset().top - $('#product_filter').offset().top;
            $('.filter-info-btn').css('top', top).addClass('open load');
        },
        success: function(response){
            $('.filter-info-btn').removeClass('load');
            $('.filter-info-btn .info-number span').text(response.number);
        	
        }
    }); 
});
$('#product_filter').on('submit', function(e){
    e.preventDefault();
    var dataForm = new FormData(document.getElementById('product_filter'));
    $.ajax({
        type: "POST",
        url: "/wp-content/themes/shoesterra/filterSubmit.php",
        data: dataForm,
		dataType: 'json',
		contentType: false,
        cache: false,
        processData:false,
        success: function(data){
            window.location.replace(data.link);
        }
    });  
});
$(document).click( function(e){
    if ( $(e.target).closest('.sidebar, .sidebar-mob-btn').length ) {
        $('.sidebar').addClass('open');
        $('body').addClass('gray-back');
    } else {
        $('.sidebar').removeClass('open');
        $('body').removeClass('gray-back');
    }
});
(function() {

  var parent = document.querySelector(".price-slider");
  if(!parent) return;

  var
    rangeS = parent.querySelectorAll("input[type=range]"),
    numberS = parent.querySelectorAll("input[type=number]");

    var slide1 = parseFloat(rangeS[0].value),
    slide2 = parseFloat(rangeS[1].value);
    var widthLeft = (slide1)/rangeS[0].getAttribute('max') * 100;
    var widthRight = (rangeS[0].getAttribute('max') - slide2)/rangeS[0].getAttribute('max') * 100;
    $('head').append('<style>.price-slider input[name=min_price]:before {width:'+widthLeft+'% ;}</style>');
    $('head').append('<style>.price-slider input[name=max_price]:before {width:'+widthRight+'% ;}</style>');

    


  rangeS.forEach(function(el) {
    el.oninput = function() {
      var slide1 = parseFloat(rangeS[0].value),
            slide2 = parseFloat(rangeS[1].value);
        
      numberS[0].value = slide1;
      numberS[1].value = slide2;
      
      var widthLeft = (slide1)/el.getAttribute('max') * 100;
      var widthRight = (el.getAttribute('max') - slide2)/el.getAttribute('max') * 100;
      $('head').append('<style>.price-slider input[name=min_price]:before {width:'+widthLeft+'% ;}</style>');
      $('head').append('<style>.price-slider input[name=max_price]:before {width:'+widthRight+'% ;}</style>');

    }
  });

  numberS.forEach(function(el) {
      
    el.oninput = function() {
        var number1 = parseFloat(numberS[0].value),
        number2 = parseFloat(numberS[1].value);
      rangeS[0].value = number1;
      rangeS[1].value = number2;
    var widthLeft = (number1)/el.getAttribute('max') * 100;
      var widthRight = (el.getAttribute('max') - number2)/el.getAttribute('max') * 100;
      $('head').append('<style>.price-slider input[name=min_price]:before {width:'+widthLeft+'% ;}</style>');
      $('head').append('<style>.price-slider input[name=max_price]:before {width:'+widthRight+'% ;}</style>');

    }
  });

})();

$('.reset-btn').on('click', function(){
    $('.product_filter input[type="checkbox"]').attr('checked', false);
    $('.filter-info-btn').removeClass('open');
});



