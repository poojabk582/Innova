<?
/**
* The page default contact Us
* @package Apotek 24
* @author Apotek 24
* Template Name: Bundle Products
*/
get_header();
?>
<?
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 30,
    'post_status' => 'publish',
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'meta_query' => array(
        array(
            'key' => 'bundled_product',
            'value'   => '"yes"',
            'compare' => 'LIKE'
        )
    )
);
?>
<div class="shop__main-wrapper section-pd-top-50 section-pd-bottom-100">
	<div class="container">
		<div class="trendings-products__title-section text-center">
			<h2><? the_title(); ?></h2>
			<p><? the_content(); ?></p>
		</div>
		<div class="bundled-page__wrapper section-pd-top-50">
			<main id="primary" class="site-main">
				<div class="trending-products ">
					<div class="trending-products__section-wrap">
						<div class="woocommerce columns-4 trending-products template_treanding_product">
							<ul class="products columns-4">
								<? $the_query =new WP_Query( $args );
								if( $the_query->have_posts() ) {
									while( $the_query->have_posts() ) { 
										$the_query->the_post();
										wc_get_template_part( 'content', 'product' );
									}
								}
								 ?>
							</ul>
							<div class="load-more text-center section-pd-top-50">
								<div class="load-more">
									<a data-max_page="<? echo $the_query->max_num_pages; ?>" id="apotek24-brands-more" class="apotek24-load-more btn-white">
										<? _e('LAST INN FLERE','24apotek'); ?><p></p>
									</a>
								</div>
							</div>
						</div>
						<? wp_reset_query();?>
					</div>
				</div>
			</main>
			<? do_action( 'woocommerce_sidebar' );?>
		</div>
	</div>
</div>

<?
get_footer();