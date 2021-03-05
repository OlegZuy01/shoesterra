<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
if ( ! empty( $attachment_ids ) ) {
	array_unshift( $attachment_ids, get_post_thumbnail_id() );
	}
	else $attachment_ids[0]=get_post_thumbnail_id();

if ( $attachment_ids ) {
?>

<div class="col-mb-12 col-md-5 col-sm-5 col-xsp-6">
	<div class="block">
        <div class="slider slider-single">
        <?php
            foreach ( $attachment_ids as $attachment_id ) {

                $classes = array( 'zoom' );
                $image_link = wp_get_attachment_url( $attachment_id );
                    if ( ! $image_link )
                        continue;
                    $image_title 	= esc_attr( get_the_title( $attachment_id ) );
                    $image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                        'title'	=> $image_title,
                        'alt'	=> $image_title
                        ) );

                    $image_class = esc_attr( implode( ' ', $classes ) );

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class=""><a href="%s" data-gal="prettyPhoto"><img class="img-responsive" src="%s"></a></div>', $image_link, $image_link), $attachment_id, $post->ID, $image_class );

                $loop++;
            }
        ?>
        </div>
        <div class="slider slider-nav">
            <?php
            foreach ( $attachment_ids as $attachment_id ) {

                $classes = array( 'zoom' );
                $image_link = wp_get_attachment_url( $attachment_id );
                if ( ! $image_link )
                    continue;
                $image_title 	= esc_attr( get_the_title( $attachment_id ) );
                $image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

                $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                    'title'	=> $image_title,
                    'alt'	=> $image_title
                ) );

                $image_class = esc_attr( implode( ' ', $classes ) );

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class=""><img class="img-responsive" src="%s"></div>', $image_link), $attachment_id, $post->ID, $image_class );

                $loop++;
            }
            ?>
        </div>

    </div>
</div>


<? } ?>