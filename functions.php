<?
if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}
/* Setup the needed thing for the theme */
add_action( 'after_setup_theme', 'apotek24_setup' );
if ( ! function_exists( 'apotek24_setup' ) ) {
	
	function apotek24_setup() {
		
		load_theme_textdomain( '24apotek', get_template_directory() . '/languages' );

		
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '24apotek' ),
				'footer-menu' => esc_html__( 'footer-menu', '24apotek' ),
			)
		);

		
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_theme_support(
			'custom-background',
			apply_filters(
				'apotek24_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
}

/* Force Klarna Checkout for ever ever, and ever ever */
add_action('template_redirect', 'force_klarna_checkout');
function force_klarna_checkout() {
    if ((is_cart() || is_checkout()) && !is_wc_endpoint_url()) {
        WC()->session->set('chosen_payment_method', 'kco');
    }
}

/* Display Klarna Checkout even on free orders */
add_filter('kco_check_if_needs_payment', 'kco_change_check_if_needs_payment');
function kco_change_check_if_needs_payment($bool) {
    return false;
}

/* Shop manager editable roles */
add_filter('woocommerce_shop_manager_editable_roles', 'wws_allow_shop_manager_role_edit_capabilities');
function wws_allow_shop_manager_role_edit_capabilities($roles) {
	$roles= array(
		'customer',
		'contributor',
		'shop_manager',
		'premium',
		'gold',
		'vip-plus',
		'preium-plus',
		'gold-plus'
	);
	return $roles;
}

/* Set the content width in pixels, based on the theme's design and stylesheet. */
add_action( 'after_setup_theme', 'apotek24_content_width', 0 );

if (!function_exists('apotek24_content_width')) {
	function apotek24_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'apotek24_content_width', 640 );
	}
}


/* Register widget area. */
add_action( 'widgets_init', 'apotek24_widgets_init' );
if (!function_exists('apotek24_widgets_init')) {
	function apotek24_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', '24apotek' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', '24apotek' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}



/* Enqueue scripts and styles. */
add_action( 'wp_enqueue_scripts', 'apotek24_scripts' );
if (!function_exists('apotek24_scripts')) {
	function apotek24_scripts() {
		global $wp_query;
		/* Deregister Jquery UI */
		$jquery_ui = array(
	        //"jquery-ui-widget",
	        //"jquery-ui-mouse",
	        "jquery-ui-accordion",
	        "jquery-ui-autocomplete",
	        //"jquery-ui-slider",
	        "jquery-ui-tabs",   
	        "jquery-ui-draggable",
	        "jquery-ui-droppable",
	        "jquery-ui-selectable",
	        "jquery-ui-position",
	        "jquery-ui-datepicker",
	        "jquery-ui-resizable",
	        "jquery-ui-dialog",
	        "jquery-ui-button"
	    );
	    wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-touch-punch' );
	    if( is_checkout() ) {
	    	foreach($jquery_ui as $script){
	        	wp_deregister_script($script);
	    	}	
	    }
	    
    
    	/*css-enqueue*/
		
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_style( 'slick-theme-default-css', get_template_directory_uri() . '/css/slick.css');	
		wp_enqueue_style( 'owl-default-css', get_template_directory_uri() . '/css/owl.carousel.min.css');
		wp_enqueue_style( 'owl-theme-default-css', get_template_directory_uri() . '/css/owl.theme.default.css');
		wp_enqueue_style( 'fontawesome-all-css', get_template_directory_uri() . '/css/all.css');
		wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/fontawesome.min.css');
		wp_enqueue_style( '24apotek-style', get_stylesheet_uri(), array(), _S_VERSION );
		wp_style_add_data( '24apotek-style', 'rtl', 'replace' );

		/*Js-enqueue*/
		wp_enqueue_script('ywgc-frontend-script');
		wp_enqueue_script( 'fontawesome-js', get_template_directory_uri() . '/js/fontawesome.min.js', array(), '20151215', false );
		wp_enqueue_script( 'owl-carousel-filter',get_template_directory_uri() . '/js/owl-carousel-filter.js', array(), '20151215', false );
		
		wp_enqueue_script( 'slick-carousel-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '20151215', false );
		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '20151215', false );
		wp_enqueue_script( 'popper-js', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), '20151215', false );
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery','popper-js'), '20151215', false );
		
		wp_enqueue_script('iframe-resizer', get_stylesheet_directory_uri() . '/js/iframeResizer.min.js');
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery','select2','owl-carousel-filter' ), '20151215', false );
		wp_localize_script( 'custom', 'apotek24_loadmore_params', array(
			'ajaxurl' => admin_url('admin-ajax.php'), 
			'posts' => json_encode( $wp_query->query_vars ),
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			'max_page' => $wp_query->max_num_pages,
			'load'	   =>  __('load more','24apotek'),
			'read_more' => __('Read More','24apotek').'<i class="fas fa-chevron-down"></i>',
			'read_less' => __('Read Less','24apotek').'<i class="fas fa-chevron-up"></i>',
			'_read_less' => __('Show Less','24apotek'),
			'_read_more' => __('Show More','24apotek'),
			'retina_logo' => get_theme_mod( 'retina_logo',false ),
			'cart' => ( is_checkout() || is_cart() ) ? true : false ,
			'is_cart' => is_cart() ? true : false ,
			'shop_page_url' => get_permalink( wc_get_page_id( 'shop' ) ),
			'apply_coupon' =>wp_create_nonce("apply-coupon"),
			'edit_address' => is_wc_endpoint_url('edit-address'),
			'live_chat_js' => get_field('live_chat_code','option'),
			'succes_msg_mailchimp' => __('Thank you for subscribing','24apotek'),
			'login_fallback_time' => get_field('login_popup_time','option'),
			'newsletter_fallback_time' => get_field('newsletter_popup_time','option'),
			'location_icon' => '<img class="svg"src="'.get_template_directory_uri().'images/location_icon.svg"alt="location_icon">',
		) );
		
		wp_enqueue_script( '24apotek-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if( is_singular() ) {
			global $post;
			if( !empty( $post->ID )) {
				wp_enqueue_script( 'single-add-cart', get_template_directory_uri() . '/js/single-ajax-add-to-cart.js', array('jquery' ), '20151215', false );
			}
		}
	}
}



/* Load WooCommerce compatibility file. */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

require get_template_directory() . '/inc/price.php';
require get_template_directory() . '/inc/validate-personal-no.php';

/* Adds custom classes to the array of body classes. */
add_filter( 'body_class', 'apotek24_body_classes' );
if (!function_exists('apotek24_body_classes')) {
	function apotek24_body_classes( $classes ) {
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}
		if ( is_shop() || is_product_category() ) {
			$classes[] = 'shop';
		}

		return $classes;
	}
}

/* Add a pingback url auto-discovery header for single posts, pages, or attachments. */
add_action( 'wp_head', 'apotek24_pingback_header' );
if (!function_exists('apotek24_pingback_header')) {
	function apotek24_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}

/* Add Custom Class on the login page */
add_filter('body_class', 'ap_add_body_class');
if (!function_exists('ap_add_body_class')) {
	function ap_add_body_class($classes) {
		if (!is_user_logged_in() && is_account_page() ) {
	    	$classes[] = 'login-page';
		}
	    return $classes;
	}
}

/* Prints HTML with meta information for the current post-date/time. */
if ( ! function_exists( 'apotek24_posted_on' ) ) {
	function apotek24_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( 'Posted on %s', 'post date', '24apotek' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; 

	}
}



/* Prints HTML with meta information for the current author. */
if ( ! function_exists( 'apotek24_posted_by' ) ) {
	function apotek24_posted_by() {
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', '24apotek' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; 

	}
}

