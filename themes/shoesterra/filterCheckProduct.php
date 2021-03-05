<?php
require '../../../wp-load.php';
global $wp_query;
$args = [];
if(isset($_POST['min_price']) && isset($_POST['max_price'])){
    if($_POST['min_price'] != $_POST['default_min_price'] || $_POST['max_price'] != $_POST['default_max_price']){
        $_POST['_price'] = array(conversPrice($_POST['min_price']),conversPrice($_POST['max_price']));
    }
    unset($_POST['min_price']);
    unset($_POST['max_price']);
    unset($_POST['default_min_price']);
    unset($_POST['default_max_price']);
}
if(empty($_POST['product_cat']) && empty($_POST['pa_brjend'])){
   $_POST['product_cat'] = $_POST['parent-cat'];
   if($_POST['product_cat'] == 'brands'){
        $_POST['product_cat'] = 'muzhskaja-obuv';
    }
}
unset($_POST['parent-cat']);
$metaQuery = '';
foreach($_POST as $tax=>$values){
    if($tax == '_price'){
        $metaQuery = array(
            array(
                'key' => '_price',
                'value' => $values,
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            )
        );
    } else {
        $arr = [
            'taxonomy' => $tax,
            'field'    => 'slug',
    		'terms'    => $values
        ];
        array_push($args, $arr);
    }
}
$query = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => -1,
    'meta_query' => array(
        $metaQuery,
        array(
            'key' => '_stock_status',
            'value' => 'instock'
        ),),
	'tax_query' => $args
]);
print_r(json_encode(['number' => $query->found_posts]));

function conversPrice( $pice ){
    $kurs_USD = get_field('kurs_dollara','option');
    $usdPricre = round($pice/$kurs_USD);
    return $usdPricre; 
}