<?php
/*
//WooHelp.ru
//WooCommerce 3.5.3
//Вывод двух цен товара
$price_us_int = intval(preg_replace('/[^0-9]+/', '', $price), 10);
function convert_idr_to_usd_cart( $price ){
    $convertion_rate = 2.6; // Здесь задаем курс пересчета валюты
    $new_price = $price * $convertion_rate; // Деление цены на курс, для умножения замените / на *
    return number_format($new_price, 0, '.', ''); //Количество символов цены после запятой
}
add_filter( 'wc_price', 'my_custom_price_format', 10, 3 );
function my_custom_price_format( $formatted_price, $price, $args ) {
    $price_usd = convert_idr_to_usd_cart($price);
    $formatted_price_usd = "<span class=\"woocommerce-Price-amount amount\">".$price_usd."<span class=\"woocommerce-Price-currencySymbol\">р.</span></span>";//Как выводим цену
    return $formatted_price_usd;
}
*/

// ================ calculate sale on percent

add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {

  if( $product->is_type('variable')){
      $percentages = array();

      // Get all variation prices
      $prices = $product->get_variation_prices();

      // Loop through variation prices
      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

      // Get all variation prices
      $children_ids = $product->get_children();

      // Loop through variation prices
      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = round(100 - ($sale_price / $regular_price * 100));
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
          return $html;
      }
  }
  return '<span class="prod-skidka">-'. $percentage . '</span>';
}

/*
// ================ add custom price
// Используем формат цены вариативного товара WC 2.0
add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );
function wc_wc20_variation_price_format( $price, $product ) {
    $currency_usd = $product->get_attribute('kurs-dolara');
	if($currency_usd == ""){
	    $currency_usd = get_field('kurs_dollara','option');
	}
    // Основная цена
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $currency = $prices[0]*$currency_usd;
    $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Цена со скидкой
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
    $currency_sale = $prices[0]*$currency_usd;
    
    $currency_sale_html = '<span class="woocommerce-Price-amount amount">'.round($currency_sale).'<span class="woocommerce-Price-currencySymbol">р.</span></span>';
    $currency_html = '<span class="woocommerce-Price-amount amount">'.round($currency).'<span class="woocommerce-Price-currencySymbol">р.</span></span>';
    
    if ( $price !== $saleprice ) {
        
        $price = '<del>'.$currency_sale_html.'</del><ins>' .$currency_html.'</ins>';
    }
    else{
        $price =   $currency_html;
    }
    return $price;
}

add_filter( 'woocommerce_variation_price_html', 'usd_prise_var', 10, 2 );
function usd_prise_var( $price, $product ) {

    $currency_usd = $product->get_attribute('kurs-dolara');
	if($currency_usd == ""){
	    $currency_usd = get_field('kurs_dollara','option');
	}
    $display_price = $product->get_display_price();

    $currency = $display_price*$currency_usd;
    $price = wc_price( $display_price ) .' ('.round($currency).' р.)'. $product->get_price_suffix();
    return $price;
}

add_filter( 'woocommerce_variation_sale_price_html', 'usd_prise_var_sale', 10, 2 );
function usd_prise_var_sale( $price, $product ) {

    $currency_usd = $product->get_attribute('kurs-dolara');
	if($currency_usd == ""){
	    $currency_usd = get_field('kurs_dollara','option');
	}
    $display_regular_price = $product->get_display_price( $product->get_regular_price() );
    $display_sale_price    = $product->get_display_price( $product->get_sale_price() );

    $currency = $display_regular_price*$currency_usd;
    $currency_sale = $display_sale_price*$currency_usd;
    $price= '<del>' . wc_price( $display_regular_price ) .' ('.round($currency).' р.)'. '</del> <ins>' . wc_price( $display_sale_price ) .' ('.round($currency_sale).' р.)'. '</ins>' . $product->get_price_suffix();
    return $price;
}

*/
// ============== end add custom price
add_filter('woe_get_order_product_value_parent_sku', function ($value, $order, $item, $product, $item_meta) {
   if($product) {
     $parent_id = $product->get_parent_id();
     $value = get_post_meta($parent_id , '_sku', true);
   }
   return $value;
}, 10, 5);