/* Prints HTML with meta information for the categories, tags and comments. */
if ( ! function_exists( 'apotek24_entry_footer' ) ) {
	function apotek24_entry_footer() {
		if ( 'post' === get_post_type() ) {
			
			$categories_list = get_the_category_list( __( ', ', '24apotek' ) );
			if ( $categories_list ) {
				
				printf( '<span class="cat-links">' . __( 'Posted in %1$s', '24apotek' ) . '</span>', $categories_list ); 
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', _x( ', ', 'list item separator', '24apotek' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . __( 'Tagged %1$s', '24apotek' ) . '</span>', $tags_list ); 
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '24apotek' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__( 'Edit <span class="screen-reader-text">%s</span>', '24apotek' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

/* Displays an optional post thumbnail. */
if ( ! function_exists( 'apotek24_post_thumbnail' ) ) {
	function apotek24_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			?>

			<div class="post-thumbnail">
				<? the_post_thumbnail(); ?>
			</div>

		<? } else { ?>

			<a class="post-thumbnail" href="<? the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

			<?
		}
	}
}


/* Shim for sites older than 5.2. */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}


/* Register Custom Navigation Walker */
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';


/* WooCommerce Breadcrum arguments */
add_filter('woocommerce_breadcrumb_defaults','apoteck24_breadcrumb_defaults',10,1);
if (!function_exists('apoteck24_breadcrumb_defaults')) {
	function apoteck24_breadcrumb_defaults( $args ) {
		$args['delimiter'] = '<span> - </span>';
		return $args;
	}
}


/*Add theme Settings*/
if( function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page(array(
		'page_title' => __('Theme General Settings','24apotek'),
		'menu_title' => __('Theme Settings','24apotek'),
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
	$child = acf_add_options_sub_page(array(
		'page_title' => __('Membership Settings','24apotek'),
		'menu_title' => __('Membership Settings','24apotek'),
		'menu_slug' => 'membership-settings',
		'parent_slug' => 'theme-general-settings',
	));
	$child2 = acf_add_options_sub_page(array(
		'page_title' => __('Email templates','24apotek'),
		'menu_title' => __('Email templates','24apotek'),
		'parent_slug' => 'theme-general-settings',
	));
}

/* Add section for the memeber in the single product page */
add_action('woocommerce_after_add_to_cart_button','apotek24_add_memeber_section');
if (!function_exists('apotek24_add_memeber_section')) {
	function apotek24_add_memeber_section() {
		global $product;
		if ( !is_user_logged_in() ) {
			apotek24_display_member_section();
		}
	}
}


/* Display memeber section on the product page */
if (!function_exists('apotek24_display_member_section')) {
	function apotek24_display_member_section() {
		$memeber_section = get_field('member_single_product_page','option');
		?>
		<div class="memeber-section">
			<p class="member-text"><? echo apotek24_check_empty( $memeber_section['text'] );?></p>
			<a class="member-btn btn-black" href="<? echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><? echo apotek24_check_empty( $memeber_section['button_text'] );?></a>
		</div>
		<?
	}
}

/* check is value is not empty */
if (!function_exists('apotek24_check_empty')) {
	function apotek24_check_empty( $value ) {
		return !empty( $value ) ? $value : '' ;
	}
}

/* Define the correct image sizes */
add_action('init', 'remove_extra_image_sizes');
function remove_extra_image_sizes() {
    foreach ( get_intermediate_image_sizes() as $size ) {
        if ( !in_array( $size, array( 'woocommerce_thumbnail', 'woocommerce_single') ) ) {
            remove_image_size( $size );
        }
    }
    add_image_size('mementor_100', 100, 100);
}
// add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'mementor_100' => __('Related Product', '24apotek')
    );
    return array_merge( $sizes, $custom_sizes );
}

/* Remove action for the tabs */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action('woocommerce_after_single_product_summary','apotek24_add_review_section');
if (!function_exists('apotek24_add_review_section')) {
	function apotek24_add_review_section() {
		global $product;
		if( 'gift-card' == $product->get_type() ) {
			return;
		}
		$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
		$related_products = wc_get_related_products( $product->get_id(), 30  );
		?>
		<div class="single-product__mid-section">
			<div class="single-product__mid-row">
				<div class="single-product__customer-review">
					<?
					if ( ! empty( $product_tabs ) && isset( $product_tabs['reviews'] ) ) {
						$key = 'reviews';
						call_user_func( $product_tabs[$key]['callback'], $key, $product_tabs['reviews'] );
					}
					?>
				</div>
				<? 
				if ( !empty( $related_products ) ) { ?>
					
					<div class="single-product__related products">
						<div class="single-product__heading-wrapper">
							<h2><? _e('Related Products','24apotek'); ?></h2>
							<div class="paginator-center">
								<ul>
									<li class="prev"><span></span><?_e('Prev','24apotek');?></li>
									<li class="next"><?_e('Next','24apotek');?><span></span></li>
								</ul>
							</div>
						</div>
						<div class="single-product_related-slider">
							<?
							if ( count( $related_products ) > 5 ) {

								$related_products = array_chunk( $related_products, 5 );
							} else {
								$new_related_products[] =  $related_products;
								$related_products = $new_related_products;
							} 
							
							foreach ( $related_products as $key => $sub_array ) { 
								?>
								<div class="single-product__related-section">
									<? 
									if( !empty( $sub_array ) )  {
										foreach ( $sub_array as $k => $related_product ) {

											$post_object = get_post( $related_product );

											$related_product = wc_get_product( $related_product );

											$rating_count = $related_product->get_rating_count();

											$average      = $related_product->get_average_rating();
			
											?>	
											<div class="single-product__related-section-wrap">
												<a class="single-product__related-img" href="<? echo get_permalink( $post_object ); ?>">
													<div class="single-product__image">
														<? echo get_the_post_thumbnail($post_object,'mementor_100',array('class' => 'single-product__img' ) ) ?>
													</div>
												</a>
												<div class="single-product__content">
													<h3><a href="<? echo get_permalink( $post_object ); ?>"><? echo get_the_title( $post_object ); ?></a></h3>
													<p><? echo wp_trim_words( $related_product->get_short_description(),8,'...' );?></p>
													<div class="single-product__subcontent-wrap">

														<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
														
														<div class="pricing-wrapper">
															<? 
															if( is_user_logged_in() ) {
																$membership = get_membership_name_and_url( get_current_user_id() );
															} else {
																$membership = array();
															}
															$regular_price = wc_get_price_to_display( $related_product, array(
																'price' => $related_product->get_regular_price(),
																'qty'   => 1
															) );
															$_price = wc_get_price_to_display( $related_product, array(
																'price' => $related_product->get_price(),
																'qty'   => 1
															) );
															if ( !empty( $membership ) || $related_product->is_on_sale() ) { ?>
																<div class="regular-price">
																	<?_e('Regular Price','24apotek');?>
																	<span><del><? echo wc_price( $regular_price );?></del></span>
																</div>
															<? } else { ?>
																<div class="regular-price">
																	<?_e('Regular Price','24apotek');?>
																	<span><? echo wc_price( $regular_price );?></span>
																</div>
															<? }
															if ( !empty( $membership ) || $related_product->is_on_sale() ) { ?>
															<div class="your-price">
																<?_e('Your Price','24apotek');?>
																<span><? echo wc_price( $_price ); ?></span>
															</div>
															<? } ?>
														</div>
														<div class="single-product__buy-btn">
															
															<a href="?add-to-cart=<? echo $related_product->get_id();?>" data-quantity="1" class="btn-blue button product_type_simple add_to_cart_button ajax_add_to_cart added" data-product_id="<? echo $related_product->get_id();?>" data-product_sku="<? echo $related_product->get_sku();?>" aria-label="Legg til “<? echo $related_product->get_name();?>, ekstra myk og skånsom mot huden, 8 stk” i handlekurven" rel="nofollow"><? _e('Buy Now','24apotek'); ?></a>
														</div>
													</div>
												</div>
											</div>
										<?	}
									}
									?>
								</div>
							<? }?>
						</div>
						<div class="single-product__blue-btn-filled">							
							<a href="<? echo wc_get_cart_url();?>" class="btn-blue-filled"><? _e('CONTINUE TO CART','24apotek'); ?></a>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
		<?
	}
}
remove_action( 'woocommerce_single_product_summary', 
	'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_single_product_summary', 
	'woocommerce_template_single_excerpt', 60 );

/* Add Read more link for it */
add_action('woocommerce_single_product_summary','apotek24_add_read_more_link', 70 );
if (!function_exists('apotek24_add_read_more_link')) {
	function apotek24_add_read_more_link() {
		global $product,$post;
		?>
		<!-- Button trigger modal -->
		<a class="single-product__read-more" data-toggle="modal" data-target="#single-product__modal">
			<? _e('Read More','24apotek'); ?>
		</a>
		<? if( !empty( get_the_content( '', '', $post ) ) ) { ?>
		<? } ?>

		<!-- Modal -->
		<div class="modal fade" id="single-product__modal" tabindex="-1" role="dialog" aria-labelledby="single-product__modal-title" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"></span>
						</button>
					</div>
					<div class="modal-body">
						<? the_content('','',$post); 

						if(! empty( get_field('product_use') ) ) { ?>
							<div class="single-product__set">
								<h3 class="single-product__set-content"><? _e('Product Use','24apotek')?></h3>
								<div class="single-product__set-icon"><i class="fas fa-minus"></i></div>
							</div>
							<div class="single-product__inner-content use_text">
								<? echo apply_filters( 'the_content', get_field('product_use') ) ?>
							</div>
						<? }
						if ( !empty( get_field('ingredients') ) ) { ?>
							<div class="single-product__set">
								<h3 class="single-product__set-content"><? _e('Ingrediants','24apotek')?></h3>
								<div class="single-product__set-icon"><i class="fas fa-minus"></i></div>
							</div>
							<div class="single-product__acc-panel product-ingrediants">
								<? echo apply_filters( 'the_content', get_field('ingredients') ) ?>
							</div>
							
						<? } ?>
						<div class="single-product__set">
							<h3 class="single-product__set-content"><? _e('Attributes','24apotek')?></h3>
							<div class="single-product__set-icon"><i class="fas fa-minus"></i></div>
						</div>
						<div class="single-product__acc-panel product-ingrediants">
							<? do_action( 'woocommerce_product_additional_information', $product );?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?
	}
}

/* Add shoping text on the product page */
add_action('woocommerce_single_product_summary','apotek24_add_shipping_text',9);
if (!function_exists('apotek24_add_shipping_text')) {
	function apotek24_add_shipping_text() {
		global $product;
		if( 'gift-card' == $product->get_type() ) {
			return;
		}
		?>
		<p class="free-shipping-text"><? _e('Free shiping If you order','24apotek'); ?><strong> <? _e(' 3 products','24apotek'); ?></strong></p>
		<?
	}
}

/*Change the upsells heading */
add_filter('woocommerce_product_upsells_products_heading','apotek24_change_upsells_heading');
if (!function_exists('apotek24_change_upsells_heading')) {
	function apotek24_change_upsells_heading( $heading ) {
		$heading = __('Bundle Deals','24apotek');
		return $heading;
	}
}

/* Change price on the cart and on the chckout page */
add_filter('wc_price','vs_change_price_cart_checkout',10,4);
if (!function_exists('vs_change_price_cart_checkout')) {
	function vs_change_price_cart_checkout( $html, $price, $args, $unformatted_price ) {
		return $price;
	}
}

/* Change Price on the cart and on the homepage */
if (!function_exists('change_argument_of_wc_price')) {
	function change_argument_of_wc_price( $args ) {
		if ( !is_cart() && !is_checkout() ) {
			$args['decimals'] = 0;
		} 
		return $args;
	}
}

/* Change the Single title of the Review page */
add_filter('woocommerce_reviews_title','apotek24_woocommerce_reviews_title', 10, 4 );
if (!function_exists('apotek24_woocommerce_reviews_title')) {
	function apotek24_woocommerce_reviews_title( $reviews_title, $count, $product ) {
		$html = __('Customer Review','24apotek');
		return $html;
	}
}

remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

add_action('woocommerce_before_add_to_cart_form','apotek24_add_price_table',14);
if (!function_exists('apotek24_add_price_table')) {
	function apotek24_add_price_table() {
		global $product;
		if( 'gift-card' == $product->get_type() ) {
			return;
		}
		$get_discount_field = get_field( 'discount', $product->get_id() );
		if ( empty( $get_discount_field ) ) {
			$get_discount_field = get_field('discount_rule','option');
		}
		$rx = get_post_meta($product->get_id(),'rx',true );
		$otc = get_post_meta($product->get_id(),'otc',true );
		if( !empty( $otc ) || !empty( $rx ) ) {
			?>
			<div class="pricing-table-wrapper">
				<div class="pricing-table">
					<p><? _e('Dette produktet har en aldersgrense på 18 år. Før du kjøper produktet vil du bli bedt om å oppgi ditt fødselsnummer.','24apotek'); ?></p>
					<p><? _e('Er det et legemiddel eller reseptfritt legemiddel du savner som du ikke finner hos oss? Ta kontakt med oss slik at vi kan hjelpe deg å fremskaffe.', '24apotek'); ?></p>
				</div>
			</div>
			<?
			return;
		}
		if( empty( $get_discount_field ) ) {
			return;
		}
		?>
		<div class="pricing-table-wrapper">
			<table class="pricing-table">
				<caption><? _e('Kvantumsrabatt','24apotek'); ?></caption>
				<tbody>
					<tr>
						<th colspan="1"><? _e('Number','24apotek'); ?></th>
						<th colspan="1"><? _e('Price per piece','24apotek'); ?></th>
						<th colspan="1"><? _e('Save','24apotek'); ?></th>
					</tr>
					<? foreach ( $get_discount_field as $key => $value) { 
						$price = apotek24_get_price( $product,$product->get_regular_price() );
						$price = $price - ( ( $price * $value['discount'] ) / 100 );
						?>
						<tr>
							<td colspan="1"><? echo $value['quantity']; ?></td>
							<td colspan="1"><? echo get_woocommerce_currency_symbol().' '.wc_price( $price ); ?></td>
							<td colspan="1"><? echo $value['discount'].'%'; ?></td>
						</tr>
						
					<? } ?>
				</tbody>
			</table>
		</div>
		<?
	}
}

if( !function_exists('apotek24_get_price')) {
	function apotek24_get_price(  $product, $price ) {
		$price = 'incl' === get_option( 'woocommerce_tax_display_shop' ) ?
		wc_get_price_including_tax(
			$product,
			array(
				'qty'   => 1,
				'price' => (float)$price,
			)
		) :
		wc_get_price_excluding_tax(
			$product,
			array(
				'qty'   => 1,
				'price' => (float)$price,
			)
		);
		return $price;
	}
}
/* Change the price of the product */
add_filter('ywcrbp_simple_regular_price_html','apotek24_change_price_html',99, 3 );
if (!function_exists('apotek24_change_price_html')) {
	function apotek24_change_price_html( $regular_price_html, $regular_price, $product ) {
		$regular_price_txt = get_option( 'ywcrbp_regular_price_txt' );
		$display_regular_price = wc_get_price_to_display( $product, array(
						'price' => $regular_price,
						'qty'   => 1
					) );
		$membership = get_membership_name_and_url( get_current_user_id() );
		if ( ( !empty( $membership ) || $product->is_on_sale() ) && ( !$product->get_meta('otc') ) ) {
			$regular_price_html = '<div class="regular-price"><span class="regular-price-text">'.$regular_price_txt.'</span><del>'. wc_price( $display_regular_price ) .'</del></div>';
		} else {
			$regular_price_html = '<div class="regular-price"><span class="regular-price-text">'.$regular_price_txt.'</span><span>'. wc_price ( $display_regular_price ) .'</span></div>';
		}
		return $regular_price_html;
	}
}

/* Change the sale price of the product */
add_filter('ywcrbp_simple_sale_price_html','apotek24_change_sale_price_html',99, 3 );
if (!function_exists('apotek24_change_sale_price_html')) {
	function apotek24_change_sale_price_html( $sale_price_html, $sale_price, $product ) {
		$membership = get_membership_name_and_url( get_current_user_id() );
		if ( !empty( $membership ) ) {
			return '';	
		}
		$your_price_txt = apply_filters( 'yith_role_based_price_your_price_label', get_option( 'ywcrbp_sale_price_txt' ) );
		$your_price_html = str_replace($your_price_txt,'',$sale_price_html);
		$sale_price = apotek24_get_price( $product,$sale_price );
		$html = '<div class="sale-price"><span class="sale-price-text">'.$your_price_txt.'</span><span>'.wc_price( $sale_price ).'</span></div>';
		return $html;
	}
}

/* Change the test for "In Stock". */
add_filter( 'woocommerce_get_availability', 'apotek24_custom_get_availability', 1, 2);
if (!function_exists('apotek24_custom_get_availability')) {
	function apotek24_custom_get_availability( $availability, $_product ) {
		global $product;
		if ( $_product->is_in_stock() ) {
			$availability['availability'] = __('In Stock', '24apotek');
		}
		return $availability;
	}
}




/* change quantity field for the checkout */
add_filter('woocommerce_before_quantity_input_field','apotek24_change_quant_field');
if (!function_exists('apotek24_change_quant_field')) {
	function apotek24_change_quant_field( ) {
		?>
		<a class="apotek24-cart-common cart-minus" id="cart-minus">-</a>
		<?
	}
}

/*Add minus button in the quantity field*/
add_filter('woocommerce_after_quantity_input_field','apotek24_change_quant_field_after');
if (!function_exists('apotek24_change_quant_field_after')) {
	function apotek24_change_quant_field_after() {
		?>
		<a class="apotek24-cart-common cart-plus" id="cart-plus">+</a>
		<?
	}
}


/* Change the text of the add to cart */
add_filter('woocommerce_product_add_to_cart_text','apotek24_change_add_cart_text',10,2);
add_filter('woocommerce_product_single_add_to_cart_text','apotek24_change_add_cart_text',10,2);
if (!function_exists('apotek24_change_add_cart_text')) {
	function apotek24_change_add_cart_text( $text,$product ) {
		if ( $product->is_type( 'simple' ) ) {
			$text = __('Buy Now','24apotek');
		}
		return $text;
	}	
}

remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 13 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

/* Add load more section in the sho page */
add_action( 'woocommerce_after_shop_loop', 'apotek24_explore_section', 10 );
if (!function_exists('apotek24_explore_section')) {
	function apotek24_explore_section() {
		global $wp_query;
		if (  $wp_query->max_num_pages > 1 ) {
			?>
			<div class="load-more text-center section-pd-top-50">
				<div class="load-more-wrap">
					<a id="apotek24-load-more" class="apotek24-load-more btn-white">
						<? _e('LOAD MORE','24apotek');?></p>
					</a>
				</div>
			</div>
		<? }  
	}
}
/* Add load more section in the sho page */
add_action( 'apotek24_woocommerce_after_shop_loop', 'apotek24_load_more_section');
if (!function_exists('apotek24_load_more_section')) {
	function apotek24_load_more_section() {
		global $wp_query;
		if (  $wp_query->max_num_pages > 1 ) {
			?>
			<div class="brands-page__load-more"><a  class="btn-white"><? _e('LOAD MORE PRODUCTS','24apotek'); ?></a></div>
		<? }  
	}
}

add_action('wp_head', 'fb_opengraph', 5);
if (!function_exists('fb_opengraph')) {
	function fb_opengraph() {
		global $post;
		if ( empty( $post ) ) {
			return $post;
		}
		if(is_single() || is_front_page() || is_home() ) {
			if(has_post_thumbnail($post->ID)) {
				$image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
				$img_src = $image[0];
			} else {
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				$img_src = $image[0];
			}
			if($excerpt = $post->post_excerpt) {
				$excerpt = strip_tags($post->post_excerpt);
				$excerpt = str_replace("", "'", $excerpt);
			} else {
				$excerpt = get_bloginfo('description');
			}
			?>

			<meta property="og:title" content="<? echo the_title(); ?>"/>
			<meta property="og:description" content="<? echo $excerpt; ?>"/>
			<meta property="og:type" content="article"/>
			<meta property="og:url" content="<? echo the_permalink(); ?>"/>
			<meta property="og:site_name" content="<? echo get_bloginfo(); ?>"/>
			<meta property="og:image:width" content="3523" >
			<meta property="og:image:height" content="2372" >
			<meta property="og:image" content="<? echo $img_src; ?>"/>

			<?php
		} else {
			return;
		}
	}
}

/* Our custom post type function */ 
function create_posttype() {
 
    register_post_type( 'banners',
        array(
            'labels' => array(
                'name' => __( 'Banners','24apotek' ),
                'singular_name' => __( 'Banners','24apotek' )
            ),
            'supports' => array('title'),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'banners'),
            'menu_position' => 20,
			'menu_icon' => 'dashicons-images-alt',
        )
    );
    $labels = array(
    'name' => __( 'Banner Type', '24apotek' ),
    'singular_name' => __( 'Banner Type', '24apotek' ),
  	);    
 
  register_taxonomy('banner-type',array('banners'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'banner-type' ),
  ));
}

/* Hooking up our function to theme setup */ 
add_action( 'init', 'create_posttype' );


remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
remove_action( 'woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10 );
add_action( 'woocommerce_widget_shopping_cart_total', 'apotek_woocommerce_widget_shopping_cart_subtotal', 10 );
if (!function_exists('apotek_woocommerce_widget_shopping_cart_subtotal')) {
	function apotek_woocommerce_widget_shopping_cart_subtotal() {
		echo '<strong>' . esc_html__( 'Estimated Total', '24apotek' ) . ':</strong> <span> ' . WC()->cart->get_cart_subtotal() .'</span>';
	}
}



add_action('woocommerce_after_edit_account_address_form','apotek24_add_password_field_myaccount');
if (!function_exists('apotek24_add_password_field_myaccount')) {
	function apotek24_add_password_field_myaccount() {
		$user = wp_get_current_user();
		?>
		<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
			<input type="hidden" id="account_first_name" name="account_first_name" value="<? echo esc_attr( $user->first_name ); ?>">
			<input type="hidden" id="account_last_name" name="account_last_name" value="<? echo esc_attr( $user->last_name ); ?>">
			<input type="hidden" id="account_email" name="account_email" value="<? echo esc_attr( $user->user_email ); ?>">
			<div class="change-password-wrapper">
				<fieldset>
					<legend><?php esc_html_e( 'Change password', '24apotek' ); ?></legend>
					<div class="change-pass-wrapper">
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password_current"><?php esc_html_e( 'Current password', '24apotek' ); ?>*</label>
							<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
						</p>
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password_1"><?php esc_html_e( 'New password', 'woocommerce' ); ?>*</label>
							<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
						</p>
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>*</label>
							<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
						</p>
						<p class="change-pass-btn-wrapper">
							<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
							<button type="submit" class="woocommerce-Button button" id="save_account_details" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
							<input type="hidden" name="action" value="save_account_details" />
						</p>
					</div>
				</fieldset>
			</div>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_edit_account_form' ); ?>

			<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
		</form>
		<?
	}
}

/* Save account details for the 24apotek */
remove_action( 'template_redirect', array( 'WC_Form_Handler', 'save_account_details' ) );
add_action( 'template_redirect','apotek24_save_account_details',10);
if (!function_exists('apotek24_save_account_details')) {
	function apotek24_save_account_details( ) {
		$nonce_value = wc_get_var( $_REQUEST['save-account-details-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

		if ( ! wp_verify_nonce( $nonce_value, 'save_account_details' ) ) {
			return;
		}

		if ( empty( $_POST['action'] ) || 'save_account_details' !== $_POST['action'] ) {
			return;
		}

		wc_nocache_headers();

		$user_id = get_current_user_id();

		if ( $user_id <= 0 ) {
			return;
		}

		$account_first_name   = ! empty( $_POST['account_first_name'] ) ? wc_clean( wp_unslash( $_POST['account_first_name'] ) ) : '';
		$account_last_name    = ! empty( $_POST['account_last_name'] ) ? wc_clean( wp_unslash( $_POST['account_last_name'] ) ) : '';
		$account_email        = ! empty( $_POST['account_email'] ) ? wc_clean( wp_unslash( $_POST['account_email'] ) ) : '';
		$pass_cur             = ! empty( $_POST['password_current'] ) ? $_POST['password_current'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$pass1                = ! empty( $_POST['password_1'] ) ? $_POST['password_1'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$pass2                = ! empty( $_POST['password_2'] ) ? $_POST['password_2'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$save_pass            = true;

		// Current user data.
		$current_user       = get_user_by( 'id', $user_id );
		$current_first_name = $current_user->first_name;
		$current_last_name  = $current_user->last_name;
		$current_email      = $current_user->user_email;

		// New user data.
		$user               = new stdClass();
		$user->ID           = $user_id;
		$user->first_name   = $account_first_name;
		$user->last_name    = $account_last_name;
		

		// Handle required fields.
		$required_fields = apply_filters(
			'woocommerce_save_account_details_required_fields',
			array(
				'account_first_name'   => __( 'First name', '24apotek' ),
				'account_last_name'    => __( 'Last name', '24apotek' ),
				'account_email'        => __( 'Email address', '24apotek' ),
			)
		);

		foreach ( $required_fields as $field_key => $field_name ) {
			if ( empty( $_POST[ $field_key ] ) ) {
				/* translators: %s: Field name. */
				wc_add_notice( sprintf( __( '%s is a required field.', '24apotek' ), '<strong>' . esc_html( $field_name ) . '</strong>' ), 'error', array( 'id' => $field_key ) );
			}
		}

		if ( $account_email ) {
			$account_email = sanitize_email( $account_email );
			if ( ! is_email( $account_email ) ) {
				wc_add_notice( __( 'Please provide a valid email address.', '24apotek' ), 'error' );
			} elseif ( email_exists( $account_email ) && $account_email !== $current_user->user_email ) {
				wc_add_notice( __( 'This email address is already registered.', '24apotek' ), 'error' );
			}
			$user->user_email = $account_email;
		}

		if ( ! empty( $pass_cur ) && empty( $pass1 ) && empty( $pass2 ) ) {
			wc_add_notice( __( 'Please fill out all password fields.', '24apotek' ), 'error' );
			$save_pass = false;
		} elseif ( ! empty( $pass1 ) && empty( $pass_cur ) ) {
			wc_add_notice( __( 'Please enter your current password.', '24apotek' ), 'error' );
			$save_pass = false;
		} elseif ( ! empty( $pass1 ) && empty( $pass2 ) ) {
			wc_add_notice( __( 'Please re-enter your password.', '24apotek' ), 'error' );
			$save_pass = false;
		} elseif ( ( ! empty( $pass1 ) || ! empty( $pass2 ) ) && $pass1 !== $pass2 ) {
			wc_add_notice( __( 'New passwords do not match.', '24apotek' ), 'error' );
			$save_pass = false;
		} elseif ( ! empty( $pass1 ) && ! wp_check_password( $pass_cur, $current_user->user_pass, $current_user->ID ) ) {
			wc_add_notice( __( 'Your current password is incorrect.', '24apotek' ), 'error' );
			$save_pass = false;
		}

		if ( $pass1 && $save_pass ) {
			$user->user_pass = $pass1;
		}

		// Allow plugins to return their own errors.
		$errors = new WP_Error();
		do_action_ref_array( 'woocommerce_save_account_details_errors', array( &$errors, &$user ) );

		if ( $errors->get_error_messages() ) {
			foreach ( $errors->get_error_messages() as $error ) {
				wc_add_notice( $error, 'error' );
			}
		}

		if ( wc_notice_count( 'error' ) === 0 ) {
			wp_update_user( $user );

			// Update customer object to keep data in sync.
			$customer = new WC_Customer( $user->ID );

			if ( $customer ) {
				// Keep billing data in sync if data changed.
				if ( is_email( $user->user_email ) && $current_email !== $user->user_email ) {
					$customer->set_billing_email( $user->user_email );
				}

				if ( $current_first_name !== $user->first_name ) {
					$customer->set_billing_first_name( $user->first_name );
				}

				if ( $current_last_name !== $user->last_name ) {
					$customer->set_billing_last_name( $user->last_name );
				}

				$customer->save();
			}

			wc_add_notice( __( 'Kontoinformasjonen er endret.', '24apotek' ) );

			do_action( 'woocommerce_save_account_details', $user->ID );
		}
	}
}

/* Save address on the address medicine page */
add_action('template_redirect','apotek24_save_address_medicine_page',40 );
if (!function_exists('apotek24_save_address_medicine_page')) {
	function apotek24_save_address_medicine_page() {
		if ( isset( $_POST['edit-medicine-form'] ) ) {
			$account_first_name   = ! empty( $_POST['first-name'] ) ? wc_clean( wp_unslash( $_POST['first-name'] ) ) : '';
			$account_last_name    = ! empty( $_POST['last-name'] ) ? wc_clean( wp_unslash( $_POST['last-name'] ) ) : '';

			$account_email        = ! empty( $_POST['email'] ) ? wc_clean( wp_unslash( $_POST['email'] ) ) : '';
			
			$account_phone        = ! empty( $_POST['phone'] ) ? wc_clean( wp_unslash( $_POST['phone'] ) ) : '';
		
			$account_address        = ! empty( $_POST['address'] ) ? wc_clean( wp_unslash( $_POST['address'] ) ) : '';
			$account_zip_code        = ! empty( $_POST['zip-code'] ) ? wc_clean( wp_unslash( $_POST['zip-code'] ) ) : '';
			
			$account_city        = ! empty( $_POST['city'] ) ? wc_clean( wp_unslash( $_POST['city'] ) ) : '';
			$billing_country        = ! empty( $_POST['billing_country'] ) ? wc_clean( wp_unslash( $_POST['billing_country'] ) ) : '';

			$user_id = get_current_user_id();

			if ( $user_id <= 0 ) {
				return;
			}

			$customer = new WC_Customer( $user_id );

			$customer->set_billing_email( $account_email  );

			$customer->set_billing_first_name( $account_first_name );

			$customer->set_billing_last_name( $account_last_name );

			$customer->set_billing_phone( $account_phone );

			$customer->set_billing_postcode( $account_zip_code );

			$customer->set_billing_city( $account_city );
			
			$customer->set_billing_address( $account_address );
			$customer->set_billing_country( $billing_country );
			$customer->save();
			
		}
	}
}

/* This function is used for */

/* Apotek address to edit*/
add_filter('apotek24_woocommerce_address_to_edit','apotek24_add_field_for_address',10,2);
function apotek24_add_field_for_address( $address, $load_address ) {
	unset( $address['billing_address_2'] );
	// unset( $address['billing_postcode'] );
	unset( $address['billing_country'] );
	unset( $address['billing_vat_number'] );
	unset( $address['billing_vat_ssn'] );
	unset( $address['billing_state'] );

	

	$address['billing_first_name']['priority'] = 1;
	$address['billing_last_name']['priority'] = 2;

	$address['billing_address_1']['priority'] = 3;
	$address['billing_postcode']['priority'] = 4;
	
	$address['billing_city']['priority'] = 5;
	$address['billing_email']['priority'] = 6;

	$address['billing_phone']['priority'] = 7;
	$address['billing_company']['priority'] = 8;
	
	$address['billing_last_name']['required'] = 1;


	$address['billing_first_name']['class'] = array( 'form-row-first');
	$address['billing_last_name']['class'] = array( 'form-row-last');

	$address['billing_address_1']['class'] = array( 'form-row-first');
	$address['billing_postcode']['class'] = array( 'form-row-last');

	$address['billing_city']['class'] = array( 'form-row-first');
	$address['billing_email']['class'] = array( 'form-row-last');

	$address['billing_phone']['class'] = array( 'form-row-first');
	$address['billing_company']['class'] = array( 'form-row-last');
	$address['billing_postcode']['required'] = true;
	return $address;
}

/* Save address for the apotek24 */
remove_action( 'template_redirect', array( 'WC_Form_Handler', 'save_address' ) );
add_action('template_redirect','apotek24_save_address',30);
if (!function_exists('apotek24_save_address')) {
	function apotek24_save_address() {
		global $wp;

		$nonce_value = wc_get_var( $_REQUEST['woocommerce-edit-address-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.
		if ( ! wp_verify_nonce( $nonce_value, 'woocommerce-edit_address' ) ) {
			return;
		}

		if ( empty( $_POST['action'] ) || 'edit_address' !== $_POST['action'] ) {
			return;
		}

		wc_nocache_headers();

		$user_id = get_current_user_id();

		if ( $user_id <= 0 ) {
			return;
		}

		$customer = new WC_Customer( $user_id );

		if ( ! $customer ) {
			return;
		}

		$load_address = 'billing';
		if ( ! isset( $_POST[ $load_address . '_country' ] ) ) {
			return;
		}

		$address = WC()->countries->get_address_fields( wc_clean( wp_unslash( $_POST[ $load_address . '_country' ] ) ), $load_address . '_' );

		foreach ( $address as $key => $field ) {
			if ( ! isset( $field['type'] ) ) {
				$field['type'] = 'text';
			}

			// Get Value.
			if ( 'checkbox' === $field['type'] ) {
				$value = (int) isset( $_POST[ $key ] );
			} else {
				$value = isset( $_POST[ $key ] ) ? wc_clean( wp_unslash( $_POST[ $key ] ) ) : '';
			}

			// Hook to allow modification of value.
			$value = apply_filters( 'woocommerce_process_myaccount_field_' . $key, $value );

			// Validation: Required fields.
			if ( ! empty( $field['required'] ) && empty( $value ) ) {
				/* translators: %s: Field name. */
				wc_add_notice( sprintf( __( '%s is a required field.', 'woocommerce' ), $field['label'] ), 'error', array( 'id' => $key ) );
			}

			/*Custom code*/
			$account_first_name   = ! empty( $_POST['billing_first_name'] ) ? wc_clean( wp_unslash( $_POST['billing_first_name'] ) ) : '';
			$account_last_name    = ! empty( $_POST['billing_last_name'] ) ? wc_clean( wp_unslash( $_POST['billing_last_name'] ) ) : '';
			$account_email        = ! empty( $_POST['billing_email'] ) ? wc_clean( wp_unslash( $_POST['billing_email'] ) ) : '';

			// Current user data.
			$current_user       = get_user_by( 'id', $user_id );
			$current_first_name = $current_user->first_name;
			$current_last_name  = $current_user->last_name;
			$current_email      = $current_user->user_email;

			//Update data
			$user               = new stdClass();
			$user->ID           = $user_id;
			$user->first_name   = $account_first_name;
			$user->last_name    = $account_last_name;


			if ( $account_email ) {
				$account_email = sanitize_email( $account_email );
				if ( ! is_email( $account_email ) ) {
					wc_add_notice( __( 'Please provide a valid email address.', '24apotek' ), 'error' );
					return;
				} elseif ( email_exists( $account_email ) && $account_email !== $current_user->user_email ) {
					wc_add_notice( __( 'This email address is already registered.', '24apotek' ), 'error' );
					return;
				}
				$user->user_email = $account_email;
			}

			if ( wc_notice_count( 'error' ) === 0 ) {
				wp_update_user( $user );
			}
			/* Custom Code */
			if ( ! empty( $value ) ) {
				// Validation and formatting rules.
				if ( ! empty( $field['validate'] ) && is_array( $field['validate'] ) ) {
					foreach ( $field['validate'] as $rule ) {
						switch ( $rule ) {
							case 'postcode':
							$country = wc_clean( wp_unslash( $_POST[ $load_address . '_country' ] ) );
							$value   = wc_format_postcode( $value, $country );

							if ( '' !== $value && ! WC_Validation::is_postcode( $value, $country ) ) {
								switch ( $country ) {
									case 'IE':
									$postcode_validation_notice = __( 'Please enter a valid Eircode.', '24apotek' );
									break;
									default:
									$postcode_validation_notice = __( 'Please enter a valid postcode / ZIP.', '24apotek' );
								}
								wc_add_notice( $postcode_validation_notice, 'error' );
							}
							break;
							case 'phone':
							if ( '' !== $value && ! WC_Validation::is_phone( $value ) ) {
								/* translators: %s: Phone number. */
								wc_add_notice( sprintf( __( '%s is not a valid phone number.', '24apotek' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
							}
							break;
							case 'email':
							$value = strtolower( $value );

							if ( ! is_email( $value ) ) {
								/* translators: %s: Email address. */
								wc_add_notice( sprintf( __( '%s is not a valid email address.', '24apotek' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
							}
							break;
						}
					}
				}
			}

			try {
				// Set prop in customer object.
				if ( is_callable( array( $customer, "set_$key" ) ) ) {
					$customer->{"set_$key"}( $value );
				} else {
					$customer->update_meta_data( $key, $value );
				}
			} catch ( WC_Data_Exception $e ) {
				// Set notices. Ignore invalid billing email, since is already validated.
				if ( 'customer_invalid_billing_email' !== $e->getErrorCode() ) {
					wc_add_notice( $e->getMessage(), 'error' );
				}
			}
		}

		/**
		 * Hook: woocommerce_after_save_address_validation.
		 *
		 * Allow developers to add custom validation logic and throw an error to prevent save.
		 *
		 * @param int         $user_id User ID being saved.
		 * @param string      $load_address Type of address e.g. billing or shipping.
		 * @param array       $address The address fields.
		 * @param WC_Customer $customer The customer object being saved. @since 3.6.0
		 */
		do_action( 'woocommerce_after_save_address_validation', $user_id, $load_address, $address, $customer );

		if ( 0 < wc_notice_count( 'error' ) ) {
			return;
		}

		$customer->save();

		wc_add_notice( __( 'Account details changed successfully.', '24apotek' ) );

		do_action( 'woocommerce_customer_save_address', $user_id, $load_address );

		wp_safe_redirect( wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' ) ) );
		exit;
	}
}



/* Change the Personel Information */
add_filter('woocommerce_my_account_edit_address_title','apotek24_change_account_title');
if (!function_exists('apotek24_change_account_title')) {
	function apotek24_change_account_title( $title ) {
		$title = __('Personal Information','24apotek');
		return $title;
	}
}

/* Change the pripority of the fields. */
add_filter( 'woocommerce_default_address_fields', 'apotek24_chnage_order_of_fields', 10, 1 );
if (!function_exists('apotek24_chnage_order_of_fields')) {
	function apotek24_chnage_order_of_fields( $fields ) {
		if( is_wc_endpoint_url('edit-address') ) {
			unset($fields['address_2']['placeholder']);
			unset($fields['address_1']['placeholder']);
			unset($fields['state']);
			unset($fields['billing_state']);
		}
		return $fields;
	}
}


/* Remove unused tabs. */
add_filter('woocommerce_account_menu_items','apotek24_remove_unused_tab');
if (!function_exists('apotek24_remove_unused_tab')) {
	function apotek24_remove_unused_tab( $items ) {
		$items = array(
			'dashboard'    => __( 'My Account', '24apotek' ),
			'edit-address' => __( 'Personal Information', '24apotek' ),
			'orders'       => __( 'My Orders', '24apotek' ),
			'gift-cards'   => __('My Gift Cards','24apotek'),
			'points-and-rewards' => __( 'My Points', '24apotek' ),
			'wishlist'    => __('Wishlist','24apotek'),
			'customer-logout'  => __( 'Log out','24apotek'),
		);
		return $items;
	}
}

/* Change main title on the my-account page */
add_filter( 'woocommerce_endpoint_edit-address_title', 'change_apotek24_account_edit_account_title', 10, 2 );
add_filter( 'woocommerce_endpoint_orders_title', 'change_apotek24_account_edit_account_title', 10, 2 );
if (!function_exists('change_apotek24_account_edit_account_title')) {
	function change_apotek24_account_edit_account_title( $title, $endpoint ) {
		$title = __( "My account", "24apotek" );
		return $title;
	}
}

/*Change or remove the action */
add_filter('woocommerce_my_account_my_orders_actions','apotek24_remove_action_from_order',10,2);
if (!function_exists('apotek24_remove_action_from_order')) {
	function apotek24_remove_action_from_order( $actions, $order ) {
		if ( isset( $actions['pay'] ) ) {
			unset($actions['pay']);
		} 
		if ( isset($actions['cancel'] ) ) {
			unset( $actions['cancel'] );
		}
		return $actions;
	}
}

/* Add Privacy policy checkbox*/
add_action('woocommerce_register_form','apotek24_privacy_policy_register_form');
if (!function_exists('apotek24_privacy_policy_register_form')) {
	function apotek24_privacy_policy_register_form() {
		?>
	 	<label class="woocommerce-form__label-for-checkbox checkbox">
		    <input type="checkbox" class="input-text" name="privacy_policy" id="privacy_policy" 
		    <? echo  ! empty( $_POST['privacy_policy'] ) ? 'checked' : ''; ?>
		    />
		    <span><? _e('I have read and agree to' ,'24apotek');?> <? echo get_bloginfo( 'name' ); ?><? _e('&apos;s', '24apotek'); ?> <a data-toggle="modal" data-target="#privacy-policy-modal" class="woocommerce-privacy-policy-link" target="_blank"><? _e('privacy policy','24apotek' ); ?></a> <? _e('and ','24apotek')?><a data-toggle="modal" class="woocommerce-privacy-policy-link" data-target="#terms-modal"> <? _e('terms and conditions','24apotek'); ?></a>.*</span>
	    </label>
	    <label class="woocommerce-form__label-for-checkbox checkbox">
		    <input type="checkbox" class="input-text" name="checkbox_conset_newsletter" id="checkbox_conset_newsletter" 
		    <? echo  ! empty( $_POST['checkbox_conset_newsletter'] ) ? 'checked' : ''; ?>
		    />
		    <span><? _e('I would like to receive news and offers through email' ,'24apotek');?>.</span>
	    </label>
	    <label class="woocommerce-form__label-for-checkbox checkbox">
		    <input type="checkbox" class="input-text" name="checkbox_conset_sms" id="checkbox_conset_sms" 
		    <? echo  ! empty( $_POST['checkbox_conset_sms'] ) ? 'checked' : ''; ?>
		    />
		    <span><? _e('I would like to receive news and offers through SMS' ,'24apotek');?>.</span>
	    </label>
	    <?
	}
}

/*Add register form*/ 
add_action( 'woocommerce_register_form_start', 'apotek24_add_name_woo_account_registration' );
if (!function_exists('apotek24_add_name_woo_account_registration')) {
	function apotek24_add_name_woo_account_registration() {
		$field = get_field('customer_union_select_box','option');
		?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="member"><?php _e( 'Are you a member of one of the follownig unions?', '24apotek' ); ?></label>
			<select name="member" id="member">
				<option value="none"><? _e('No union', '24apotek' );?></option>
				<? if( !empty( $field ) ) { 
					foreach( $field as $key => $value ) {
					?>
					<option value="<? echo $value['options'];?>"><? echo $value['options'];?></option>
					<? } ?>
				<? } ?>
			</select>
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_billing_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="billing_phone" id="reg_billing_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
		</p>

		<div class="clear"></div>

		<?php
	}
}
  

/* Validate fields */
add_filter( 'woocommerce_registration_errors', 'apotek24_validate_name_fields', 10, 3 );
if (!function_exists('apotek24_validate_name_fields')) {
	function apotek24_validate_name_fields( $errors, $username, $email ) {
		if( is_checkout() ) {
			return $errors;
		}
		if ( !isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
			$errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
		}
		if ( !isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
			$errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
		}
		if ( !isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
			$errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'woocommerce' ) );
		}
		
		if ( !isset( $_POST['privacy_policy'] ) || empty( $_POST['privacy_policy'] ) ) {
			$errors->add( 'privacy_policy_error', __( '<strong>Error</strong>: Privacy Policy is required!', 'woocommerce' ) );
		}
		return $errors;
	}
}
  
/*Save fields*/
add_action( 'woocommerce_created_customer', 'apotek24_save_name_fields' );
if (!function_exists('apotek24_save_name_fields')) {
	function apotek24_save_name_fields( $customer_id ) {
		$field = get_field_object('customer_union_select_box','option');
		$choices = array( );
		if( !empty( $field['value'] ) ) {
			foreach( $field['value'] as $key => $value ) {
				$choices[] = $value['options'];
			}
		}
		if ( isset( $_POST['billing_first_name'] ) ) {
			update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
			update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
		}

		if ( isset( $_POST['billing_last_name'] ) ) {
			update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
			update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
		}

		if ( isset( $_POST['billing_phone'] ) ) {
			update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
			update_user_meta( $customer_id, 'phone', sanitize_text_field($_POST['billing_phone']) );
		}
		if ( isset( $_POST['member'] ) ) {
			$member = sanitize_text_field( $_POST['member'] );
			update_user_meta( $customer_id, 'member', $member );
			$user = new WP_User($customer_id);
			if( in_array($member,$choices)) {
				$user->remove_role( 'customer' );
				$user->add_role( 'vip-plus' );
			}
		}
		// $list_id = '6af9e933c5';
		$list_id = get_field( 'mailchimp_list_id', 'option' );
		// $authToken = '2e4d340a84f0bff5cfd0584a98fc3725-us8';
		$authToken = get_field( 'mailchimp_api_id', 'option' );
		// The data to send to the API
		
		$postData = array(
		    "email_address" => $_POST['email'],
		    "status" => "subscribed",
		    "merge_fields" => array(
		    "FNAME"=> $_POST['billing_first_name'],
		    "LNAME"=> $_POST['billing_last_name'],
		    "PHONE" => $_POST['billing_phone'],
		    ),
		    'marketing_permissions' => array( 
		    	array(
		    	'marketing_permission_id' => 'f156df5c6c',
		    	'enabled' => !empty( $_POST['checkbox_conset_newsletter'] ) ? true : false,
		    	),
		    	array(
		    	'marketing_permission_id' => '7547fda680',
		    	'enabled' => !empty( $_POST['checkbox_conset_sms'] ) ? true : false,
		    	)
		    ) ,
		);
		
		// Setup cURL
		$link = get_field( 'mailchimp_server_id', 'option' );
		$ch = curl_init($link.$list_id.'/members/');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => TRUE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Authorization: apikey '.$authToken,
		        'Content-Type: application/json'
		    ),
		    CURLOPT_POSTFIELDS => json_encode($postData)
		));
		// Send the request
		$response = curl_exec($ch);
	}
}

/* Listing of the subcategory */
add_action( 'apotek24_add_cat_listing', 'apotek24_category_listing');
if (!function_exists('apotek24_category_listing')) {
	function apotek24_category_listing() {

		$term    = get_queried_object();
		$term_id = ( isset( $term->term_id ) ) ? (int) $term->term_id : 0;

		$categories = get_categories( array(
		    'orderby'    => 'name',
		    'parent'     => 0,
		    'hide_empty' => 0,
		    'exclude' => 1,
		) );
		$uncategorized = get_option( 'default_product_cat' );
        $get_parent_cats = array(
            'parent' => '0' ,
            'taxonomy' => 'product_cat',
            'exclude' => $uncategorized,
            
        ); 
		$page_for_posts = get_option( 'page_for_posts' );
		$cat_name = ( 0 == $term_id ) ? __( 'All categories','24apotek') : $term->name;
		?>
		<div class="tips-page__category-filter">
				<span> <? _e('filter by category','24apotek'); ?> </span>
				<div class="tips-page__filter-dropdown dropdown">
					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<? echo $cat_name; ?>
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<? echo apotek_get_page_link ('tips-rad' );?>"><? echo __( 'All categories','24apotek') ?></a>
						<? 
						foreach ( $categories as $category ) { 
							 $category_name = $category->name;
							?>
							<a class="dropdown-item" href="<? echo get_category_link( $category->term_id ); ?>"><? echo esc_html( $category_name ); ?></a>
						<? } ?>
					</div>
			</div>
		</div>
		<?
	}
}

/* Remove the field of the checkout */
add_action('template_redirect','apotek24_checkout_add_field_based_on_cart');
if(!function_exists('apotek24_checkout_add_field_based_on_cart')) {
	function apotek24_checkout_add_field_based_on_cart() {
		$bool = false;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$product_id = $cart_item['product_id'];
			if( 1 == get_post_meta( $product_id,'otc',true ) ) {
				$bool = true;
				break;
			} else{
				$bool = false;
			}
		}
		if( $bool ) {
			add_filter( 'woocommerce_checkout_fields', 'apotek24_add_birth_date',99 );
		} else {
			add_filter( 'woocommerce_checkout_fields', 'apotek24_checkout_reorder_billing_fields',99 );
		}
	}
}
if (!function_exists('apotek24_add_birth_date')) {
	function apotek24_add_birth_date( $checkout ) {
		$new_checkout_order = array();
		unset( $checkout['billing']['billing_vat_ssn']);
		unset( $checkout['billing']['billing_vat_number']);
		$checkout['billing']['_birth_date'] = array(
			'label' => __('Personnummer','24apotek'),
			'type'     => 'number',
			'class' => array( 'form-row form-row-wide' ),
			'priority'=> 999,
			'value'  => '',
			'required' => 1,
			'custom_attributes' => array('minlength' => 11,'maxlength' => 11 ),
		);
		$checkout['order']['order_comments']['placeholder'] = '';
		return $checkout;	
	}
}
if (!function_exists('apotek24_checkout_reorder_billing_fields')) {
	function apotek24_checkout_reorder_billing_fields( $checkout ) {
		$new_checkout_order = array();
		unset( $checkout['billing']['billing_vat_ssn']);
		unset( $checkout['billing']['billing_vat_number']);
		$checkout['order']['order_comments']['placeholder'] = '';
		return $checkout;
	}
}

/* Make coupons invalid at product level */
add_filter('woocommerce_coupon_is_valid_for_product', 'apotek24_set_coupon_validity_for_excluded_products', 12, 4);
if(!function_exists('apotek24_set_coupon_validity_for_excluded_products')) {
	function apotek24_set_coupon_validity_for_excluded_products( $valid, $product, $coupon, $values ) {
		$rx = get_post_meta($product->get_id(),'rx',true );
		$otc = get_post_meta($product->get_id(),'otc',true );
	    if( 1 == $otc || 1 == $rx ) {
	    	$valid = false;
	    }
	    return $valid;
	}
}

// Set the product discount amount to zero
add_filter( 'woocommerce_coupon_get_discount_amount', 'apotek24_zero_discount_for_excluded_products', 12, 5 );
if(!function_exists('apotek24_zero_discount_for_excluded_products')) {
	function apotek24_zero_discount_for_excluded_products($discount, $discounting_amount, $cart_item, $single, $coupon ){
		$rx = get_post_meta($cart_item['product_id'],'rx',true );
		$otc = get_post_meta($cart_item['product_id'],'otc',true );
	    if( 1 == $rx || 1 == $otc ) {
		    $discount = 0;
		}
    	return $discount;
	}	
}



/* Checkout create order*/
add_action( 'woocommerce_checkout_update_order_meta', 'apotek24_checkout_field_update_order_meta');
if (!function_exists('apotek24_checkout_field_update_order_meta')) {
	function apotek24_checkout_field_update_order_meta( $order_id ) {
		$priority = get_shiping_sort_order( $order_id );
		update_post_meta( $order_id, '_sort_order', $priority );
		if ( isset( $_POST['_birth_date'] ) ) {
			update_post_meta( $order_id,'_birth_date', esc_attr( $_POST['_birth_date'] ) );
		}
	}
}

function is_valid_security_no( $no ) {
 $nowithoutspaces = preg_replace('/(?<=\d)\s+(?=\d)/', '', $no);
	if( strlen($nowithoutspaces) != 11 ) {
		return false;
	} else {
	    $arr1 = str_split($no);
	    
	    #Control cipher 1 (n-1)
	    $second_weights = array(3, 7, 6, 1, 8, 9, 4, 5, 2, 1);
	    $sum2 = 0;
	    for( $i=0 ;$i<10; $i++ ) {
	        $sum2 = $sum2 + $second_weights[$i] * $arr1[$i];
	    }
	    
	    $mods2 = ( $sum2 % 11 );
	    
	    if( 0 == $mods2 ) {
	        
	        #Control cipher 2 (n)
    	    $weights = array(5, 4, 3, 2, 7, 6, 5, 4, 3, 2, 1);
    	    $sum = 0;
    	    foreach( $arr1 as $key => $value ) {
    	        $sum = $sum + $weights[$key] * $value;
    	    }
    	    
	        $mods = ($sum % 11);
	            
	        return ( 0 == $mods ) ? true : false;
	    
	    } else {
	        return false;
	    }
	}
}

/* Validation on the checkout*/
add_action('woocommerce_after_checkout_validation','apotek24_woocommerce_after_checkout_validation',10, 2);
if(!function_exists('apotek24_woocommerce_after_checkout_validation')) {
	function apotek24_woocommerce_after_checkout_validation( $fields, $errors ) {
		$bool = false;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$product_id = $cart_item['product_id'];
			if( 1 == get_post_meta( $product_id,'otc',true ) ) {
				$bool = true;
				break;
			} else{
				$bool = false;
			}
		}
		if (!$_POST['checkout_privacy']) {
			$errors->add( 'validation', __( 'Godta avkrysningsruten for personvern', '24apotek' ) );
		}
		if( $bool ) {
			if( !empty( $_POST['_birth_date'] ) ) {
				$_birth_date = $_POST['_birth_date'];
				if( !is_valid_security_no( $_birth_date ) ) {
					$errors->add( 'validation', __( 'Please enter the correct Personnummer.', '24apotek' ) );
					return;
				}
				if( strlen($_birth_date) == 11 ) {
					$failures = CreateNumberReference(0.0);
					$numindiv = substr( $_birth_date,6,3 );
					$numyear = substr( $_birth_date,4,2);
					$century = -1;
					if ($numindiv > 499) {
						if ($numindiv < 750 && $numyear >= 54) {
							$century = 18;
						} else if ($numyear < 40) {
							$century = 20;
						} else if ($numindiv = 900 && $numyear >= 40) { // special cases
							$century = 19;
						}
					} else {
						$century = 19;
					}
					if ( $century == -1 ) {
						$errors->add( 'validation', __( 'Invalid combination of year and individual number', '24apotek' ) );
						return;
					}
					$date = substr( $_birth_date,0,2 ).'/'.substr( $_birth_date,2,2 ).'/'.$century.$numyear;
					$date = DateTime::createFromFormat('d/m/Y', $date);
					$new_date = $date->format('d.m.Y');
					$bday = new DateTime( $new_date ); // Your date of birth
					$today = new Datetime();
					$diff = $today->diff($bday);
					$age = $diff->y;
					if( $age < 18 ) {
						$errors->add( 'validation', __( 'You have to be at least 18 year old to buy some of the products in the your cart.', '24apotek' ) );
					}
				} else {
					$errors->add( 'validation', __( 'You have to be at least 18 year old to buy some of the products in the your cart.', '24apotek' ) );
				}
				
			} elseif( empty( $_POST['_birth_date'] ) ) {
				$errors->add( 'validation', __( 'Please enter the Personnummer.', '24apotek' ) );
			}	
		}
	}
}



/*Get Page link by its slug*/
if (!function_exists('apotek_get_page_link')) {
	function apotek_get_page_link( $slug ) {
	  return get_permalink( get_page_by_path( $slug ) );
	}
}

/* Add load more button */
add_action('apotek24_after_post','apotek24_add_load_more');
if (!function_exists('apotek24_add_load_more')) {
	function apotek24_add_load_more() {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<div class="load-more-btn section-pd-top-20 section-pd-bottom-50 text-center">
				<a href="#" class="btn-white apotek24_load_more_btn">
					<? _e('LOAD MORE','24apotek'); ?>
				</a>
			</div>
			<?
		}
	}
}

/* Handle the load more button event */
add_action('wp_ajax_apotek24_loadmore','apotek24_loadmore_handle');
add_action('wp_ajax_nopriv_apotek24_loadmore','apotek24_loadmore_handle');
if (!function_exists('apotek24_loadmore_handle')) {
	function apotek24_loadmore_handle() {
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged'] = $_POST['page'] + 1;
		// $args['post_status'] = 'publish';
		query_posts( $args );
		if( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/tips-listing', get_post_type() );
			}
		}
		die;
	}
}


/* Change Permalink of the account */
add_filter('woocommerce_get_endpoint_url', 'woocommerce_hacks_endpoint_url_filter', 10, 4);
if (!function_exists('woocommerce_hacks_endpoint_url_filter') ) {
	function woocommerce_hacks_endpoint_url_filter( $url, $endpoint, $value, $permalink) {
		return $url;
	}
}

/* Handle the Ajax request on the shop page */
add_action('wp_ajax_apotek24_shop_loadmore','apotek24_shop_loadmore');
add_action('wp_ajax_nopriv_apotek24_shop_loadmore','apotek24_shop_loadmore');
if (!function_exists('apotek24_shop_loadmore')) {
	function apotek24_shop_loadmore() {
		global $wpdb;
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		$search = '';
		if( isset( $_POST['search'] ) ) {
			$search = $_POST['search'];	
		}
		$args['paged'] = $_POST['page'] + 1;
		$min_price = (float)$_POST['min_price'];
		$max_price = (float)$_POST['max_price'];
		$args['post_status'] = 'publish';
		/**
		 * Adjust if the store taxes are not displayed how they are stored.
		 * Kicks in when prices excluding tax are displayed including tax.
		 */
		if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
			$tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
			$tax_rates = WC_Tax::get_rates( $tax_class );

			if ( $tax_rates ) {
				$min_price -= WC_Tax::get_tax_total( WC_Tax::calc_inclusive_tax( $min_price, $tax_rates ) );
				$max_price -= WC_Tax::get_tax_total( WC_Tax::calc_inclusive_tax( $max_price, $tax_rates ) );
			}
		}
		if( !empty( $max_price ) && !empty( $min_price ) ) { 
				$args[ 'meta_query'] = array( 
				array(
		            'key' => '_price',
		            'value' => array( $min_price, $max_price ),
		            'compare' => 'BETWEEN',
		            'type' => 'NUMERIC'
		        )
		        );
		        
			
		} 
		if( !empty( $search ) ) {
			$args['s'] = $search;
		}
		$the_query = new WP_Query( $args );
		do_action( 'woocommerce_before_shop_loop' );
		
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) { 
				$the_query->the_post();
				wc_get_template_part( 'content', 'product' );
			}
		}
		die;
	}
}

add_filter( 'terms_clauses', 'terms_clauses_custom', 10, 3 );
if(!function_exists('terms_clauses_custom')) {
	function terms_clauses_custom( $clauses, $taxonomies, $args ) {
    	global $wpdb;
	
	    if( !isset( $args['__first_letter'] ) ){
	        return $clauses;
	    }
	
	    $clauses['where'] .= ' AND ' . $wpdb->prepare( "t.name LIKE %s", $wpdb->esc_like( $args['__first_letter'] ) . '%' );
	
	    return $clauses;

	}	
}

/* Handle the Ajax request on the shop page */
add_action('wp_ajax_apotek24_brand_listing','apotek24_brand_listing');
add_action('wp_ajax_nopriv_apotek24_brand_listing','apotek24_brand_listing');
if(!function_exists('apotek24_brand_listing')) {
	function apotek24_brand_listing() {
		$args =  $_POST['val'];
		$first_filter = $_POST['filter_first'];
		$output = '';
		$options = array( 'hide_empty' => false );
		if( !empty( $args ) && 'filter_first' == $first_filter ) {
			$options['__first_letter'] = $args;
		} elseif( !empty( $args ) ) {
			$options['name__like'] = $args;
		}
		$terms = get_terms('pa_merke', $options );
		if(!empty( $terms) ) {
			  ob_start();
			  foreach ( $terms as $key => $value) { 
			  	$link = get_category_link( $value->term_id );
			  	$name = $value->name;
			  	$choices = get_field('hide_on_the_archive_page', $value );
			  	 if( empty( $choices ) ) : ?>
					<li class="grid-item  <? echo strtolower( substr( $name,0,1) ); ?>"><a href="<? echo $link; ?>"><? echo $name ?></a></li>
				<? endif; 
			  		
			 } 
			 $output = ob_get_clean();
		}
		wp_send_json( $output );
	}
}




/* WooCommerce override layered */
add_action( 'widgets_init', 'woocommerce_override_woocommerce_widgets', 15 );
if (!function_exists('woocommerce_override_woocommerce_widgets')) {
	function woocommerce_override_woocommerce_widgets() {

		if ( class_exists( 'WC_Widget_Layered_Nav' ) ) {

			unregister_widget( 'WC_Widget_Layered_Nav' );

			include_once( 'widgets/class-wc-widget-layered-nav.php' );

			register_widget( 'WC_Custom_Widget_Layered_Nav' );
		}
		if( class_exists('WC_Widget_Product_Categories') ) {
			unregister_widget( 'WC_Widget_Product_Categories' );
			include_once( 'widgets/class-wc-widget-product-categories.php' );
			register_widget( 'WC_CUSTOM_Product_Categories' );
			
		}

	}
}

/*This function wll display the cat listing on the header */
add_action('apotek24_header_cat_listing','apotek24_header_cat_listing');
if (!function_exists('apotek24_header_cat_listing')) {
	function apotek24_header_cat_listing() {
		$uncategorized = get_option( 'default_product_cat' );
		?>
		<ul id="menu-vertical-menu" class="menu menu-vertical-desktop menu-vertical-menu">
			<a class="back-to-main"><i class="fas fa-caret-left"></i><? _e('Back to main menu','24apotek'); ?></a> 
			<a class="bundled-product" href="<? echo apotek_get_page_link( 'pakkelosninger' );?>"><? _e('Bundle Products','24apotek'); ?></a> 
	        <?php 
	            $get_parent_cats = array(
	                'parent' => '0' ,
	                'taxonomy' => 'product_cat',
	                'exclude' => $uncategorized,
	            ); 

	            $all_categories = get_categories( $get_parent_cats );

	            foreach( $all_categories as $single_category ){
	               
	                $catID = $single_category->cat_ID;

	                $get_children_cats = array(
	                    'child_of' => $catID ,
	                    'taxonomy' => 'product_cat'
	                );

	                $child_cats = get_categories( $get_children_cats );

	                $class = ( !empty( $child_cats ) ) ? 'menu-item-has-children cat-menu-dropdown' : '';

	                echo '<li class="menu-item '. $class .' menu-item-type-custom cat-menu"><a href=" ' . get_category_link( $catID ) . ' ">' . $single_category->name . '<i class="fas fa-caret-right"></i></a>';
	                
	                if ( !empty( $child_cats ) ) {
		                echo '<ul class="children cat-sub-menu">';
		                    foreach( $child_cats as $child_cat ){	                        
		                        $childID = $child_cat->cat_ID;
		                        if( $catID == $child_cat->parent ) {
		                        	echo '<li><a href=" ' . get_category_link( $childID ) . ' ">' . $child_cat->name . '</a></li>';
		                        }
		                    }
		                echo '</ul>';
	                 }
	                echo '</li>';
	            } //end of categories logic ?>
	    </ul>
	    <ul id="menu-vertical-mob" class="menu menu-vertical-mobile menu-vertical-menu">
			<a class="back-to-main"><i class="fas fa-caret-left"></i><? _e('Back to main menu','24apotek'); ?></a> 
			<a class="bundled-product" href="<? echo apotek_get_page_link( 'pakkelosninger' );?>"><? _e('Bundle Products','24apotek'); ?></a>
	        <?php 
	        	$uncategorized = get_option( 'default_product_cat' );
	            $get_mob_parent_cats = array(
	                'parent' => '0' ,
	                'taxonomy' => 'product_cat',
	                'exclude' => $uncategorized,
	            ); 

	            $all_mob_categories = get_categories( $get_mob_parent_cats );

	            foreach( $all_mob_categories as $single_mob_category ){
	               
	                $mob_catID = $single_mob_category->cat_ID;

	                $get_mob_children_cats = array(
	                    'child_of' => $mob_catID ,
	                    'taxonomy' => 'product_cat'
	                );

	                $child_mob_cats = get_categories( $get_mob_children_cats );

	                $class = ( !empty( $child_mob_cats ) ) ? 'menu-item-has-children cat-menu-dropdown' : '';

	                echo '<li data-id="#'. $single_mob_category->cat_ID .'" class="menu-item '. $class .' menu-item-type-custom cat-menu"><a href=" ' . get_category_link( $mob_catID ) . ' ">' . $single_mob_category->name . '</a><i class="fas fa-caret-right"></i>';
	                
	                $child_mob_cats = get_categories( $get_mob_children_cats );

	                echo '</li>';
	            } //end of categories logic ?>
	    </ul>
	    <?
		    if ( !empty( $all_mob_categories ) ) {
		    	foreach( $all_mob_categories as $single_mob_category ) {
		    		$mob_catID = $single_mob_category->cat_ID;
		    		$get_mob_children_cats = array(
	                    'child_of' => $mob_catID ,
	                    'taxonomy' => 'product_cat'
	                );
	                $child_mob_cats = get_categories( $get_mob_children_cats );
	                if( !empty( $child_mob_cats ) ) {
		            echo '<ul id="'. $single_mob_category->cat_ID .'" class="children cat-sub-menu">';
		            echo'<a class="back-to-menu"><i class="fas fa-caret-left"></i>' . __('Back to main menu','24apotek') . '</a>';
		                foreach( $child_mob_cats as $child_mob_cat ) {	                        
		                    $mob_childID = $child_mob_cat->cat_ID;
		                    if( $mob_catID == $child_mob_cat->parent ) {
	                        	echo '<li><a href=" ' . get_category_link( $mob_childID ) . ' ">' . $child_mob_cat->name . '</a></li>';
	                        }
		                }
		            echo '</ul>';
	                }
		    	}
	        }	
	    ?>	
    <?
	}
}

/* List all tags of the woocommerce */
add_shortcode('list_attributes_for_tag','list_attributes_for_tag');
if (!function_exists('list_attributes_for_tag')) {
	function list_attributes_for_tag() {
		global $wpdb;
		$options = array('hide_empty' => false);

		$terms = get_terms('pa_leverandor', $options);
		foreach ( $terms as $key => $value) {
			$link = get_category_link( $value->term_id );
			?>
			<a href="<? echo $link; ?>"><? echo $value->name; ?></a>
			<?
		}
	}
}

/*Add action for register route */
add_action('init','apotek24_add_wishlist_tab');
if (!function_exists('apotek24_add_wishlist_tab')) {
	function apotek24_add_wishlist_tab() {
		add_rewrite_endpoint( 'wishlist', EP_PAGES );
	}
}
/* Register the page for the wishlist */
add_action( 'woocommerce_account_wishlist_endpoint', 'apotek24_wislist_tab' );
if (!function_exists('apotek24_wislist_tab')) {
	function apotek24_wislist_tab() {
		echo do_shortcode('[yith_wcwl_wishlist]');
	}
}


/* Shortcode that will display on the related product */
add_shortcode('produkt','apotek24_single_products');
if (!function_exists('apotek24_single_products')) {
	function apotek24_single_products( $atrr ) {
		$product_id = $atrr['id'];
		$product = wc_get_product( $product_id );
		if ( ! $product ) {
			return;
		}
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
		ob_start();
		?>
		<a href="<? echo get_permalink( $product_id ); ?>" class="single-page__related-product-desktop">
			<div class="single-page__related-product">
				<div class="single-page__related-img-col single-page-product-img-desktop">
					<span class="prod-thumb-image" style="background-image:url('<? echo get_the_post_thumbnail_url( $product_id ); ?>'); ">
					</span>
				</div>
				<div class="single-page__product-col">
						<div class="single-page__product-desc">
							<div class="single-page__product-desc-wrap">
								<h2><? echo mb_strimwidth( $product->get_name(),0,20,'...'); ?></h2>
								<p><? echo wp_trim_words( $product->get_short_description(),10,'...' );?></p>
							</div>
							<? if ( $rating_count > 0 ) { ?> 
								<div class="woocommerce">
									<div class="single-page-product-loop-rating">
										<?php 
												echo wc_get_rating_html( $average, $rating_count ); 
												echo "(". $rating_count .")"; 
										?>
									</div>
								</div>
							<? } if( is_user_logged_in() ) {
									$membership = get_membership_name_and_url( get_current_user_id() );
								} else {
									$membership = array();
								}
								$regular_price = apotek24_get_price( $product,$product->get_regular_price() );
								$price = apotek24_get_price( $product, $product->get_price() );
							?>
							<span class="price">
								<? if ( !empty( $membership ) || $product->is_on_sale() ) { ?>
								<span class="regular-price">
									<span class="regular-price-text">
										<? _e('Regular Price','24apotek'); ?>
									</span>
									<span><del><? echo $product->get_regular_price()?></del></span>
								</span>
								<? } else { ?>
								
									<span class="regular-price">
										<span class="regular-price-text">
											<? _e('Regular Price','24apotek'); ?>
										</span>
										<span><? echo wc_price( $regular_price ); ?></span>
									</span>
								<? } 
								if ( !empty( $membership ) || $product->is_on_sale() ) {
								?> 
									<span class="sale-price">
										<span class="sale-price-text"><? _e('Your price','24apotek'); ?></span>
										<span><? echo wc_price( $price ); ?></span>
									</span> 
								<? } ?>
							</span>
						</div>
					</div>
			</div>
		</a>
		<div class="single-page__related-product single-page__related-product-mob">
			<div class="single-page__related-img-col single-page-product-img-mob">
				<a href="<? echo get_permalink( $product_id ); ?>" >
					<? echo $product->get_image(); ?>
				</a>
			</div>
			<div class="single-page__product-col">
				<div class="single-page__product-desc">
					<div class="single-page__product-desc-wrap">
						<h2><a href="<? echo get_permalink( $product_id ); ?>" ><? echo mb_strimwidth( $product->get_name(),0,20,'...'); ?></a></h2>
						<p><? echo wp_trim_words( $product->get_short_description(),10,'...' );?></p>
					</div>
					<? if ( $rating_count > 0 ) { ?> 
						<div class="woocommerce">
							<div class="single-page-product-loop-rating">
								<?php 
										echo wc_get_rating_html( $average, $rating_count ); 
										echo "(". $rating_count .")"; 
								?>
							</div>
						</div>
					<? } 
					
					if( is_user_logged_in() ) {
						$membership = get_membership_name_and_url( get_current_user_id() );
					} else {
						$membership = array();
					}
					$regular_price = apotek24_get_price( $product,$product->get_regular_price() );
					$price = apotek24_get_price( $product, $product->get_price() );
					?>
					<span class="price">
						<? if ( !empty( $membership ) || $product->is_on_sale() ) { ?>
						<span class="regular-price">
							<span class="regular-price-text">
								<? _e('Regular Price','24apotek'); ?>
							</span>
							<span><del><? echo wc_price( $regular_price ); ?></del></span>
						</span>
						<? } else { ?>
							<span class="regular-price">
								<span class="regular-price-text">
									<? _e('Regular Price','24apotek'); ?>
								</span>
								<span><? echo wc_price( $regular_price ); ?></span>
							</span>
						<? } 
						if ( !empty( $membership ) || $product->is_on_sale() ) {
						?>
						<span class="sale-price">
							<span class="sale-price-text"><? _e('Your price','24apotek'); ?></span>
							<span><? echo wc_price( $price ); ?></span>
						</span> 
						<? } ?>
					</span>
					<span class="single-page__button-wrap-mob">
						<a href="?add-to-cart=<? echo $product->get_id(); ?>" data-quantity="1"
						class="btn-blue-filled button product_type_simple add_to_cart_button ajax_add_to_cart" 
						data-product_id="<? echo $product->get_id(); ?>" 
						data-product_sku="<? echo $product->get_sku(); ?>" 
						aria-label="<? echo $product->get_name(); ?>" 
						rel="nofollow"><? _e('Buy Now','24apotek'); ?></a>
						<a class="btn-white button custom-button" href="<? echo $product->get_permalink( $product->get_id() );?>"><? _e('View Details','24apotek'); ?></a>
					</span>
				</div>
			</div>
		</div>
		<?
		$output = ob_get_clean();
		return $output;
	}
}
/* Shortcode that will display on the related product */
add_shortcode('produkter','apotek24_related_products');
if (!function_exists('apotek24_related_products')) {
	function apotek24_related_products( $atrr ) {
		extract( shortcode_atts( array (
    				'id' => '',
    			), $atrr ) );
    	$post_ids = explode(',', $id);
		ob_start();
		$get_product = wc_get_products(array( 
			'include' => $post_ids, 
			'limit' => -1
		));
		global $product;
		$related_products = $get_product;
		  ?>
		  <div class="trending-products__section-wrap section-pd-top-50">
		  	<div class="woocommerce columns-4 trending-products">
		  		<ul class="products columns-4">
		  			<?php foreach ( $related_products as $related ) : ?>

		  				<?php
		  				$post_object = get_post( $related->get_id() );

		  				setup_postdata( $GLOBALS['post'] =& $post_object ); 

		  				wc_get_template_part( 'content', 'product' );
		  				?>

		  			<?php endforeach; ?>
		  		</ul>
		  	</div>
		  </div>
		<?
		wp_reset_postdata();
		$output = ob_get_clean();
		return $output;
	}
}

/* Related products for the article content */
add_action('apotek24_related_article','apotek24_after_article_content');
if (!function_exists('apotek24_after_article_content')) {
	function apotek24_after_article_content() {
		$arg = array( 
			'numberposts' => 4,
			'post_type'   => 'post',
			'orderby' => 'publish_date',
			'order' => 'DESC',
			'suppress_filters' => false,
		);
		$all_news = get_posts( $arg );
		?>
		
		<?
	}
}

/* Show Search Suggestion */
add_action('wp_ajax_apotek24_search_suggestion','apotek24_search_suggestion_new');
add_action('wp_ajax_nopriv_apotek24_search_suggestion','apotek24_search_suggestion_new');
if (!function_exists('apotek24_search_suggestion_new')) {
	function apotek24_search_suggestion_new() {
		$search = $_POST['search'];
		if ( empty( $search ) ) {
			$output['.search-suggestion'] = '';
			wp_send_json( $output );
		}
		ob_start();
		require "home-search-results.php";
		$output['.search-suggestion'] = ob_get_clean();
		wp_send_json( $output );
	}
}

//Save discont product
add_action('wp_ajax_apotek24_save_discount_product','apotek24_save_discount_product');
add_action('wp_ajax_nopriv_apotek24_save_discount_product','apotek24_save_discount_product');
if (!function_exists('apotek24_save_discount_product')) {
	function apotek24_save_discount_product() {
		$product_id = $_POST['id'];
		$start_date = date('Y-m-d H:m:s');
		$end_date = date('Y-m-d H:m:s', strtotime("+6 months"));
		$user_id = get_current_user_id();
		update_user_meta( $user_id,'discount_end_date', $end_date );
		update_user_meta( $user_id,'discount_product_id', $product_id );
		wp_send_json( 'successfully' );
	}
}

add_action('wp_login','apotek24_remove_lock_product');
/* Function to remove the discount rule */
if (!function_exists('apotek24_remove_lock_product')) {
	function apotek24_remove_lock_product() {
		$user_id = get_current_user_id();
		$discount_product_id = get_user_meta( $user_id,'discount_product_id', true );
		$discount_end_date = get_user_meta( $user_id,'discount_end_date', true );
		$date_now = new DateTime();
		$discount_end_date    = new DateTime( $discount_end_date );
		if ( $date_now > $discount_end_date ) {
			update_user_meta( $user_id,'discount_product_id', '' );
			update_user_meta( $user_id,'discount_end_date', '' );
		}
	}
}

/* This function is used for searching on the article page */
add_action('wp_ajax_apotek24_article_search','apotek24_article_search');
add_action('wp_ajax_nopriv_apotek24_article_search','apotek24_article_search');
if (!function_exists('apotek24_article_search')) {
	function apotek24_article_search() {
		$search = isset( $_POST['search'] ) ? $_POST['search'] : '';
		$query = isset( $_POST['query'] ) ? $_POST['query'] : '';
		if ( !empty( $search ) ) {
			$args = array( 
				"post_type" => "post",
				'post_status' => 'publish',
				'posts_per_page'    => -1,	 
				"s" => $search 
			); 
		} else {
			$args = $query;
		}
		query_posts( $args );
		if( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/tips-listing', get_post_type() );
			}
		}
		else {
			?>
			<h4 class="page-title"><? _e('Nothing found','24apotek');?></h4>
			<?
		}
		die();
	}
}

/* Redirect serach to product page */
add_action('template_redirect', 'redirect_to_woocommerce_search');
if(!function_exists('redirect_to_woocommerce_search')) {
	function redirect_to_woocommerce_search() {
	    if (!is_shop() && isset($_GET['s'])) {
	        $shop_url = get_permalink(wc_get_page_id('shop'));
	        $new_search_url = add_query_arg(array('s' => rawurlencode(htmlspecialchars_decode(get_query_var('s')))), $shop_url);
	        wp_redirect($new_search_url);
	        exit;
	    }
	}	
}


/*Change page title of the shop */
add_filter('woocommerce_page_title', 'override_woocommerce_page_title');
if(!function_exists('override_woocommerce_page_title')) {
	function override_woocommerce_page_title($page_title) {
    if (is_search()) {
	        $page_title = sprintf(__('Search results <span>&ldquo;%s&rdquo;</span>', '24apotek'), get_search_query());
	    } else {
	    	$page_title = '';
	    }
	    return $page_title;
	}	
}


remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
if (isset($_GET['s'])) {
	 add_action('apotek_before_shop_loop', 'woocommerce_result_count', 5);
}

/*Function to change the membership of the customer */
if(!function_exists('change_membership_role')) {
	function change_membership_role($user_id) {
		$args = array(
    		'date_completed' => '1494971177...1494938777',
    		'customer_id' => $user_id
		);
		$orders = wc_get_orders( $args );
		$total = array_reduce($orders, function ($carry, $order) {
	        $carry += (float)$order->get_total();
	        	return $carry;
	    	}, 0.0
	    );
	    
	}
}


/*This function runs when user will performe any action this will run once in a day */
add_action('init','apotek24_update_action_once_in_a_day');
if(!function_exists('apotek24_update_action_once_in_a_day')) {
	function apotek24_update_action_once_in_a_day() {
		if(!is_user_logged_in()) {
			return;
		}
		$user_id = get_current_user_id();
		$last_update_check = get_user_meta( $user_id,'last_update_check', true );
		if( !empty( $last_update_check ) && $last_update_check == date("Y-m-d") ) {
			return;
		}
		$user = get_userdata( $user_id );
		$user_roles = $user->roles;
		if ( in_array( 'customer', $user_roles, true ) ||  in_array( 'premium', $user_roles, true )
		||  in_array( 'gold', $user_roles, true ) ) {
		    apotek24_update_customer_user_role( $user_id );
		    update_user_meta( $user_id,'last_update_check',date("Y-m-d"));
		} elseif( in_array( 'vip-plus', $user_roles, true ) ||  in_array( 'preium-plus', $user_roles, true )
		||  in_array( 'gold-plus', $user_roles, true ) ) {
			apotek24_update_customer_vip_user_role( $user_id );
			update_user_meta( $user_id,'last_update_check',date("Y-m-d"));
		}
		//check for the unlock product.
		apotek24_remove_lock_product();
		//wc_update_product_lookup_tables();
	}	
}
/* This is code will on the order complete */
add_action( 'woocommerce_order_status_changed','apotek24_woocommerce_order_status_changed', 10, 3 );
if(!function_exists('apotek24_woocommerce_order_status_changed')) {
	function apotek24_woocommerce_order_status_changed( $order_id, $old_status, $new_status ) {
		if($old_status != $new_status) {
			if($new_status == 'completed') {
				$order = wc_get_order( $order_id );
				$user_id = absint( $order->get_user_id() );
				$user = get_userdata( $user_id );
				$user_roles = $user->roles;
				if ( in_array( 'customer', $user_roles, true ) ||  in_array( 'premium', $user_roles, true )
				||  in_array( 'gold', $user_roles, true ) ) {
				    apotek24_update_customer_user_role( $user_id );
				} elseif( in_array( 'vip-plus', $user_roles, true ) ||  in_array( 'preium-plus', $user_roles, true )
				||  in_array( 'gold-plus', $user_roles, true ) ) {
					apotek24_update_customer_vip_user_role( $user_id );
				}
			}
		}
	}
}
/* Update function that will update the user */
if(!function_exists('apotek24_update_customer_user_role')) {
	function apotek24_update_customer_user_role( $user_id ) {
		$total = get_order_total_in_one_year( $user_id );
		// $total = 21000.00;
			$user = new WP_User($user_id);
			$order_total = get_field('discount_membership','option');
			$premium_order_total = isset( $order_total['order_total_for_premium'] ) ? $order_total['order_total_for_premium'] : 15000;
			$gold_order_total = isset( $order_total['order_total_for_gold'] ) ? $order_total['order_total_for_gold'] : 20000;
			$user_roles = reset( $user->roles );
		if(  $total >= $premium_order_total && $total < $gold_order_total ) {
			$user->remove_role( $user_roles );
			$user->add_role( 'premium' );
		} elseif( $total >= $gold_order_total ) {
			$user->remove_role( $user_roles );
			$user->add_role( 'gold' );
		} elseif( $total >= 0 && $total < $premium_order_total ) {
			$user->remove_role( $user_roles );
			$user->add_role( 'customer' );
		}
		return true;
	}
}
/* Update function that will update the user */
if(!function_exists('apotek24_update_customer_vip_user_role')) {
	function apotek24_update_customer_vip_user_role( $user_id ) {
		$total = get_order_total_in_one_year( $user_id );
		$order_total = get_field('discount_membership','option');
		$premium_order_total = isset( $order_total['order_total_for_premium'] ) ? $order_total['order_total_for_premium'] : 15000;
		$gold_order_total = isset( $order_total['order_total_for_gold'] ) ? $order_total['order_total_for_gold'] : 20000;
		$user = new WP_User($user_id);
		$user_roles = reset( $user->roles );
		if(  $total >= $premium_order_total && $total < $gold_order_total ) {
			$user->remove_role( $user_roles );
			$user->add_role( 'preium-plus' );
		} elseif( $total >= $gold_order_total ) {
			$user->remove_role( $user_roles );
			$user->add_role( 'gold-plus' );
		} elseif( $total > 0 && $total < $premium_order_total ) {
			$user->remove_role( $user_roles );
			$user->add_role( 'vip-plus' );
		}
		return true;
	}
}
/*Get order total between 1 year of the user */
if(!function_exists('get_order_total_in_one_year')) {
	function get_order_total_in_one_year( $user_id ) {
		$today_date = current_time('Y-m-d H:i:s');
		$previous_date = date('Y-m-d H:i:s', strtotime('-1 year', strtotime($today_date)) );
		$args = array(
	    	'customer_id' => $user_id,
	    	'date_completed' => strtotime($previous_date).'...'.strtotime($today_date),
	    	'limit' => -1,
	    	'status' => 'completed',
		);
		$orders = wc_get_orders( $args );
		$total = 0;
		if ( empty( $orders ) ) {
			return $total;
		}
		
		$total = array_reduce($orders, function ($carry, $order) {
		    $carry += (float)$order->get_total();
		        	return $carry;
		    	}, 0.0
		);
		return $total;
	}
}



if(!function_exists('apotek24_shipping_instance_form_fields_filters')) {
	function apotek24_shipping_instance_form_fields_filters() {
	    $shipping_methods = WC()->shipping->get_shipping_methods();
	    foreach($shipping_methods as $shipping_method) {
	        add_filter('woocommerce_shipping_instance_form_fields_' . $shipping_method->id, 'apotek24_shipping_instance_form_add_extra_fields');
	    }
	}	
}

add_action('woocommerce_init', 'apotek24_shipping_instance_form_fields_filters');

/* Shipping form fields */
if(!function_exists('apotek24_shipping_instance_form_add_extra_fields')) {
	function apotek24_shipping_instance_form_add_extra_fields( $settings ) {
	    $settings['shipping_desc_text'] = [
	        'title' => __( 'Shipping description', '24apotek' ),
	        'type' => 'text', 
	        'placeholder' => __( 'Shipping description text', '24apotek' ),
	        'description' => ''
	    ];
	    $settings['sort_order'] = [
	        'title' => __( 'Sort Order', '24apotek' ),
	        'type' => 'text', 
	        'placeholder' => __( 'Sort Order', '24apotek' ),
	        'description' => ''
	    ];
	    return $settings;
	} 	
}

/* Get name and image form the user id */
if(!function_exists('get_membership_name_and_url')) {
	function get_membership_name_and_url( $user_id ) {
		if (! is_user_logged_in() ) { 
			return;
		}
		// return;
		$user = new WP_User($user_id);
		$user_roles = reset( $user->roles );
		$args = array(
    				'post_type'  => 'yith_price_rule',
			    	'meta_query' => array(
					    array(
					        'key'   => '_ywcrbp_role',
					        'value' => $user_roles,
				)
			)
		);
		$user_post = get_posts( $args );
		$membership_id = array();
		// $user_post = reset( $user_post );
		if( empty( $user_post ) ) {
			return ;
		}
		foreach( $user_post as $memeber_rule ) {
			$membership_id[] = $memeber_rule->ID;
		}
		$membership = get_field( 'membership_name_with_images','option' );
		$membership_array = array( 
			'membership' => $user_post
		);
		if( isset( $membership ) ) {
			foreach( $membership as $key => $value ) {
				if( isset($value['membership_rules']) && in_array( $value['membership_rules']->ID , $membership_id ) ) {
					$membership_array['images'] = $value['icon'];
					$membership_array['names'] = $value['names'];
					$membership_array['membership_images'] = $value['membership_image'];
					$membership_array['discount_for_favourite_product'] = $value['discount_for_favourite_product'];
				}
			}
		}
		return $membership_array;
	}	
}

/* Reduce the size of the name in heading in wishlist */
add_filter('woocommerce_in_cartproduct_obj_title','apotek24_wishlist_product_name',10,2);
if(!function_exists('apotek24_wishlist_product_name')) {
	function apotek24_wishlist_product_name( $title, $product ) {
		$title = mb_strimwidth( $title,0,30,'...' );
		return $title; 
	}
}

add_filter('ywcrbp_get_your_price_html','apotek24_ywcrbp_get_your_price_html',10,2);
if(!function_exists('apotek24_ywcrbp_get_your_price_html')) {
	function apotek24_ywcrbp_get_your_price_html( $your_price_html, $product ) {
		$your_price_txt = apply_filters( 'yith_role_based_price_your_price_label', get_option( 'ywcrbp_your_price_txt' ) );
		$user_id = get_current_user_id();
		$discount_product_id = get_user_meta( $user_id,'discount_product_id', true );
		$your_price_html = str_replace($your_price_txt,'',$your_price_html);
		if( ! empty( $discount_product_id ) && $discount_product_id == $product->get_id() || $product->is_on_sale() ) {
			$your_price_html = str_replace($your_price_txt,'',$your_price_html);
			$your_price_html = wc_price( apotek24_get_price( $product,$product->get_price() ) );
			$html = '<div class="sale-price"><span class="sale-price-text">'.$your_price_txt.'</span><span>'.$your_price_html.'</span></div>';
			return $html;
		}
		$html = '<div class="sale-price"><span class="sale-price-text">'.$your_price_txt.'</span><span>'.$your_price_html.'</span></div>';
		return $html;
	}
}

/* Used when the widget is displayed as a list */
add_filter( 'woocommerce_product_categories_widget_dropdown_args', 'apotek24_exclude_wc_widget_categories' );
add_filter( 'woocommerce_product_categories_widget_args', 'apotek24_exclude_wc_widget_categories' );
if(!function_exists('apotek24_exclude_wc_widget_categories')) {
	function apotek24_exclude_wc_widget_categories( $cat_args ) {
	    $cat_args['exclude'] = array('17'); 
	    return $cat_args;
	}	
}

add_filter('woocommerce_cart_shipping_method_full_label','apotek24_woocommerce_cart_shipping_method_full_label',10,2);
if(!function_exists('apotek24_woocommerce_cart_shipping_method_full_label')) {
	function apotek24_woocommerce_cart_shipping_method_full_label( $label, $method ) {
		$has_cost  = 0 < $method->cost;
		$hide_cost = ! $has_cost && in_array( $method->get_method_id(), array( 'free_shipping', 'local_pickup' ), true );
		
		if ( $has_cost && ! $hide_cost ) {
			if ( WC()->cart->display_prices_including_tax() ) {
				$label =   wc_price( $method->cost + $method->get_shipping_tax() );
			} else {
				$label = wc_price( $method->cost );
			}
		} else {
			$label = wc_price( 0 );
		}
		return $label;
	}
}



/* This function is used for adding the the fragment */
add_filter('yith_wcwl_ajax_add_return_params','apotek24_yith_wcwl_ajax_add_return_params',10,1);
if(!function_exists('apotek24_yith_wcwl_ajax_add_return_params')) {
	function apotek24_yith_wcwl_ajax_add_return_params( $response ) {
		ob_start();
		?>
		<span class="wishlist__counter"><? echo yith_wcwl_count_products();?></span>
		<?
		$response['fragments']['.wishlist__counter'] = ob_get_clean();
		ob_start();
		?>
		<span class="counter wishlist-sticky-counter"><? echo yith_wcwl_count_products();?></span>
		<?
		$response['fragments']['.wishlist-sticky-counter'] = ob_get_clean();
		return $response;
	}
}
/* This function is used for adding the the fragment */
add_filter( 'preprocess_comment', 'apotek24_check_comment_rating' , 1 );
if( !function_exists('apotek24_check_comment_rating')) {
	function apotek24_check_comment_rating( $comment_data ) {
		// If posting a comment (not trackback etc) and not logged in.
		if ( ! is_admin() && isset( $_POST['comment_post_ID'], $_POST['rating'], $comment_data['comment_type'] ) && 'product' === get_post_type( absint( $_POST['comment_post_ID'] ) ) && empty( $_POST['privacy-condition'] )  ) { // WPCS: input var ok, CSRF ok.
			wp_die( esc_html__( 'Please accept the privacy policy.', 'woocommerce' ) );
			exit;
		}
		return $comment_data;
	}
} 

add_filter('widget_title','apoteck24_widget_title',10,3);
/* this function is used for changing the title of the category */
if( !function_exists('apoteck24_widget_title') ) {
	function apoteck24_widget_title( $title, $instance, $id_base) {
		if( 'woocommerce_product_categories' == $id_base ) {
			if( is_product_category() ) {
				$term = get_queried_object();
				if( !empty( $term->parent ) ) {
					$mainCategory = get_term_by( 'id', $term->parent, 'product_cat' );
					$link = get_category_link( $mainCategory->term_id );
					$title = '<a href="'.$link.'">'.$mainCategory->name.'</a>';
				}
			}
		}
		return $title;
	}
}

if(!function_exists('get_tax_level')) {
	function get_tax_level($id, $tax) {
    	$ancestors = get_ancestors($id, $tax);
    	return count($ancestors)+1;
	}	
}

/* Change the cart total */
add_filter('woocommerce_cart_totals_order_total_html','apoteck24_change_cart_total',999,1);
if(!function_exists('apoteck24_change_cart_total')) {
	function apoteck24_change_cart_total( $value ) {
		$value = '<strong>' . WC()->cart->get_total() . '</strong> ';
		// If prices are tax inclusive, show taxes here.
		if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) {
			$tax_string_array = array();
			$cart_tax_totals  = WC()->cart->get_tax_totals();
	
			if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
				foreach ( $cart_tax_totals as $code => $tax ) {
					$tax_string_array[] = sprintf( '%s %s', get_woocommerce_currency_symbol().' '.$tax->formatted_amount, $tax->label );
				}
			} elseif ( ! empty( $cart_tax_totals ) ) {
				$tax_string_array[] = sprintf( '%s %s', get_woocommerce_currency_symbol().' '.wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
			}
			if ( ! empty( $tax_string_array ) ) {
				$taxable_address = WC()->customer->get_taxable_address();
				/* translators: %s: country name */
				$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ? sprintf( ' ' . __( 'estimated for %s', 'woocommerce' ), WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] ) : '';
				$value .= '<small class="includes_tax">('
							/* translators: includes tax information */
							. esc_html__( 'includes', '24apotek' )
							. ' '
							. wp_kses_post( implode( ', ', $tax_string_array ) )
							. esc_html( $estimated_text )
							. ')</small>';
			}
		}
		$value = get_woocommerce_currency_symbol().' '.$value;
		return $value;
	}
}

/* Change the sub total */
add_filter('woocommerce_cart_subtotal','apotek24_change_woocommerce_cart_subtotal',10,3);
if( !function_exists('apotek24_change_woocommerce_cart_subtotal')) {
	function apotek24_change_woocommerce_cart_subtotal( $cart_subtotal, $compound,$cart ) {
		$cart_tax_totals  = WC()->cart->get_tax_totals();
		if( !is_cart() && !empty( $cart_tax_totals ) ) {
			if ( $compound ) {
				$cart_subtotal = wc_price( $cart->get_cart_contents_total() + $cart->get_shipping_total() + $cart->get_taxes_total( false, false ) );
	
			} elseif ( $cart->display_prices_including_tax() ) {
				$cart_subtotal = wc_price( $cart->get_subtotal() + $cart->get_subtotal_tax() );

			} else {
				$cart_subtotal = wc_price( $cart->get_subtotal() );
			}
		
			if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
				foreach ( $cart_tax_totals as $code => $tax ) {
					$tax_string_array[] = sprintf( '%s %s', get_woocommerce_currency_symbol().' '.$tax->formatted_amount, $tax->label );
				}
			} elseif ( ! empty( $cart_tax_totals ) ) {
				$tax_string_array[] = sprintf( '%s %s', get_woocommerce_currency_symbol().' '.wc_price( $cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
			}
			$cart_subtotal = get_woocommerce_currency_symbol().' '.$cart_subtotal.'<small class="includes_tax">('.esc_html__( 'includes', '24apotek' ).' '.implode( ', ', $tax_string_array ).')</small>';
		} else {
			$cart_subtotal = get_woocommerce_currency_symbol().' '.$cart_subtotal;
		}
		return $cart_subtotal;
	}
}

/* Add the sku of the attributes */
add_filter('woocommerce_display_product_attributes','apotek24_woocommerce_display_product_attributes',10,2);
if( !function_exists('apotek24_woocommerce_display_product_attributes')) {
	function apotek24_woocommerce_display_product_attributes( $product_attributes, $product ) {
		if( !empty( $product_attributes ) ) {
			$product_attributes['sku'] = array( 
				'label' => __( 'Sku','24apotek' ), 
				'value' => $product->get_sku(),
				);
		}
		return $product_attributes;
	}
}

/* This function is used for listing of the subpages */
add_action('apotek24_list_subchildren_pages','apotek24_list_subchildren_pages');
if(!function_exists('apotek24_list_subchildren_pages')) {
	function apotek24_list_subchildren_pages( $current_page_id ) {
		$page_id = get_page_by_path( 'kundeservice' );
		$childArgs = array(
    		'sort_order' => 'ASC',
    		'sort_column' => 'menu_order',
    		'child_of' => $page_id->ID
			);
		$childList = get_pages($childArgs);
		?>
		<nav class="customer-service-navigation">
			<div class="customer-service__nav-desk">
				<h4><a href="<? echo get_permalink( $page_id->ID ); ?>" ><? _e('Customer service','24apotek'); ?></a></h4>
				<ul id="customer-service__tab-links">
					<? if( ! empty( $childList ) ) { 
						foreach ( $childList as $key => $child ) { 
							$children_id = $child->ID;
							$class = ( $children_id == $current_page_id ) ? 'active' : '' ;
						?>
						<li><a href="<? echo get_permalink( $child->ID ); ?>" class="<? echo $class;  ?>"><? echo get_the_title( $child->ID ); ?></a></li>
						<? } ?>
					<? } ?>				
				</ul>
				<div class="need-help-section need-help__desktop">
					<h4><?_e('Still Need Help?','24apotek');?></h4>
					<p><? _e('Have something to say? We\'d love to hear from you.','24apotek'); ?></p>
					<div class="customer-service__containercontact-btn">
						<a class="btn-black" href="<? echo apotek_get_page_link ('kontakt-oss' );?>"><? _e('CONTACT US','24apotek'); ?></a>
					</div>
				</div>
				<div class="customer-service__live-chat-btn">
					<a class="btn-live"><? _e('LIVE CHAT','24apotek'); ?></a>
				</div>
			</div>
			<div class="dropdown customer-service__nav-mob">
				<button class="customer-service__nav-button btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<? _e('Select page','24apotek'); ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<? if( ! empty( $childList ) ) {
						?>
						<a class="dropdown-item" href="<? echo get_permalink( $page_id->ID ); ?>"><? _e('Customer service','24apotek'); ?></a>
						<?
						foreach ( $childList as $key => $child ) { 
						?>
							<a class="dropdown-item" href="<? echo get_permalink( $child->ID ); ?>"><? echo get_the_title( $child->ID ); ?></a>
						<? } ?>
					<? } ?>
				</div>
			</div>
		</nav>
		<?
	}
}


/**
 * Allow to remove method for an hook when, it's a class method used and class don't have global for instanciation !
 */
 
 // we can rename this function just wait let me do it.
 if( !function_exists('apoteck24_remove_filters_with_method_name')) {
 	function apoteck24_remove_filters_with_method_name( $hook_name = '', $method_name = '', $priority = 0 ) {
		global $wp_filter;
	
		// Take only filters on right hook name and priority
		if ( ! isset( $wp_filter[ $hook_name ][ $priority ] ) || ! is_array( $wp_filter[ $hook_name ][ $priority ] ) ) {
			return false;
		}
	
		// Loop on filters registered
		foreach ( (array) $wp_filter[ $hook_name ][ $priority ] as $unique_id => $filter_array ) {
			// Test if filter is an array ! (always for class/method)
			if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
				// Test if object is a class and method is equal to param !
				if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && $filter_array['function'][1] == $method_name ) {
					// Test for WordPress >= 4.7 WP_Hook class (https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/)
					if ( is_a( $wp_filter[ $hook_name ], 'WP_Hook' ) ) {
						unset( $wp_filter[ $hook_name ]->callbacks[ $priority ][ $unique_id ] );
					} else {
						unset( $wp_filter[ $hook_name ][ $priority ][ $unique_id ] );
					}
				}
			}
	
		}
	
		return false;
	}
 }

