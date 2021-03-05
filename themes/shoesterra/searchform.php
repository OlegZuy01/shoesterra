<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
	<input type="text" placeholder="Введите текст для поиска" value="<?php echo get_search_query() ?>" name="s" id="s" autocomplete="off" />
	<input type="submit" id="searchsubmit" value=" " />
</form>