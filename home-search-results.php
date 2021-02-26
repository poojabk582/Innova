<?

$uncategorized = get_option( 'default_product_cat' );
					$args = array(
                		'taxonomy'      => array( 'product_cat' ), // taxonomy name
                		'hide_empty'    => true,
                		'orderby'       => 'name', 
                		'order'         => 'ASC',
                		'fields'        => 'all',
                		 'exclude' => $uncategorized,
                		'name__like'    => $search,
                		//'search'        => $search
		            ); 
$terms = get_terms( $args );
$args = array( 
			"post_type" => "product",
			'post_status' => 'publish',
			'posts_per_page'    => 5,	 
			"s" => $search 
		);
query_posts( $args );
$count = count($terms);
$args = array(
	'taxonomy'      => array( 'pa_merke' ), // taxonomy name
	'hide_empty'    => true,
	'orderby'       => 'name', 
	'order'         => 'ASC',
	'fields'        => 'all',
	'name__like'    => $search,
	//'search'        => $search
 );
$brands = get_terms( $args );
$brand_count = count( $brands );
if( have_posts() || $count > 0 ||  $brand_count > 0 ) {
?>
	<div class="search-suggestion__row">
		<? 
		
		if( have_posts() ) {
			?>
			<div class="search-suggestion__col-prod">
				<?
				while( have_posts() ) { 
					the_post();
					global $product;
					?>
					<div class="search-suggestion__product">
						<div class="search-suggestion__prod-wrapper">
							<div class="search-suggestion__product-img">
								<a href="<? echo $product->get_permalink();?>">
									<? echo get_the_post_thumbnail($post,'mementor_100',array('class' => 'prod-thumb-image' ) ) ?>
									<!--<span class="prod-thumb-image" style="background-image:url('<? echo get_the_post_thumbnail_url( $product_id ) ?>'); ">-->
									<!--</span>-->
								</a>
								</div>
							<a href="<? echo $product->get_permalink();?>">
								<h2><? echo $product->get_name() ?></h2>
							</a>
						</div>
						<div class="woocommerce price-wrapper">
							<div class="price">
									<? 
								if( is_user_logged_in() ) {
									$membership = get_membership_name_and_url( get_current_user_id() );
								} else {
									$membership = array();
								}
								$regular_price = wc_get_price_to_display( $product, array(
									'price' => $product->get_regular_price(),
									'qty'   => 1
								) );
								$_price = wc_get_price_to_display( $product, array(
																	'price' => $product->get_price(),
																	'qty'   => 1
																) );							
								if ( !empty( $membership ) || $product->is_on_sale() ) { ?>
								<div class="regular-price">
									<span class="regular-price-text"><?_e('Regular Price','24apotek');?></span>
									<span><del><? echo wc_price( $regular_price );?></del></span>
								</div>									
								<? } else { ?>
									<div class="regular-price">
										<span class="regular-price-text"><?_e('Regular Price','24apotek');?></span>								
										<span><? echo wc_price( $regular_price );?></span>							
									</div>
								<? }
									if ( !empty( $membership ) || $product->is_on_sale() ) { ?>							
									<div class="sale-price">
										<span class="sale-price-text"><?_e('Your Price','24apotek');?></span>
										<span><? echo wc_price( $_price ); ?></span>
									</div>							
								<? } ?>	
							</div>
													
						</div>
					</div>
					<?
				}
				?>
				<div class="search-suggestion__view-all">
					<a href="<? echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><? _e('View All','24apotek'); ?> <img src="<? echo get_template_directory_uri(); ?>/images/arrow_right_hover.png" alt="arrow_right_hover"> </a>
				</div>
			</div>
			<? } else { ?>
				<h6><? _e('No products','24apotek' ); ?></h6>	
			<? }?>
		<div class="search-suggestion__col-cat">
			<div class="search-suggestion__cat-row">
				<?
        		$count = count($terms);
        		if ( $count > 0 ) {
        			?>
				<div class="search-suggestion__category-col">
					
        			<h3><? _e( 'Categories','24apotek' ); ?></h3>
        			<ul>
        				<?
        				foreach ( $terms as $key => $term ) {
        
        					?>
        					<li>
        						<a href="<? echo get_term_link( $term ); ?>"><? echo $term->name;?></a>
        					</li>
        					<?
        				} ?>
        			</ul>
        		
        		</div>
        		<? }  else {?>
        		  <h6><? _e('No Categories','24apotek' ); ?></h6>	
        		<? } ?>
				<div class="search-suggestion__brands-col">
				<?
				

		$brand_count = count( $brands );
		if ( $brand_count > 0  ) {
			?>
			<h3><? _e( 'Brands','24apotek' ); ?></h3>
			<ul>
				<?
				foreach ( $brands as $key => $brand ) {
					?>
					<li>
						<a href="<? echo get_term_link( $brand ); ?>"><? echo $brand->name.' ('.$brand->count.')';?></a>
					</li>
					<?
				} ?>
			    <? } else {?>
        		  <h6><? _e('No Brands','24apotek' ); ?></h6>	
        		<? } ?>
			</ul>
				</div>
				<div class="search-suggestion__close-col">
					<div class="search-close">
						<span></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<? } ?>