/* Remove the action */
add_action('init','apotek24_remove_action_inclusive_tax');
if(!function_exists('apotek24_remove_action_inclusive_tax')) {
	function apotek24_remove_action_inclusive_tax() {
		apoteck24_remove_filters_with_method_name( $hook_name = 'option_woocommerce_tax_display_shop', $method_name = 'show_price_incl_excl_tax', $priority = 10 );	
		apoteck24_remove_filters_with_method_name( $hook_name = 'option_woocommerce_tax_display_cart', $method_name = 'show_price_incl_excl_tax', $priority = 10 );	
	}
}


/* This filters is used to change the placeholder */
add_filter('woocommerce_my_account_my_address_formatted_address','apotek24_my_account_my_address',10,1);
if(!function_exists('apotek24_my_account_my_address')) {
	function apotek24_my_account_my_address( $address ) {
		if( empty($address['address_1'] ) ) {
			$address['address_1'] = __('Address','24apotek');
		}
		if( empty($address['city'] ) ) {
			$address['city'] = __('City','24apotek');
		}
		if( empty( $address['postcode'] ) ) {
			$address['postcode'] = __('Postcode','24apotek');
		}
		return $address;
	}
}
/* Shipping Methods */
add_filter('woocommerce_package_rates', 'apotek24_hide_shipping', 10, 2);
if( !function_exists('apotek24_hide_shipping')) {
	function apotek24_hide_shipping($rates, $package) {
	    /* Hide shipping methods if cart count is less than 3 */
	    global $woocommerce;
	    if ($woocommerce->cart->cart_contents_count < 3) {
	    	unset($rates['free_shipping:2']);
	    	unset($rates['flat_rate:7']);
	    	unset($rates['flat_rate:8']);
	    } else {
	    	unset($rates['flat_rate:1']);
	    	unset($rates['flat_rate:5']);
	    	unset($rates['flat_rate:6']);
	    }
	    return $rates;
	}	
}

