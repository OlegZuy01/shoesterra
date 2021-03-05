<form id="product_filter">
    <div class="filter-info-btn">
        <span class="info">
            Выбрано товаров: <span class="info-number"><span></span><img src="/wp-content/uploads/2021/02/preloader-black-1.gif"></span>
        </span>
        <button>показать</button>
    </div>
    <ul class="product_filter">
        <input type="hidden" name="parent-cat" value="<?=get_queried_object()->slug?>">
        <?if(get_queried_object()->term_id == 16 || get_queried_object()->term_id == 17){
            echo "<input type=\"hidden\" name=\"parent-cat\" value=\"".get_queried_object()->slug."\">";
        } else {
            echo "<input type=\"hidden\" name=\"parent-cat\" value=\"".get_term_by( 'id', get_queried_object()->parent, 'product_cat' )->slug."\">";
        }?>
        <?/*if(!empty($_GET['product_cat'])){
            foreach(explode(',',$_GET['product_cat']) as $val){
                if($val == "muzhskaja-obuv") {
                    echo "<input type=\"hidden\" name=\"parent-cat\" value=\"muzhskaja-obuv\">";
                }elseif($val == 'zhenskaja-obuv'){
                    echo "<input type=\"hidden\" name=\"parent-cat\" value=\"zhenskaja-obuv\">";
                }     
            }
        }*/?>
    <?
    $filterArr = get_field('product_filter', 'option');
    
    foreach($filterArr as $key1=>$filterElem){
        switch(true){
            case strpos($filterElem['tax'], 'product_cat_') === 0 :
                $cat = get_term_by( 'slug', substr($filterElem['tax'],12), 'product_cat' );
                $cat_id = $cat->term_id;
                ?>
                <li class="parent-li has-toogle <?=$filterElem['tax']?>"><span><?=$filterElem['title']?></span>
                    <ul class="product-filter-toogle"><?
                   
                    foreach(get_terms(array('taxonomy' => 'product_cat', 'parent' => $cat_id)) as $key2=>$term){
                        ?>
                        <li>
                            <input id="<?=$key1?>-<?=$key2?>" name="product_cat[]" type="checkbox" value="<?=$term->slug?>"<?
                                if(get_queried_object()->slug == $term->slug){
                                    echo "checked";
                                } else {
                                    foreach(explode(',', $_GET['product_cat']) as $getVal){
                                        if($getVal == $term->slug){
                                            echo "checked";
                                        }
                                    }
                                }
                                ?>>
                            <label for="<?=$key1?>-<?=$key2?>"><?=$term->name?></label>
                        </li>
                        <?
                    }
                    ?></ul>
                </li><?
                continue;
            
            case strpos($filterElem['tax'], 'pa_') === 0 :
                ?>
                <li class="parent-li has-toogle <?=$filterElem['tax']?>"><span><?=$filterElem['title']?></span>
                    <ul class="product-filter-toogle"><?
                    foreach(get_terms($filterElem['tax']) as $key2=>$term){
                        ?>
                        <li>
                            <input id="<?=$key1?>-<?=$key2?>" name="<?=$filterElem['tax']?>[]" type="checkbox" value="<?=$term->slug?>"
                                <?foreach($_GET as $getKey=>$getVals){
                                    if(substr($getKey, 7) == substr($filterElem['tax'], 3)){
                                        foreach(explode(',', $_GET[$getKey]) as $getVal){
                                            if($getVal == $term->slug){
                                                echo "checked";
                                            }
                                        }
                                    }
                                    
                                }
                                foreach(explode(',', $_GET['product_cat']) as $getVal){
                                        if($getVal == $term->slug){
                                            echo "checked";
                                        }
                                    }
                                if(get_queried_object()->slug == $term->slug){
                                    echo "checked";
                                }?>
                            >
                            
                            <label for="<?=$key1?>-<?=$key2?>"><?=$term->name?></label>
                        </li>
                        <?
                    }
                    ?></ul>
                </li><?
                continue;
                
            case strpos($filterElem['tax'], '_cat_') === 0 : 
                ?>
                <li class="single-cat">
                    <input <?if(get_queried_object()->slug == substr($filterElem['tax'], 5)){echo "checked";}?> id="<?=$filterElem['tax']?>" name="product_cat[]" type="checkbox" value="<?=substr($filterElem['tax'], 5)?>">
                    <label for="<?=$filterElem['tax']?>"><?=$filterElem['title']?></label>
                </li>
                <?
                continue;
                
            case $filterElem['tax'] == '_price' : 

                $active = false;
        	    $kurs_USD = get_field('kurs_dollara','option');
                if(isset($_GET['min_price']) && $_GET['min_price'] != ''){
                    $min = $_GET['min_price'];
                    $active = true;
                    $min_byn = round($min*$kurs_USD);
                }else {
                    $min_byn = 50;
                }
                if(isset($_GET['max_price']) && $_GET['max_price'] != ''){ 
                    $max = $_GET['max_price'];
                    $active = true;
                    $max_byn = round($max*$kurs_USD);
                }else {
                    $max_byn = 800;
                }
                ?>
                <input type="hidden" name="default_min_price" value="<?=$min_byn?>">
                <input type="hidden" name="default_max_price" value="<?=$max_byn?>">
                <li>
                    <span>Цена <span>
                    <div class="price-slider">
                        <span>
                            <input type="number" placeholder="<?=$min_byn?>" <?if($active){echo "value={$min_byn}";}?> min="50" max="800"/>
                            <span class="line"></span>
                            <input type="number" placeholder="<?=$max_byn?>" <?if($active){echo "value={$max_byn}";}?> min="50" max="800"/>
                        </span>
                        <input name="min_price" value="<?=$min_byn?>"  min="50" max="800" step="1" type="range"/>
                        <input name="max_price" value="<?=$max_byn?>"  min="50" max="800" step="1" type="range"/>
                    </div>
                </li>
                <?
                continue;
                
        }
        
        
    }
    
    ?>
    </ul>
    <span>
        <p class="reset-btn">Сбросить</p>
        <button class="filter-btn">Применить</button>
    </span>
</form>