<form role="search" method="get" id="searchform" class="search-form" action="<?php echo get_option("siteurl");?>">
	<label for="s" class="sr-only">Search for:</label>
	<input type="search" class="search-field" placeholder="I need help finding…" value="" id="s" name="s">
	<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
	<div class="search-error">
		Please enter a search term
	</div>
</form>