/* Custom sale tag */
add_action('woocommerce_shop_loop_item_title','filter_woocommerce_sale_flash' );
//add_filter('woocommerce_sale_flash', 'filter_woocommerce_sale_flash', 10, 3);
if( !function_exists('filter_woocommerce_sale_flash')) {
	function filter_woocommerce_sale_flash( ) {
		$span = '';
		global $product;
		$sale_label = get_post_meta($product->get_id(), 'on_sale_label', true);
		if (!empty($sale_label)) {
		    $text = $sale_label;
		    $class = is_product() ? 'single_camp_banner' : '';
			$span = '<div class="campaign '. $class .' "><div class="premium-icon"><img srcset="'.get_template_directory_uri().'/images/discount_icon_2@x.png" src="'.get_template_directory_uri().'/images/premium_icon.png" alt="premium_icon.png"></div><span>'.$text.'</span></div>';
			echo $span;
		} 
			
	}
}

/* Change template price */
add_filter('yith_wcgc_template_formatted_price','apotek24_wcgc_template_formatted_price',10,3);
if(!function_exists('apotek24_wcgc_template_formatted_price')) {
	function apotek24_wcgc_template_formatted_price( $formatted_price, $object, $context ) {
		return get_woocommerce_currency_symbol().'  '.$formatted_price;
	}
}

