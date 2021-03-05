<?php
	/**
		* The template for displaying product content within loops
		*
		* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
	
	// Ensure visibility
	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}
?>
<div class="modal-cart modal-category-cart" id="<?=$product->get_id();?>">
    <div class="inner">
        <p>Пожалуйста, выберите имеющийся в наличии размер</p>
        <form class="product-size-form" data-product-id="<?=$product->get_id();?>">
            <?php
            if ( $product->is_type( 'variable' ) ) {
            	$variations = $product->get_available_variations();
            	foreach($variations as $key => $value){
                    ?>
                    <label for="product_<?=$product->get_id();?>_size_<?php echo $key;?>"><?php echo $value['attributes']['attribute_pa_razmer'];?></label>
                    <input type="radio" name="size" id="product_<?=$product->get_id();?>_size_<?php echo $key;?>" class="product-size-input" value="<?php echo $value['variation_id']?>">
                    <?php
                }
            } else {
                foreach(explode(', ' , $product->get_attribute('pa_razmer')) as $key=>$varProduct){
                    ?>
                    <label for="product_<?=$product->get_id();?>_size_<?php echo $key;?>"><?php echo $varProduct;?></label>
                    <input type="radio" name="size" id="product_<?=$product->get_id();?>_size_<?php echo $key;?>" class="product-size-input">
                    <?php
                }
            }
            ?>
        </form>
        <div class="btn-cont">
            <a style="cursor:pointer" class="pro-details-act-btn btn-text active basket-btn add-to-card" >ДОБАВИТЬ В КОРЗИНУ</a>
            <button class="close-modal">Закрыть</button>
        </div>
        <p class="close-modal-small"></p>
    </div>
</div>
<div <?php post_class('col-md-4 col-sm-6 col-xsp-6'); ?>>
	<div class="thumbnail no-border no-padding">
		<div class="media">
		    <?php $hasMark=false; ?>
			<? if( is_object_in_term( $product->get_id(), 'product_cat', 'novinki')) { 
			    $hasMark = true;?>
    			<div class="new novinka">Новинка!</div>
    		<? } ?>
			<?if ( $product->is_on_sale() ) { 
			    $hasMark = true;
			?>
				<?echo apply_filters( 'woocommerce_sale_flash', '<span class="new skidka"> -' .esc_html__( 'Sale!', 'woocommerce' ). '%</span>', $post, $product ); ?>
			<?}?>
			<?$image=get_the_post_thumbnail_url($product->get_id());?>
			<div class="product-image <? if($hasMark){ echo "margin-top-low";}?>" style="background:url(<?=$image;?>) 50% 50% / 100%; background-size: contain;background-repeat: no-repeat;background-color: #fdfdfd;"></div>
			<div class="caption hovered">
				<div class="caption-wrapper div-table">
					<div class="caption-inner div-cell">
						<p class="caption-buttons">
							<a class="btn btn-theme caption-view-more" href="<?php echo esc_url( $product->get_permalink() ); ?>">Подробнее</a>
							<a class="btn btn-theme caption-view-more btn-modal-category-cart" data-modal="<?= $product->get_id();?>">В корзину</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="caption">
			<div class="caption-prices">
			    <span class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>"><?php echo $product->get_price_html(); ?></span>
			</div>
			<?the_title( '<div class="caption-title">', '</div>' );?>
		</div>
	</div>
</div>			