function custom_export_field_parent_sku($value){
    $product = wc_get_product($value);
    if($product) {
     $parent_id = $product->get_parent_id();
     $value = get_post_meta($parent_id , '_sku', true);
   }
   return $value;
}

update_option( 'siteurl', 'http://shoestera2.dan80.beget.tech' );
update_option( 'home', 'http://shoestera2.dan80.beget.tech/' );


// setting payment in checkout
add_filter( 'woocommerce_available_payment_gateways', 'truemisha_payments_on_shipping_1' );
 
function truemisha_payments_on_shipping_1( $available_gateways ) {
 
	if( is_admin() ) {
		return $available_gateways;
	}
 
	if( is_wc_endpoint_url( 'order-pay' )) {
		return $available_gateways;
	}
 
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
 
	//echo '<pre>';print_r( $chosen_methods );
 
	if ( isset( $available_gateways[ 'cheque' ] ) && ('free_shipping:1' == $chosen_methods[0] || 'flat_rate:3' == $chosen_methods[0]) ) {
		unset( $available_gateways[ 'cheque' ] ); // отключаем оплату при доставке
	}
 
	return $available_gateways;
 
}
add_filter( 'woocommerce_available_payment_gateways', 'truemisha_payments_on_shipping_2' );
 
function truemisha_payments_on_shipping_2( $available_gateways ) {
 
	if( is_admin() ) {
		return $available_gateways;
	}
 
	if( is_wc_endpoint_url( 'order-pay' )) {
		return $available_gateways;
	}
 
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
 
	//echo '<pre>';print_r( $chosen_methods );
 
	if ( isset( $available_gateways[ 'bacs' ] ) && ('free_shipping:1' == $chosen_methods[0] || 'flat_rate:3' == $chosen_methods[0]) ) {
		unset( $available_gateways[ 'bacs' ] ); // отключаем оплату при доставке
	}
 
	return $available_gateways;
 
}