/* This code is used for adding the customizer */
/* Add Custom Logo Uploader for mobile */
add_action( 'customize_register', 'retina_custom_logo_upload' );
if (!function_exists('retina_custom_logo_upload')) {
	function retina_custom_logo_upload( $wp_customize ) {
		$wp_customize->add_setting( 'retina_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'retina_logo', 
				array(
					'label' => __('Retina Logo', '24apotek'),
					'section' => 'title_tagline',
					'settings' => 'retina_logo',
					'priority'   =>8,
				) 
			) 
		);
	}
}

/*Shop-Page*/
add_filter( 'loop_shop_per_page', 'shop_row_per_page', 20 );
/*Number of rows*/
function shop_row_per_page( $cols ) {
    $cols = 30;
    return $cols;
}
add_filter( 'loop_shop_columns', 'bt_new_loop_columns_per_page' );
/* Number of columns per row*/
function bt_new_loop_columns_per_page( $cols ) {
    $cols = 3;
    return $cols;
}

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		global $product;
		if( wp_is_mobile() ) {
			$title = mb_strimwidth(get_the_title(),0,50,'...');
		} else {
			$title = get_the_title();
		}
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . $title . '</h2>';
		if( get_field('subtitle',$product->get_id() ) )
			echo '<p class="subtitle">'.get_field('subtitle',$product->get_id() ).'</p>';
	}
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
add_action('apotek24_woocommerce_notice','woocommerce_output_all_notices', 10);

