<?
/**
 * The template for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package samtalen
 */
?>
<div class="container">
	<form action="/" method="get" class="search-form search-form-desk">
	  	<div class="search-bar-section-wrapper">
		    <div class="search-bar-icon-image">
		    	<img class="svg" src="<? echo get_template_directory_uri() . '/images/search_icon_dark_2@x.svg'; ?>" alt="search_icon.svg">
		    </div>
	      	<input class="search-bar search" type="text" name="s" placeholder="<? _e('Search','24apotek'); ?>" value="<?php the_search_query();?>" autocomplete="off" autofocus="true" />
	      <input class="btn-black searchsubmit" type="submit" value="<? _e('Search','24apotek'); ?>" />
	    </div>
	</form>
</div>


<div class="search-suggestion">
</div> 
