    <!-- Контент -->
    <section class="page-section no-padding-top with-sidebar brands">
        <div class="container">
	        <div class="row">
				<div class="col-xs-12"><h1>Бренды</h1></div>
				<div class="col-xs-12">

				    <?
    				foreach(get_terms(['hide_empty' => false, 'orderby' => "menu_order"]) as $term){
    				    if($term->parent == 335){
        				    $image = wp_get_attachment_url( get_term_meta( $term->term_id, 'thumbnail_id', true ));
        				    if($image != ''){?>
		    					<div class="col-md-3 col-6 single_brand"><a href="<?=get_term_link($term->term_id);?>"><img src="<?=$image?>" alt=""></a></div>

        				    <?}
    				    }
    				}
    				?>
				</div>
			</div>
		</div>
	</section>