add_action('wp_ajax_apotek24_shiping_page_filter','apotek24_shiping_page_filter');
add_action('wp_ajax_nopriv_apotek24_shiping_page_filter','apotek24_shiping_page_filter');
if(!function_exists('apotek24_shiping_page_filter')) {
	function apotek24_shiping_page_filter() {
		$min_price = 0;
		$max_price = (float)$_POST['price'];
		if( $max_price > 100 ) {
			$min_price = 100;
		}
		$args = array(
		    'post_type' => 'product',
		    'numberposts' => 100,
		    'post_status' => 'publish',
		);
		if( !empty( $max_price )) {
			$args[ 'meta_query'] = array(
			'relation' => 'AND',
				array(
					'key'     => 'special',
					'value'   => 1,
				    'compare' => '='
				),
				array(
			     'key' => '_price',
			     'value' => array( $min_price, $max_price ),
			     'compare' => 'BETWEEN',
			     'type' => 'NUMERIC'
			    )
			);
		} else {
			$args = array(
	    		'post_type' => 'product',
	    		'numberposts' => 100,
	    		'meta_query' => array(
			        array(
			            'key' => 'special',
			            'value'   => 1,
			            'compare' => '='
			        )
	    		)
			); 
		}
		$special_products = get_posts( $args );
		ob_start();
		include_once get_template_directory().'/template-parts/special-offer.php';
		$output['.first_filter'] = ob_get_clean();
		wp_send_json( $output );
	}
}

