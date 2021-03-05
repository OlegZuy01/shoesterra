<?php
	/**
		* Single Product Price, including microdata for SEO
		*
		* This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
		*
		* HOWEVER, on occasion WooCommerce will need to update template files and you
		* (the theme developer) will need to copy the new files to your theme to
		* maintain compatibility. We try to do this as little as possible, but it does
		* happen. When this occurs the version of the template file will be bumped and
		* the readme will list any important changes.
		*
		* @see     https://docs.woocommerce.com/document/template-structure/
		* @author  WooThemes
		* @package WooCommerce/Templates
		* @version 3.0.0
	*/

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $product;
?>


<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>"><?php echo $product->get_price_html(); ?></p>

<div class="" style="display:flex;justify-content:space-between;position:relative">
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

	<div class="sku_wrapper"><?php esc_html_e( 'Артикул: ', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></div>

	<?php endif; ?>

	<?	$proizvoditely = get_the_terms( $product->get_id(), 'pa_proizvoditel' );
		if ($proizvoditely != false){
			echo '<div class="atribut">Производитель: ';
			foreach( $proizvoditely as $proizvoditel ) {
				echo '<span>'.$proizvoditel->name.'</span>';
				
				
				
				
				
			}
			echo '</div>';
		}
	?>

	<?	$sezony = get_the_terms( $product->get_id(), 'pa_sezon' );
		if ($sezony != false){
			echo '<div class="atribut">Сезон: ';
			foreach( $sezony as $sezon ) {
				echo '<span>'.$sezon->name.'</span>';
			}
			echo '</div>';
		}
	?>


	<?	$materialy_verha = get_the_terms( $product->get_id(), 'pa_material-verha' );
		if ($materialy_verha != false){
			echo '<div class="atribut">Материал верха: ';
			foreach( $materialy_verha as $material_verha ) {
				echo '<span>'.$material_verha->name.'</span>';
			}
			echo '</div>';
		}
	?>

	<?	$materialy_podkladki = get_the_terms( $product->get_id(), 'pa_material-podkladki' );
		if ($materialy_podkladki != false){
			echo '<div class="atribut">Материал подкладки: ';
			foreach( $materialy_podkladki as $material_podkladki ) {
				echo '<span>'.$material_podkladki->name.'</span>';
			}
			echo '</div>';
		}
	?>

	<?	$materialy_podoshvy = get_the_terms( $product->get_id(), 'pa_material-podoshvy' );
		if ($materialy_podoshvy != false){
			echo '<div class="atribut">Материал подошвы: ';
			foreach( $materialy_podoshvy as $material_podoshvy ) {
				echo '<span>'.$material_podoshvy->name.'</span>';
			}
			echo '</div>';
		}
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

<?
$terms = get_the_terms( $product->get_id(), 'product_cat' );
if(count($terms) > 0){
foreach($terms as $term){
$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
$image = wp_get_attachment_url( $thumbnail_id );
?>
<img style="position: absolute;right: 0;top: -65px;width: 43%;" src="<?=$image?>" alt="">
<?
}
}
?>
</div>

<form class="product-size-form">
<?php
global $product;
if ( $product->is_type( 'variable' ) ) {
	$variations = $product->get_available_variations();


/*
	foreach($variations as $key => $value){
             if ($value['is_in_stock'] > 0){
        ?>
        <label for="product_size_<?php echo $key;?>"><?php echo $value['attributes']['attribute_pa_razmer'];?></label>
        <input type="radio" name="size" id="product_size_<?php echo $key;?>" class="product-size-input " value="<?php echo $value['variation_id']?>" data-type="variable">
        <?php
             }
    }
*/
foreach($variations as $key => $value){
    if ($value['is_in_stock'] > 0){
$meta = get_post_meta($value['variation_id'], 'attribute_pa_razmer', true);
$term = get_term_by('slug', $meta, 'pa_razmer');
?>
            <label for="product_size_<?php echo $key;?>"><?=$term->name?></label>
            <input type="radio" name="size" id="product_size_<?php echo $key;?>" class="product-size-input " value="<?php echo $value['variation_id']?>" data-type="variable">
<?
    }
}

} else {
    foreach(explode(', ' , $product->get_attribute('pa_razmer')) as $key=>$varProduct){
        ?>
        <label for="product_size_<?php echo $key;?>"><?php echo $varProduct;?></label>
        <input type="radio" name="size" id="product_size_<?php echo $key;?>" class="product-size-input" value="<?php echo $product->ID;?>" data-type="simple">
        <?php
    }
}

?>
</form>
<div class="single-product-action-quantity fix">
	<div class="pro-details-action float-left">
		<p>Наличие размеров, моделей и стоимость уточняйте у продавца</p>
		<a style="cursor:pointer" class="pro-details-act-btn btn-text active basket-btn add-to-card" >ДОБАВИТЬ В КОРЗИНУ</a>
		<a style="cursor:pointer" class="pro-details-act-btn btn-text active open_modal modal-bron-form-button" onclick="">ЗАБРОНИРОВАТЬ ПАРУ</a>
    	<a style="cursor:pointer" class="pro-details-act-btn btn-text active open_modal gde-kupit-modal-button" onclick="yaCounter49928083.reachGoal('GDE-KUPIT'); return true;"><i class="zmdi zmdi-shopping-cart"></i>Где купить?</a>
		<?
		
		$cur_terms = get_the_terms( $product->get_id(), 'product_cat' );
// 		print_r($cur_terms);
if( is_array( $cur_terms ) ){
	foreach( $cur_terms as $cur_term ){
// 		echo $cur_term->name;
		if($cur_term->name=='Женская обувь'){
		            ?>
		            <style>
		                .siza-m{
		                    display:none;
		                }
		            </style>
		            <?
		        }
		if($cur_term->name=='Мужская обувь'){
		            ?>
		            <style>
		                .siza-w{
		                    display:none;
		                }
		            </style>
		            <?
		        }
	}
}
		
		?>
	</div>
</div>