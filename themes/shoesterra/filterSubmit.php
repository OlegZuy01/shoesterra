<?php
require '../../../wp-load.php';
$getString = '';
$actual_link = $_SERVER['HTTP_REFERER'];
if(strpos($actual_link, '?')){
    $actual_link = substr($actual_link, 0, strpos($actual_link, '?'));
}
if(count($_POST['product_cat']) === 1){
    $slug = $_POST['product_cat'][0];
    $category = get_term_by( 'slug', $slug, 'product_cat' );
    $actual_link = get_term_link( $category->term_id, 'product_cat' );
    $excerpt = 'product_cat';
}

if(count($_POST['product_cat']) === 0 && count($_POST['pa_brjend']) === 1){
    $slug = $_POST['pa_brjend'][0];
    $category = get_term_by( 'slug', $slug, 'product_cat' );
    $actual_link = get_term_link( $category->term_id, 'product_cat' );
    $excerpt = 'pa_brjend';
    //$_POST['product_cat'] = [$_POST['parent-cat'],$slug];
}
if(count($_POST['product_cat']) === 0 && count($_POST['pa_brjend']) === 0){
    $slug = $_POST['parent-cat'];
    if($slug == 'brands'){
        $slug = 'muzhskaja-obuv';
    }
    $category = get_term_by( 'slug', $slug, 'product_cat' );
    $actual_link = get_term_link( $category->term_id, 'product_cat' );
}
if(isset($_POST['min_price']) && isset($_POST['max_price'])){
    if($_POST['min_price'] == $_POST['default_min_price'] && $_POST['max_price'] == $_POST['default_max_price']){
        unset($_POST['min_price']);
        unset($_POST['max_price']);
    } else {
        $_POST['min_price'] = conversPrice($_POST['min_price']);
        $_POST['max_price'] = conversPrice($_POST['max_price']);
    }
    unset($_POST['default_min_price']);
    unset($_POST['default_max_price']);
}
//if(empty($_POST['product_cat'])){
//   $_POST['product_cat'] = $_POST['parent-cat'];
//}
unset($_POST['parent-cat']);
$i = 0;
foreach($_POST as $key=>$values){
    if($excerpt != $key){
        if($i !== 0) {
            $getString .= '&';
        }
        if(strpos($key, 'pa_') !== false){
            $getString .= 'query_type_'.substr($key, 3).'=or&';
            $key = "filter_".substr($key, 3);
        }
        $getString .= $key.'=';
        $j = 0;
        if(gettype($values) == 'array'){
            foreach($values as $val){
                if($j !== 0){
                    $getString .= ',';
                }
                $getString .= $val;
                $j++;
            }
        } else {
            $getString .= $values;
        }
        $i++;
    }
} 

$finalLink = $actual_link;

if($getString != ''){
    $finalLink = $actual_link.'?'.$getString;
}
print_r(json_encode(['link' => $finalLink]));


function conversPrice( $pice ){
    $kurs_USD = get_field('kurs_dollara','option');
    $usdPricre = round($pice/$kurs_USD);
    return $usdPricre; 
}
?>