add_filter('yith_wcrbp_return_original_price','yith_wcrbp_return_original_price',10,3);
if(!function_exists('yith_wcrbp_return_original_price')) {
	function yith_wcrbp_return_original_price( $bool , $price, $product ) {
		$otc = $product->get_meta('otc');
		if( !empty( $otc ) ) {
			$bool = true;
		}
		return $bool;
	}
}

add_filter( 'woocommerce_get_price_html','apotek_get_price_html', 11, 2 );
if(!function_exists('apotek_get_price_html')) {
	function apotek_get_price_html( $price, $product ) {
		$product_type = $product->get_type();
		$otc = $product->get_meta('otc');
		if( !empty( $otc ) ) {
			$obj = new YITH_Role_Based_Prices_Product();
			$regular_price = $product->get_regular_price();
			$sale_price    = $product->get_sale_price();
			$regular_price_html = $obj->get_regular_price_html( $product, $regular_price );
			$regular_price_html = $obj->get_formatted_price_html( $regular_price_html, false, 'regular' );
			$regular_price_html = apply_filters( 'ywcrbp_simple_regular_price_html', $regular_price_html, $regular_price, $product );
			return $regular_price_html;
		} else {
			return $price;
		}
		
	}
}

if( !function_exists('wc_custom_query_var') ) {
	function wc_custom_query_var( $query, $query_vars ) {
	    if ( ! empty( $query_vars['otc'] ) ) {
	        $query['meta_query'][] = array(
	            'key' => 'otc',
	            'compare' => 'NOT EXISTS',
	        );
	    }
	
	    return $query;
	}	
}
add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'wc_custom_query_var', 10, 2 );

