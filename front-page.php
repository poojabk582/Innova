<?
/**
* The front page template file
* @package 24apotek
* @author 24apotek
* Template Name: Front Page
*/
get_header();

$arg = array( 
	'numberposts' => 8,
  	'post_type'   => 'banners',
  	'orderby' => 'publish_date',
  	'order' => 'DESC',
  	'suppress_filters' => false,
  	'tax_query' => array(
    array(
      'taxonomy' => 'banner-type',
      'field' => 'slug', 
      'terms'    => array( 'campaign-banner' ),
      'include_children' => false
    )),
);
$camp_banner = get_posts( $arg );
if ( count( $camp_banner ) > 4 ) {
	$camp_banner = array_chunk( $camp_banner, 4 );
	$camp_banner_first = isset( $camp_banner['0'] ) ? $camp_banner['0'] : array();
	$camp_banner_second = isset( $camp_banner['1'] ) ? $camp_banner['1'] : array();
}

do_action('24apotek_before_selling-points');
get_template_part('template-parts/home-page/selling-points');
do_action('24apotek_after_selling-points');

do_action('24apotek_before_banner');
get_template_part('template-parts/home-page/banner');
do_action('24apotek_after_banner');

do_action('24apotek_before_campaign-banner');
set_query_var('camp_banner',$camp_banner_first);
get_template_part('template-parts/home-page/campaign-banner');
do_action('24apotek_after_campaign-banner');

do_action('24apotek_before_trendings-products');
get_template_part('template-parts/home-page/trendings-products');
do_action('24apotek_after_trendings-products');

do_action('24apotek_before_campaign-banner');
set_query_var('camp_banner',$camp_banner_second);
get_template_part('template-parts/home-page/campaign-banner');
do_action('24apotek_after_campaign-banner');

do_action('24apotek_before_membership');
get_template_part('template-parts/home-page/membership');
get_template_part('template-parts/home-page/bundled-product');
do_action('24apotek_after_membership');

do_action('24apotek_before_tips-and-advice');
get_template_part('template-parts/home-page/tips-and-advice');
do_action('24apotek_after_tips-and-advice');

get_footer(); 
?>