<?
/* The template for displaying search results pages */

get_header();
?>
<div class="search-page__wrapper section-pd-top-50 section-pd-bottom-100">
	<div class="container">
		<? if ( have_posts() ) { ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
					printf( __( 'Search Results "%s"', '24apotek' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				<p class="search-page__results">
					<? _e('Returned','24apotek'); ?>
					<a href="#"><? _e('18 of 2784','24apotek'); ?></a>
					<? _e('results','24apotek'); ?>
				</p>
			</header><!-- .page-header -->
			<div class="shop-filter-mob">
				<a id="shop__filter-button" data-toggle="modal" data-target="#shop-filter-modal" ><? _e('open filters','24apotek'); ?></a>
			</div>
			<!-- Shop-Filter-Popup -->
			<div class="shop-filter-modal">
				<!-- Modal -->
				<div class="modal fade" id="shop-filter-modal" tabindex="-1" role="dialog" aria-labelledby="shop-filter-modal-title" aria-hidden="true">
				    <div class="modal-dialog modal-dialog-centered" role="document">
				        <div class="modal-content">
				            <div class="modal-body shop-filter__main-wrapper">
							    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          	    <span aria-hidden="true"></span>
					            </button>
					           <div class="shop-page__sidebar-mob">
				        		</div>
					            <div class="shop-modal-filter-btn">
									<a class="btn-blue-filled"><? _e('ok','24apotek'); ?></a>
								</div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<!-- End-Of-Modal -->
		<? } ?>
		<div class="Search-page__main-wrap section-pd-top-50">
			<main id="primary" class="site-main">
				<form class="woocommerce-ordering" method="get">
					<div class="dropdown orderby">
						<button class="orderby__nav-button btn dropdown-toggle" type="button" id="orderby_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<? _e('Sort By','24apotek'); ?>
						</button>
						<div class="dropdown-menu" aria-labelledby="orderby_dropdown">
							<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
								<a class="dropdown-item" value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></a>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="filter-by-brands">
						<a><? _e('Filter by Brands','24apotek'); ?> <img src="<? echo get_template_directory_uri() . '/images/arrow_right_hover.png'; ?>" alt="arrow_right_hover"> </a>
					</div>		
					<input type="hidden" name="paged" value="1" />
					<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
				</form>	
				<div class="woocommerce">
					<ul class="products columns-3">
						<?
						// woocommerce_product_loop_start();
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						?>
					</ul>
					<div class="load-more text-center section-pd-top-50">
						<div class="load-more-wrap">
							<a id="apotek24-load-more" class="apotek24-load-more btn-white">
								<? _e('LOAD MORE','24apotek'); ?>
							</a>
						</div>
					</div>
				</div>	

			</main>
	
<?php
get_sidebar();
?>
</div>
</div>
</div>
<?
get_footer();