add_filter('get_comment_author','apotek24_comment_author',10,3);
if(!function_exists('apotek24_comment_author')) {
	function apotek24_comment_author( $author, $comment_ID, $comment) {
		if( is_product() ) {
			$user = $comment->user_id ? get_userdata( $comment->user_id ) : false;
			if ( isset( $user->first_name ) || isset( $user->last_name ) ) {
				$author = $user->first_name.' '.$user->last_name;
			} 	
		}
		return $author;
	}
}

add_filter( 'woocommerce_add_to_cart_validation','otc_add_to_cart_validation',10,3);
if(!function_exists('otc_add_to_cart_validation')) {
	function otc_add_to_cart_validation( $validation, $product_id, $quantity ) {
		$_product = wc_get_product( $product_id );
		if( $_product->get_meta('otc') ) {
			if( check_is_product_in_cart( $product_id ) || 1 != (int) $quantity ) {
				$validation = false;
				wc_add_notice( __( 'You can only buy one of this item.', '24apotek' ), 'error' );
			}	
		}
		
		return $validation;
	}
}

add_filter( 'woocommerce_update_cart_validation','apoteck24_update_cart_validation',10 ,4);
if(!function_exists('apoteck24_update_cart_validation')){
	function apoteck24_update_cart_validation( $validation, $cart_item_key, $values, $quantity ) {
		$_product = wc_get_product( $values['product_id'] );
		if( $_product->get_meta('otc') ) {
			if( !empty( $quantity ) && 1 != (int) $quantity )  {
				$validation = false;
				wc_add_notice( __( 'You can only buy one of this item.', '24apotek' ), 'error' );
			}	
		}
		return $validation;
	}
}

if(!function_exists('check_is_otc_in_cart')) {
	function check_is_otc_in_cart() {
		$found = false;
		foreach( WC()->cart->get_cart() as $cart_item ) {
			$_product = wc_get_product( $cart_item['product_id'] );
			if( $_product->get_meta('otc') ) {
				$found = true;
				break;
			}
		}
		return $found;
	}	
}
if(!function_exists('check_is_product_in_cart')) {
	function check_is_product_in_cart( $product_id ) {
		$found = false;
		foreach( WC()->cart->get_cart() as $cart_item ) {
			$_product = wc_get_product( $cart_item['product_id'] );
			if( $cart_item['product_id'] == $product_id  ) {
				$found = true;
				break;
			}
		}
		return $found;
	}	
}

add_action( 'woocommerce_email_header', 'email_header_before', 1, 2 );
function email_header_before( $email_heading, $email ){
    $GLOBALS['email'] = $email;
}

// Change the retention period for action scheduler
add_filter('action_scheduler_retention_period', function() { 
	return DAY_IN_SECONDS * 1;
});


if(!function_exists('afd_woocommerce_login_form_start')) {
	function afd_woocommerce_login_form_start() {
		if( isset( $_GET['redirect_to'] ) && !empty( $_GET['redirect_to'] ) ) {
		    $name = $_GET['redirect_to'];
		    echo '<input type="hidden" name="redirect" value="'.$name.'"';
		}
	}
}
add_action('woocommerce_login_form_start','afd_woocommerce_login_form_start');
add_action('woocommerce_register_form_start','afd_woocommerce_login_form_start');


/* Mål salg fra Google Ads + Kundeanmeldelse */
add_action('woocommerce_thankyou', 'mementor_conversion_tracking');

function mementor_conversion_tracking($order_id) {
    $order = wc_get_order($order_id);
    ?>
    <script>
        /* <![CDATA[ */
        var google_conversion_id = 478314118;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "amlECM3WkOkBEIb9ieQB";
        var google_conversion_value = <? echo $order->get_total(); ?>;
        var google_conversion_currency = "NOK";
        var google_remarketing_only = false;
        /* ]]> */
    </script>
    <script src="//www.googleadservices.com/pagead/conversion.js"></script>

    <script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>
    <script>
        window.renderOptIn = function () {
            window.gapi.load('surveyoptin', function () {
                window.gapi.surveyoptin.render(
                        {
                            // REQUIRED FIELDS
                            "merchant_id": 285376206,
                            "order_id": "<? echo $order->get_order_number(); ?>",
                            "email": "<? echo $order->get_billing_email(); ?>",
                            "delivery_country": "NO",
                            "estimated_delivery_date": "<? $date = strtotime("+9 day", time()); echo date('Y-m-d', $date); ?>"
                        });
            });
        }
    </script>
    <script>
        window.___gcfg = {
            lang: 'NO'
        };
    </script>
    <?
}

/* Add custom tracking code to the thank-you page */
add_action( 'woocommerce_thankyou', 'mm_tradedoubler' );
function mm_tradedoubler( $order_id ) {

	$order = wc_get_order( $order_id );
	
	?>
	<script>
		tdconv('init', '2270743', {'element': 'iframe' });
		tdconv('track', 'sale', {'transactionId':'<? echo $order_id; ?>', 'ordervalue':'<? echo $order->get_total(); ?>', 'currency':'NOK', 'event':405332});
	</script>
	<img src="https://instore.prisjakt.no/register.php?ftgid=38672&ref=<? echo '' . htmlspecialchars($_COOKIE["pjref"]) . ''; ?>&summa=<? echo $order->get_total(); ?>"/>
	<?
}

/* This function is used for custom query*/
if(!function_exists('afd_handle_custom_query_var')) {
 function afd_handle_custom_query_var( $query, $query_vars ) {
 	if ( ! empty( $query_vars['bundled_product'] ) ) {
		$query['meta_query'][] = array(
			'key' => 'bundled_product',
			'compare' => 'NOT EXISTS' 
		);
	}
	return $query;	
 }
}
add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'afd_handle_custom_query_var', 10, 2 );

add_filter( 'manage_edit-shop_order_columns', 'wc_new_order_column', 10, 1 );
/* This function is used for custom query*/
if(!function_exists('wc_new_order_column')) {
 function wc_new_order_column( $columns ) {
 	if ( $columns ) {
		$columns['_sort_order'] = __( 'Sort Order', '24apotek' );
	}
	return $columns;	
  }
}
// Make custom column sortable
add_filter( "manage_edit-shop_order_sortable_columns", 'shop_order_column_meta_field_sortable' );
function shop_order_column_meta_field_sortable( $columns ) {
    $meta_key = '_sort_order';
    return wp_parse_args( array('_sort_order' => $meta_key), $columns );
}
// Make metakey searchable in the shop orders list
add_filter( 'woocommerce_shop_order_search_fields', 'shipping_postcode_searchable_field' );
function shipping_postcode_searchable_field( $meta_keys ){
    $meta_keys[] = '_sort_order';
    return $meta_keys;
}
if(!function_exists('get_shiping_sort_order')) {
	function get_shiping_sort_order( $order_id ) {
		$order = wc_get_order( $order_id );
		foreach( $order->get_items( 'shipping' ) as $item_id => $item ) {
    		$method = $item->get_data();
    		if( !empty( $method['instance_id'] ) && !empty( $method['method_id'] ) ) {
    			$instance_id = $method['instance_id'];
            	$plugin_id = 'woocommerce_';
            	$method_id = $method['method_id'];
            	
            	$option = $plugin_id . $method_id . '_' .$instance_id . '_settings';
            	$shiping_option = get_option( $option, false );
    		}
    	}
    	return !empty( $shiping_option['sort_order'] ) ? $shiping_option['sort_order'] : 0 ;
	}
}
//sort_order
function apotek24_wc_cogs_add_order_profit_column_content( $column ) {
    global $post;
    if ( '_sort_order' === $column ) {
    	$priority = get_shiping_sort_order( $post->ID ) ;
    	// update_post_meta( $post->ID,'_sort_order',$priority);
    	echo get_post_meta( $post->ID,'_sort_order',true );
    }
}
add_action( 'manage_shop_order_posts_custom_column', 'apotek24_wc_cogs_add_order_profit_column_content' );

function apotek_sort( $a,$b ) {
	$first = get_shiping_sort_order( $a->ID );
	$second = get_shiping_sort_order( $b->ID );
	$datetime_a = $a->post_date;
	$datetime_b = $b->post_date;
	return ($first==$second && $datetime_a > $datetime_b ) ? -1:1;
	return ( $first > $second )?-1:1;
}
function process_admin_shop_order_language_filter( $posts, $query ) {
    global $pagenow;
    if ( $query->is_admin && $pagenow == 'edit.php' && isset( $_GET['post_status'] ) 
        && $_GET['post_status'] != '' && $_GET['post_type'] == 'shop_order' ) {
        	usort( $posts,"apotek_sort" );
    		
    }
    return $posts;
}
//add_action( 'posts_results', 'process_admin_shop_order_language_filter',10,2 );
add_action('pre_get_posts', 'apotek24_zipcode_orderby');
function apotek24_zipcode_orderby($query) { 
	global $pagenow;
    if ( $query->is_admin && $pagenow == 'edit.php' && isset( $_GET['post_status'] ) 
        && $_GET['post_status'] != '' && $_GET['post_type'] == 'shop_order' ) {
        $orderby  = $query->get( 'orderby');
        if ('_sort_order' === $orderby) { 
	        $query->set('meta_key', '_sort_order');
	        $query->set('orderby', 'meta_value_num');
        }
    }
}


add_action('admin_menu', 'apotek24_submenu_page');
if( !function_exists('apotek24_submenu_page') ) {
	function apotek24_submenu_page() {
	    add_submenu_page(
	        'tools.php',
	        __( 'MailChimp Syncing', '24apotek' ),
	        __( 'MailChimp Syncing', '24apotek' ),
	        'manage_options',
	        'mementor_syncing',
	        'apotek24_submenu_page_callback'
	        );
	}	
}
 

if(!function_exists('apotek24_submenu_page_callback') ) {
 	function apotek24_submenu_page_callback() {
	   ?>
	   	<h1><? _e( 'Mail Chimp Syncing Button', 'apotek24'); ?></h1>
	   <form method="post">
	   	<input type="hidden" name="action_type" val="create_schedular"/>
	   	<button type="submit" name="sync_mailchimp" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_attr_e( 'Register', 'woocommerce' ); ?></button>
	   </form>
	   <?
	   
	}
}

add_action('init','start_syncing_of_mailchimp_data');
if(!function_exists('start_syncing_of_mailchimp_data')) {
	function start_syncing_of_mailchimp_data() {
		if( isset( $_POST['sync_mailchimp'] ) ) {
			as_schedule_single_action( $timestamp = time(), $hook='apotek24_mailchimp_start_scheduling', $args=array() );
			wp_redirect(admin_url('tools.php?page=action-scheduler&status=pending'));
			exit;
		}
	}
}

add_action( 'apotek24_mailchimp_start_scheduling', 'apotek24_mailchimp_start_callback' );
if(!function_exists('apotek24_mailchimp_start_callback')) {
	function apotek24_mailchimp_start_callback() {
		global $wp_roles;
		$users = get_users( 
				array(
    			'meta_key' => 'mailchimp_sync',
    			'meta_value' => true
				)
			);
		$my_api = get_field( 'mailchimp_api_id', 'option' );
		$list_id = get_field( 'mailchimp_list_id', 'option' );
		/*Body parameters should be an object,*/ 
		/*if you pass it as an array, you will get the error "Schema describes object"*/ 
		$request_body_parameters = new stdClass();
		 
		/*all the batch operations will be stored in this array*/ 
		$request_body_parameters->operations = array();
		if( empty( $users ) ) {
			return;
		}
		foreach( $users as $user ) {
			$o = new stdClass();
			$o->method = 'PUT';
			$o->path = 'lists/' . $list_id . '/members/' . md5( strtolower( $user->data->user_email ) );
			$o->body = json_encode( array(
				'email_address' => $user->data->user_email,
				'status'        => 'subscribed',
				"merge_fields"  => array(
					'ROLE' => $wp_roles->roles[ $user->roles['0'] ]['name'],
					)
			) );
			/* add it to the array of all batch operations */ 
			$request_body_parameters->operations[] = $o;
		}
		// at this moment we have the array of batch operations $request_body_parameters->operations
		// you can print_r( $request_body_parameters->operations ) it
		// now we continue with creating a batch operations request
		$response = wp_remote_post( 'https://'.substr($my_api,strpos($my_api,'-')+1).'.api.mailchimp.com/3.0/batches', array(
			'method' => 'POST',
		 	'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:'. $my_api )
			),
			'body' => json_encode( $request_body_parameters )
		) );
		if( wp_remote_retrieve_response_message( $response ) == 'OK' ) {
			$response_body_parameters = json_decode( wp_remote_retrieve_body( $response ) );
		}
		
	}
}

/*Parse all content from csv file and generate array from line.*/ 
function csv_content_parser( $content ) {
  foreach (explode("\n", $content) as $line) {
    yield str_getcsv($line);
  }
}
// add_action('wp','import_data_into_wordpress');
if(!function_exists('import_data_into_wordpress')) {
	function import_data_into_wordpress() {
		$content = file_get_contents( get_template_directory() . '/inc/csv/subscribed_members_export.csv' );
		$data = array();
		foreach ( csv_content_parser( $content ) as $fields ) {
		  array_push( $data, $fields );
		}
		array_pop( $data ); // remove the last element.
		array_shift( $data ); // remove the first element.
		if( !empty( $data ) ) {
			foreach( $data as $key => $val ) {
				$email = !empty( $val['0'] ) ? $val['0'] : ''; 
				if( !empty( $email ) ) {
					$user_id = email_exists( $email );
					if( $user_id ) {
						update_user_meta( $user_id, 'mailchimp_sync', true );
					}	
				}
			}
		}
	}
}

add_action( 'edit_user_profile', 'apotek24_custom_user_profile_fields' );
if(!function_exists('apotek24_custom_user_profile_fields')) {
	function apotek24_custom_user_profile_fields( $user ) {
		$mailchip_sync = get_user_meta( $user->ID, 'mailchimp_sync', true );
	    echo '<h3 class="heading">'.__( 'Mailchimp Syncing', '24apotek' ).'</h3>';
	    ?>
	    <table class="form-table">
		<tr>
	        <th>
	        	<label for="contact"><? _e( 'Mailchimp Syncing', '24apotek' );?></label>
	        </th>
		    <td>
		    	<input type="checkbox" id="mailchimp_sync" name="mailchimp_sync" 
		    	<?  if( !empty($mailchip_sync) )  echo 'checked="checked"'; ?> >
			</td>
		</tr>
	    </table>
	    <?php
	}	
}

add_action( 'edit_user_profile_update', 'apotek24_save_custom_user_profile_fields' );
/* @param User Id $user_id */
if( !function_exists('apotek24_save_custom_user_profile_fields') ) {
	function apotek24_save_custom_user_profile_fields( $user_id ) {
	    $custom_data =  !empty( $_POST['mailchimp_sync'] ) ? true : false;
	    update_user_meta( $user_id, 'mailchimp_sync', $custom_data );
	}
}

add_action('wp_ajax_apotek24_bundled_product','apotek24_bundled_product');
add_action('wp_ajax_nopriv_apotek24_bundled_product','apotek24_bundled_product');
if(!function_exists('apotek24_bundled_product')) {
	function apotek24_bundled_product() {
		$args = array(
		    'post_type' => 'product',
		    'posts_per_page' => 30,
		    'post_status' => 'publish',
		    'paged' => $_POST['page']+1,
		    'meta_query' => array(
		        array(
		            'key' => 'bundled_product',
		            'value'   => '"yes"',
		            'compare' => 'LIKE'
		        )
		    )
		);
		$the_query =new WP_Query( $args );
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) { 
				$the_query->the_post();
				wc_get_template_part( 'content', 'product' );
			}
		}
		die;
	}
}

 









