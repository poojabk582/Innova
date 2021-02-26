<?
/**
* The page default contact Us
* @package Apotek 24
* @author Apotek 24
* Template Name: Brands List
*/
get_header();
global $wpdb;
$options = array( 'hide_empty' => false );
$terms = get_terms('pa_merke', $options );
?>
<div class="brands-list section-pd-top-50 section-pd-bottom-100">
	<div class="container">
		<header class="entry-header">
			<h1 class="entry-title"><? the_title(); ?></h1>
		</header>
		<div class="brands-list__search-wrapper">
			<div class="brands-search-bar">
			    <input class="search-bar" type="text" name="s" placeholder= <? _e('Search', '24apotek'); ?> id="search" value="" autocomplete="off">
				<div class="brands-search-icon">
					<img srcset="<? echo get_template_directory_uri(); ?>/images/search_icon-2x.png" src="<? echo get_template_directory_uri(); ?>/images/search_icon.png" alt="search_icon.png">
				</div>
			</div>
		</div>
		<div class="brands-list__pagination-wrapper brands-list__pagination-desktop">
			<ul class="brands-list__pagination"> 
				<li data-selector=".a" class=""><a><? _e('A','24apotek');?></a></li> 
				<li data-selector=".b" class=""><a><? _e('B','24apotek');?></a></li> 
				<li data-selector=".c" class=""><a><? _e('C','24apotek');?></a></li> 
				<li data-selector=".d" class=""><a><? _e('D','24apotek');?></a></li> 
				<li data-selector=".e" class=""><a><? _e('E','24apotek');?></a></li>
				<li data-selector=".f" class=""><a><? _e('F','24apotek');?></a></li>
				<li data-selector=".g" class=""><a><? _e('G','24apotek');?></a></li>
				<li data-selector=".h" class=""><a><? _e('H','24apotek');?></a></li>
				<li data-selector=".i" class=""><a><? _e('I','24apotek');?></a></li>
				<li data-selector=".j" class=""><a><? _e('J','24apotek');?></a></li>
				<li data-selector=".k" class=""><a><? _e('K','24apotek');?></a></li>
				<li data-selector=".l" class=""><a><? _e('L','24apotek');?></a></li>
				<li data-selector=".m" class=""><a><? _e('M','24apotek');?></a></li>
				<li data-selector=".n" class=""><a><? _e('N','24apotek');?></a></li>
				<li data-selector=".o" class=""><a><? _e('O','24apotek');?></a></li>
				<li data-selector=".p" class=""><a><? _e('P','24apotek');?></a></li>
				<li data-selector=".q" class=""><a><? _e('Q','24apotek');?></a></li>
				<li data-selector=".r" class=""><a><? _e('R','24apotek');?></a></li>
				<li data-selector=".s" class=""><a><? _e('S','24apotek');?></a></li>
				<li data-selector=".t" class=""><a><? _e('T','24apotek');?></a></li>
				<li data-selector=".u" class=""><a><? _e('U','24apotek');?></a></li>
				<li data-selector=".v" class=""><a><? _e('V','24apotek');?></a></li>
				<li data-selector=".w" class=""><a><? _e('W','24apotek');?></a></li>
				<li data-selector=".x" class=""><a><? _e('X','24apotek');?></a></li>
				<li data-selector=".y" class=""><a><? _e('Y','24apotek');?></a></li>
				<li data-selector=".z" class=""><a><? _e('Z','24apotek');?></a></li>
			</ul> 
		</div>
		<div class="brands-list__pagination-wrapper brands-list__pagination-mob">
			<ul id="brands-list-slider" class="brands-list__pagination"> 
					<li data-selector=".a" class=""><a><? _e('A','24apotek');?></a></li> 
				<li data-selector=".b" class=""><a><? _e('B','24apotek');?></a></li> 
				<li data-selector=".c" class=""><a><? _e('C','24apotek');?></a></li> 
				<li data-selector=".d" class=""><a><? _e('D','24apotek');?></a></li> 
				<li data-selector=".e" class=""><a><? _e('E','24apotek');?></a></li>
				<li data-selector=".f" class=""><a><? _e('F','24apotek');?></a></li>
				<li data-selector=".g" class=""><a><? _e('G','24apotek');?></a></li>
				<li data-selector=".h" class=""><a><? _e('H','24apotek');?></a></li>
				<li data-selector=".i" class=""><a><? _e('I','24apotek');?></a></li>
				<li data-selector=".j" class=""><a><? _e('J','24apotek');?></a></li>
				<li data-selector=".k" class=""><a><? _e('K','24apotek');?></a></li>
				<li data-selector=".l" class=""><a><? _e('L','24apotek');?></a></li>
				<li data-selector=".m" class=""><a><? _e('M','24apotek');?></a></li>
				<li data-selector=".n" class=""><a><? _e('N','24apotek');?></a></li>
				<li data-selector=".o" class=""><a><? _e('O','24apotek');?></a></li>
				<li data-selector=".p" class=""><a><? _e('P','24apotek');?></a></li>
				<li data-selector=".q" class=""><a><? _e('Q','24apotek');?></a></li>
				<li data-selector=".r" class=""><a><? _e('R','24apotek');?></a></li>
				<li data-selector=".s" class=""><a><? _e('S','24apotek');?></a></li>
				<li data-selector=".t" class=""><a><? _e('T','24apotek');?></a></li>
				<li data-selector=".u" class=""><a><? _e('U','24apotek');?></a></li>
				<li data-selector=".v" class=""><a><? _e('V','24apotek');?></a></li>
				<li data-selector=".w" class=""><a><? _e('W','24apotek');?></a></li>
				<li data-selector=".x" class=""><a><? _e('X','24apotek');?></a></li>
				<li data-selector=".y" class=""><a><? _e('Y','24apotek');?></a></li>
				<li data-selector=".z" class=""><a><? _e('Z','24apotek');?></a></li>
			</ul> 
		</div>
		<div class="brands-list__brands-listing-wrap section-pd-top-50 brands-list__brands-listing-desktop">
			<div class="brands-list__row ">
				<div class="brands-list__col">
					<ul class="brands-list__listing grid brands-list__main-listing">
						<? if(!empty( $terms) ) {
							  foreach ( $terms as $key => $value) { 
							  	$link = get_category_link( $value->term_id );
							  	$name = $value->name;
							  	$choices = get_field('hide_on_the_archive_page', $value );
							  	 if( empty( $choices ) ) {
							  	?>
								<li class="grid-item  <? echo strtolower( substr( $name,0,1) ); ?>"><a href="<? echo $link; ?>"><? echo $name ?></a></li>
							<? } 
							  		
							 } 
						} ?>
					</ul>
				</div>
			
			</div>
			<div class="show-all-brands"><a href="#" class="btn-white"><? _e('SHOW ALL BRANDS','24apotek'); ?></a></div>
		</div>
		<div class="brands-list-membership">
			<?
			get_template_part('template-parts/home-page/membership');
			?>
		</div>
	</div>
</div>
<?
get_footer();