//===========

    add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');
    
    function header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <span class="basket-btn__counter">(<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</span>
        <?php
        $fragments['.basket-btn__counter'] = ob_get_clean();
        return $fragments;
    }
    
    
    
    if (function_exists('add_theme_support')) {
		add_theme_support('menus');
	}



	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	function remove_menus(){
		global $menu;
		$restricted = array(
		__('Comments')
		);
		end ($menu);
		while (prev($menu)){
			$value = explode(' ', $menu[key($menu)][0]);
			if( in_array( ($value[0] != NULL ? $value[0] : "") , $restricted ) ){
				unset($menu[key($menu)]);
			}
		}
	}
	add_action('admin_menu', 'remove_menus');
	function remove_x_pingback($headers) {
		unset($headers['X-Pingback']);
		return $headers;
	}
	add_filter('wp_headers', 'remove_x_pingback');
	remove_action( 'wp_head', 'wp_generator');
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action('wp_head', 'previous_post_rel_link', 10, 0);
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action('wp_head', '_ak_framework_meta_tags');
	remove_action('wp_head','wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'rest_output_link_wp_head');
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	add_action( 'wp_print_styles', 'aa_deregister_styles', 100 );
	function aa_deregister_styles() {
		if ( ! is_page( get_theme_mod( "header_contacts") ) ) {
			wp_deregister_style( 'contact-form-7' );
		}
	}
	add_action( 'wp_print_scripts', 'aa_deregister_javascript', 100 );
	function aa_deregister_javascript() {
		if ( ! is_page( get_theme_mod( "header_contacts") ) ) {
			wp_deregister_script( 'contact-form-7' );
		}
	}

	add_filter('rest_enabled', '__return_false');
	remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
	remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
	remove_action( 'init', 'rest_api_init' );
	remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
	remove_action( 'parse_request', 'rest_api_loaded' );
	remove_action( 'rest_api_init', 'wp_oembed_register_route');
	remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	if ( ! function_exists( 'paging_nav' ) ) {

		function paging_nav() {

			// Don't print empty markup if there's only one page.
			if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
				return;
			}

			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link = html_entity_decode( get_pagenum_link() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

			// Set up paginated links.
			$links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            //'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => 'Предыдущая',
            'next_text' => 'Следующая',
			) );

			if ( $links ) :
		?>

        <nav class="col-sm-12 text-center navi">
			<?php echo wp_kses_post( $links ); ?>
		</nav>

        <?php
			endif;
		}

	}

	define('WOODSTOCK_FUNCTIONS', get_template_directory() . '/functions');
	include_once( WOODSTOCK_FUNCTIONS . '/woo_options.php' ); // Woocommerce Options

	/*-----------------------------------------------------------------------------------*/
	/*	Sidebars
	/*-----------------------------------------------------------------------------------*/

	if ( function_exists('register_sidebar') )
    register_sidebar(array(
	'name' => esc_html__('Shop Sidebar', 'woodstock'),
	'id' => 'widgets-product-listing',
	'before_widget' => '<aside class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h4 class="widget-title">',
	'after_title'   => '</h4>',
	));

	function breadcrumbs( $sep = ' - ', $l10n = array(), $args = array() ){
		$kb = new Kama_Breadcrumbs;
		echo $kb->get_crumbs( $sep, $l10n, $args );
	}

	class Kama_Breadcrumbs {

		public $arg;

		// Локализация
		static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
		);

		// Параметры по умолчанию
		static $args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="kb_title">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
		// или можно указать свой массив разметки:
		// array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
		// Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
		// 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
		// порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
		);

		function get_crumbs( $sep, $l10n, $args ){
			global $post, $wp_query, $wp_post_types;

			self::$args['sep'] = $sep;

			// Фильтрует дефолты и сливает
			$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
			$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

			$arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

			// упростим
			$sep = & $arg->sep;
			$this->arg = & $arg;

			// микроразметка ---
			if(1){
				$mark = & $arg->markup;

				// Разметка по умолчанию
				if( ! $mark ) $mark = array(
				'wrappatt'  => '<div class="breadcrumbs">%s</div>',
				'linkpatt'  => '<a href="%s">%s</a>',
				'sep_after' => '',
				);
				// rdf
				elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
				);
				// schema.org
				elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'   => '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
				'sep_after'  => '',
				);

				elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

				$wrappatt  = $mark['wrappatt'];
				$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
				$arg->sep      .= $mark['sep_after']."\n";
			}

			$linkpatt = $arg->linkpatt; // упростим

			$q_obj = get_queried_object();

			// может это архив пустой таксы?
			$ptype = null;
			if( empty($post) ){
				if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
			}
			else $ptype = & $wp_post_types[ $post->post_type ];

			// paged
			$arg->pg_end = '';
			if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

			$pg_end = $arg->pg_end; // упростим

			// ну, с богом...
			$out = '';

			if( is_front_page() ){
				return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
			}
			// страница записей, когда для главной установлена отдельная страница.
			elseif( is_home() ) {
				$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
			}
			elseif( is_404() ){
				$out = $loc->_404;
			}
			elseif( is_search() ){
				$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
			}
			elseif( is_author() ){
				$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
				$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
			}
			elseif( is_year() || is_month() || is_day() ){
				$y_url  = get_year_link( $year = get_the_time('Y') );

				if( is_year() ){
					$tit = sprintf( $loc->year, $year );
					$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
				}
				// month day
				else {
					$y_link = sprintf( $linkpatt, $y_url, $year);
					$m_url  = get_month_link( $year, get_the_time('m') );

					if( is_month() ){
						$tit = sprintf( $loc->month, get_the_time('F') );
						$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
					}
					elseif( is_day() ){
						$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
						$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
					}
				}
			}
			// Древовидные записи
			elseif( is_singular() && $ptype->hierarchical ){
				$out = $this->_add_title( $this->_page_crumbs($post), $post );
			}
			// Таксы, плоские записи и вложения
			else {
				$term = $q_obj; // таксономии

				// определяем термин для записей (включая вложения attachments)
				if( is_singular() ){
					// изменим $post, чтобы определить термин родителя вложения
					if( is_attachment() && $post->post_parent ){
						$save_post = $post; // сохраним
						$post = get_post($post->post_parent);
					}

					// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
					$taxonomies = get_object_taxonomies( $post->post_type );
					// оставим только древовидные и публичные, мало ли...
					$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

					if( $taxonomies ){
						// сортируем по приоритету
						if( ! empty($arg->priority_tax) ){
							usort( $taxonomies, function($a,$b)use($arg){
								$a_index = array_search($a, $arg->priority_tax);
								if( $a_index === false ) $a_index = 9999999;

								$b_index = array_search($b, $arg->priority_tax);
								if( $b_index === false ) $b_index = 9999999;

								return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
							} );
						}

						// пробуем получить термины, в порядке приоритета такс
						foreach( $taxonomies as $taxname ){
							if( $terms = get_the_terms( $post->ID, $taxname ) ){
								// проверим приоритетные термины для таксы
								$prior_terms = & $arg->priority_terms[ $taxname ];
								if( $prior_terms && count($terms) > 2 ){
									foreach( (array) $prior_terms as $term_id ){
										$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
										$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

										if( $_terms ){
											$term = array_shift( $_terms );
											break;
										}
									}
								}
								else
								$term = array_shift( $terms );

								break;
							}
						}
					}

					if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
				}

				// вывод

				// все виды записей с терминами или термины
				if( $term && isset($term->term_id) ){
					$term = apply_filters('kama_breadcrumbs_term', $term );

					// attachment
					if( is_attachment() ){
						if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
						else {
							if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
								$_crumbs    = $this->_tax_crumbs( $term, 'self' );
								$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
								$_out = implode( $sep, array($_crumbs, $parent_tit) );
								$out = $this->_add_title( $_out, $post );
							}
						}
					}
					// single
					elseif( is_single() ){
						if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
							$_crumbs = $this->_tax_crumbs( $term, 'self' );
							$out = $this->_add_title( $_crumbs, $post );
						}
					}
					// не древовидная такса (метки)
					elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
						// метка
						if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
						// такса
						elseif( is_tax() ){
							$post_label = $ptype->labels->name;
							$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
							$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
						}
					}
					// древовидная такса (рубрики)
					else {
						if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
							$_crumbs = $this->_tax_crumbs( $term, 'parent' );
							$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
						}
					}
				}
				// влоежния от записи без терминов
				elseif( is_attachment() ){
					$parent = get_post($post->post_parent);
					$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
					$_out = $parent_link;

					// вложение от записи древовидного типа записи
					if( is_post_type_hierarchical($parent->post_type) ){
						$parent_crumbs = $this->_page_crumbs($parent);
						$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
					}

					$out = $this->_add_title( $_out, $post );
				}
				// записи без терминов
				elseif( is_singular() ){
					$out = $this->_add_title( '', $post );
				}
			}

			// замена ссылки на архивную страницу для типа записи
			$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

			if( '' === $home_after ){
				// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
				if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
				){
					$pt_title = $ptype->labels->name;

					// первая страница архива типа записи
					if( is_post_type_archive() && ! $paged_num )
					$home_after = $pt_title;
					// singular, paged post_type_archive, tax
					else{
						$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

						$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
						if ($pt_title=='Товары') $home_after='';
					}
				}
			}

			$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

			$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

			$out = sprintf( $wrappatt, $before_out . $out );

			return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
		}

		function _page_crumbs( $post ){
			$parent = $post->post_parent;

			$crumbs = array();
			while( $parent ){
				$page = get_post( $parent );
				$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
				$parent = $page->post_parent;
			}

			return implode( $this->arg->sep, array_reverse($crumbs) );
		}

		function _tax_crumbs( $term, $start_from = 'self' ){
			$termlinks = array();
			$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
			while( $term_id ){
				$term       = get_term( $term_id, $term->taxonomy );
				$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
				$term_id    = $term->parent;
			}

			if( $termlinks )
			return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
			return '';
		}

		// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
		function _add_title( $add_to, $obj, $term_title = '' ){
			$arg = & $this->arg; // упростим...
			$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чистится отдельно, теги могут быть...
			$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

			// пагинация
			if( $arg->pg_end ){
				$link = $term_title ? get_term_link($obj) : get_permalink($obj);
				$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
			}
			// дополняем - ставим sep
			elseif( $add_to ){
				if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
				elseif( $arg->last_sep )
				$add_to .= $arg->sep;
			}
			// sep будет потом...
			elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

			return $add_to;
		}

	}

	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<span class="widgettitle">',
		'after_title' => '</span>',
		));
	}

	function arphabet_widgets_init() {

		register_sidebar( array(
		'name'          => 'Shop',
		'id'            => 'shop',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
		) );

	}
	add_action( 'widgets_init', 'arphabet_widgets_init' );

	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
		'page_title' 	=> 'Опции сайта',
		'menu_title' 	=> 'Опции сайта',
		'menu_slug' 	=> 'option',
		'redirect' 	=> false
		));
	}

	function edit_admin_menus() {
		global $menu;

		$menu[5][0] = 'Статьи';
	}
	add_action( 'admin_menu', 'edit_admin_menus' );


	function news_init()
	{
		$labels = array(
		'name' => 'Новости', // Основное название типа записи
		'singular_name' => 'Новости', // отдельное название записи типа Book
		'add_new' => 'Добавить новую',
		'add_new_item' => 'Добавить новую запись',
		'edit_item' => 'Редактировать',
		'new_item' => 'Новая запись',
		'view_item' => 'Посмотреть запись',
		'search_items' => 'Найти запись',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'В корзине не найдено',
		'parent_item_colon' => '',
		'menu_name' => 'Новости'

		);
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'menu_icon' => 'dashicons-media-document',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt')
		);
		register_post_type('news',$args);
	}

	add_action('init', 'news_init');


	function brands_init()
	{
		$labels = array(
		'name' => 'Бренды', // Основное название типа записи
		'singular_name' => 'Бренды', // отдельное название записи типа Book
		'add_new' => 'Добавить бренд',
		'add_new_item' => 'Добавить новый бренд',
		'edit_item' => 'Редактировать',
		'new_item' => 'Новый бренд',
		'view_item' => 'Посмотреть запись',
		'search_items' => 'Найти запись',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'В корзине не найдено',
		'parent_item_colon' => '',
		'menu_name' => 'Бренды'

		);
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'menu_icon' => 'dashicons-clipboard',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
		);
		register_post_type('brands',$args);
	}

	//add_action('init', 'brands_init');


	function akcii_init()
	{
		$labels = array(
		'name' => 'Акции', // Основное название типа записи
		'singular_name' => 'Акции', // отдельное название записи типа Book
		'add_new' => 'Добавить акцию',
		'add_new_item' => 'Добавить новую акцию',
		'edit_item' => 'Редактировать',
		'new_item' => 'Новая акция',
		'view_item' => 'Посмотреть запись',
		'search_items' => 'Найти запись',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'В корзине не найдено',
		'parent_item_colon' => '',
		'menu_name' => 'Акции'

		);
		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'menu_icon' => 'dashicons-media-text',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt')
		);
		register_post_type('akcii',$args);
	}

	add_action('init', 'akcii_init');


	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
	remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
	/*
		// Register Custom Taxonomy
		function custom_brand_Item()  {

		$labels = array(
		'name'                       => 'Производители',
		'singular_name'              => 'Производитель',
		'menu_name'                  => 'Производители',
		'all_items'                  => 'Все производители',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'Добавить производителя',
		'add_new_item'               => 'Добавить производителя',
		'edit_item'                  => 'Редактировать',
		'update_item'                => 'Обновить',
		'separate_items_with_commas' => 'Separate Item with commas',
		'search_items'               => 'Search Items',
		'add_or_remove_items'        => 'Add or remove Items',
		'choose_from_most_used'      => 'Choose from the most used Items',
		);
		$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		);
		register_taxonomy( 'brand', 'product', $args );

		}
		add_action( 'init', 'custom_brand_Item', 0 );

		function custom_size_Item()  {

		$labels = array(
		'name'                       => 'Размеры',
		'singular_name'              => 'Размер',
		'menu_name'                  => 'Размеры',
		'all_items'                  => 'Все размеры',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'Добавить размер',
		'add_new_item'               => 'Добавить размер',
		'edit_item'                  => 'Редактировать',
		'update_item'                => 'Обновить',
		'separate_items_with_commas' => 'Separate Item with commas',
		'search_items'               => 'Search Items',
		'add_or_remove_items'        => 'Add or remove Items',
		'choose_from_most_used'      => 'Choose from the most used Items',
		);
		$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		);
		register_taxonomy( 'size', 'product', $args );

		}
		add_action( 'init', 'custom_size_Item', 0 );

		function custom_season_Item()  {

		$labels = array(
		'name'                       => 'Сезон',
		'singular_name'              => 'Сезон',
		'menu_name'                  => 'Сезон',
		'all_items'                  => 'Все сезоны',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'Добавить сезон',
		'add_new_item'               => 'Добавить сезон',
		'edit_item'                  => 'Редактировать',
		'update_item'                => 'Обновить',
		'separate_items_with_commas' => 'Separate Item with commas',
		'search_items'               => 'Search Items',
		'add_or_remove_items'        => 'Add or remove Items',
		'choose_from_most_used'      => 'Choose from the most used Items',
		);
		$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		);
		register_taxonomy( 'season', 'product', $args );

		}
		add_action( 'init', 'custom_season_Item', 0 );

		function custom_shoes_type_Item()  {

		$labels = array(
		'name'                       => 'Тип обуви',
		'singular_name'              => 'Тип обуви',
		'menu_name'                  => 'Тип обуви',
		'all_items'                  => 'Все типы обуви',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'Добавить тип обуви',
		'add_new_item'               => 'Добавить тип обуви',
		'edit_item'                  => 'Редактировать',
		'update_item'                => 'Обновить',
		'separate_items_with_commas' => 'Separate Item with commas',
		'search_items'               => 'Search Items',
		'add_or_remove_items'        => 'Add or remove Items',
		'choose_from_most_used'      => 'Choose from the most used Items',
		);
		$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		);
		register_taxonomy( 'shoes_type', 'product', $args );

		}
		add_action( 'init', 'custom_shoes_type_Item', 0 );
	*/

	add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
	function my_navigation_template( $template, $class ){
		/*
			Вид базового шаблона:
			<nav class="navigation %1$s" role="navigation">
			<h2 class="screen-reader-text">%2$s</h2>
			<div class="nav-links">%3$s</div>
			</nav>
		*/

		return '
		<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
		</nav>
		';
	}

	// выводим пагинацию
	the_posts_pagination( array(
	'end_size' => 2,
	) );


	add_action( 'after_setup_theme', 'remove_plugin_image_sizes', 999 );
	function remove_plugin_image_sizes(){
		remove_image_size( 'shop_thumbnail' );
		remove_image_size( 'shop_catalog' );
		remove_image_size( 'shop_single' );
	}
	function product_shop( $q ) {
		if (!$q->is_post_type_archive()) return;
		$q->set( 'tax_query', array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => array( 'collections' ),
				'operator' => 'IN'
			)
		));
	}
	
	add_action( 'woocommerce_product_query', 'product_shop', 10, 2 );
//Не проверять обновления
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
wp_clear_scheduled_hook( 'wp_update_plugins' );
add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');