<?
/*  The header for our theme */
 global $current_user; wp_get_current_user();
 global $woocommerce;
 
 if( is_user_logged_in() ) {
 	if( isset( $current_user->user_firstname ) && !empty( $current_user->user_firstname )  ) {
		$user_name = $current_user->user_firstname;
	} else {
		$user_name = $current_user->user_login;
	}
 }
 $contact = get_field('footer_contact','option');
?>
<!doctype html>
<html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Start of LiveChat (www.livechatinc.com) code -->
	<script>
	    window.__lc = window.__lc || {};
	    window.__lc.license = 12156831;
	    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
	</script>
	<noscript><a href="https://www.livechatinc.com/chat-with/12156831/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
	<!-- End of LiveChat code -->
	<!-- Hotjar Tracking Code for www.apotekfordeg.no -->
	<script>
	   (function(h,o,t,j,a,r){
	       h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	       h._hjSettings={hjid:2129077,hjsv:6};
	       a=o.getElementsByTagName(‘head’)[0];
	       r=o.createElement(‘script’);r.async=1;
	       r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	       a.appendChild(r);
	   }) (window,document, 'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	<!-- End of Hotjar Tracking Code for www.apotekfordeg.no -->
	<? wp_head(); ?>
</head>

<body <? body_class(); ?>>
<? wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><? _e( 'Skip to content', '24apotek' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="top-header-section">
			<div class="container">
				<div class="top-header">
					<div class="top-header__left-slogan"><? the_field('slogan__text_on_header','option'); ?></div>
					<div class="top-header-right-col">
						<? if ( !is_user_logged_in() ) {?>
						<a class="top-header__member" href="<?php echo get_field('become_a_member','option'); ?>">
							<? _e('Become a member','24apotek'); ?>
						</a>
						<? } ?>
						<a class="top-header__profile" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
							<span class="top-header__profile-icon">
								<img class="svg" src="<? echo get_template_directory_uri() . '/images/user_icon.svg'; ?>" alt="user_icon.svg">
							</span> 
							<?
							echo 
							( is_user_logged_in() ) ? __('Hey, ','24apotek').$user_name :
							__('Login','24apotek');?>
						</a>
						<a class="top-header__wishlist" href="<? echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'wishlist/'; ?>">
							<span class="top-header__wishlist-icon"><img class="svg" src="<? echo get_template_directory_uri() . '/images/wishlist_icon.svg'; ?>" alt="wishlist_icon.svg"></span> <span class="wishlist__counter"><? echo yith_wcwl_count_products();?></span>
							<?_e('Wishlist','24apotek');?>
						</a>
						<? echo apotek24_woocommerce_header_cart(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-nav-wrapper">
			<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg navbar-light" role="navigation">
				<div class="container nav-wrapper">
					<div class="row header-navigation-row">
						<div class="main-nav-toggle-wrap">
							<button id="main-nav-toggle" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#apotek_navbar" aria-controls="apotek_navbar" aria-expanded="false" aria-label="Toggle navigation">
					        	<span class="top"></span> 
					        	<span class="middle"></span> 
					        	<span class="bottom"></span>
					    	</button>
				    	</div>
				    	<div class="site-branding col-lg-3">
							<?
							the_custom_logo();
							if ( is_front_page() && is_home() ) {
								?>
								<h1 class="site-title"><a href="<? echo esc_url( home_url( '/' ) ); ?>" rel="home"><? bloginfo( 'name' ); ?></a></h1>
								<?
							} else {
								?>
								<p class="site-title"><a href="<? echo esc_url( home_url( '/' ) ); ?>" rel="home"><? bloginfo( 'name' ); ?></a></p>
								<?
							}
							$apotek24_description = get_bloginfo( 'description', 'display' );
							if ( $apotek24_description || is_customize_preview() ) {
								?>
								<p class="site-description"><? echo $apotek24_description;  ?></p>
							<? } ?>
						</div>
						<div id="nav-cart-mobile" class="nav-cart-mobile">
							<? echo apotek24_woocommerce_header_cart();?>
						</div>
						<div class="collapse navbar-collapse apotek_navigation_wrapper col-lg-7" id="apotek_navbar">
							<span class="navbar-mob-border"></span>
							<div class="search-section-wrapper search-section-mobile">
								<div class="header-search">
							    	<form action="/" method="get" class="search-form-mob search-form-mob">
									  	<div class="search-bar-mob-wrapper">
										    <span class="header-search__icon">
										    	<img class="svg" src="<? echo get_template_directory_uri() . '/images/search_icon_dark_2@x.svg'; ?>" alt="search_icon.svg">
										    </span>
									      	<input class="search-bar search" type="text" name="s" placeholder="<? _e('Search','24apotek'); ?>" value="<?php the_search_query();?>"/>
									    </div>
									</form>
							    </div>
							</div>
							<div class="category-menu">
								<a href="<? echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="category-menu-title">
									<span></span>
									<? _e('Products','24apotek'); ?>  <i class="fas fa-caret-right"></i> </a>
								<? do_action('apotek24_header_cat_listing');?>
							</div>
							<div class="navbar-wrap-mob">
								<?
									wp_nav_menu( array(
										'theme_location'=>'menu-1',
										'depth' => 3,
										'container' => 'navbar navbar-default navbar-fixed-top',
										'menu_class' => 'nav navbar-nav nav-menu header-nav__list',
										'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
										'container' =>'ul',
										'menu_id'=>'navigation',
										'menu'  => 'primary',
										'walker' => new WP_Bootstrap_Navwalker
										)
									);
								?>
							</div>
							<div class="header-account-btn">
								<a class="btn-blue-filled" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
									<img src="<? echo get_template_directory_uri() . '/images/account_icon_2@x.png'; ?>" alt="user"> 
									<? _e('Account','24apotek'); ?>
								</a>
							</div>
							<div class="header-nav-detail">
								<div class="header-email-wrapper">
									<h4><?_e('E-mail','24apotek');?></h4>
									<a href="mailto:<? echo apotek24_check_empty( $contact['email'] ); ?>" target="_blank"><? echo apotek24_check_empty( $contact['email'] ); ?></a>
								</div>
								<div class="header-phone-wrapper">
									<h4><?_e('Telephone','24apotek');?></h4>
									<a href="tel:<? echo apotek24_check_empty( $contact['telephone'] ); ?>" target="_blank"><? echo apotek24_check_empty( $contact['telephone'] ); ?> <span><? echo apotek24_check_empty( $contact['extra_information_with_telephone'] ); ?></span></a>
								</div>
							</div>
							<div class="header-section__social-wrapper">
								<div class="header-section__social">
									<? while( have_rows('social_media_link','option') ){ 
										the_row(); 
									?>
										<a class="header-section__facebook header-section__social-icon" href="<? the_sub_field('url','option') ?>" target="_blank">
											<img  data-hover="<? the_sub_field('hover_image') ?>" src="<? the_sub_field('icon') ?>" data-src="<? the_sub_field('icon') ?>">
										</a>
									<? } ?>
								</div>
							</div>
						</div>
						<div class="nav-search nav-search-desktop">
							<div class="top-nav-col top-nav-col-three">
								<a id="searchbar-icon" class="search-wrapper">
									<span><img class="svg" src="<? echo get_template_directory_uri() . '/images/search_icon_dark_2@x.svg'; ?>" alt="search"></span>
									<? _e('Search','24apotek');?>
								</a>
							</div>
						</div>
						
					</div>
				</div>
			</nav>
			<div id="home-page-search" class="search-section-wrapper search-section-mobile home-page-search">
				<div class="header-search">
			    	<form action="/" method="get" class="search-form-mob search-form-mob">
					  	<div class="search-bar-mob-wrapper">
						    <span class="header-search__icon">
						    	<img class="svg" src="<? echo get_template_directory_uri() . '/images/search_icon_dark_2@x.svg'; ?>" alt="search_icon.svg">
						    </span>
					      	<input class="search-bar search" type="text" name="s" placeholder="<? _e('Search','24apotek'); ?>" value="<?php the_search_query();?>"/>
					    </div>
					</form>
			    </div>
			</div>
		</div>
		<div id="searchbar-input" class="searchbar-section">
			<? get_search_form(); ?>
		</div>
	</header>
	<!-- Home-Page-Sticky-Nav -->
	<div class="sticky-home__nav">
		<div class="container">
			<nav class="bottom-nav">
		      <div class="bottom-nav-item">
	        	<a id="bottom-toogle-icon" class="bottom-nav-link" href="#main-nav-toggle">
			        <span class="bottom-nav-icon"><img srcset="<? echo get_template_directory_uri() . '/images/burger_icon_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/burger_sticky.png'; ?>" alt="burger_icon-white"></span>
			     </a>
		      </div>
		      <div class="bottom-nav-item">
		        <a id="bottom-search-bar" class="bottom-nav-link" href="#home-page-search">
		          <span class="bottom-nav-icon"><img srcset="<? echo get_template_directory_uri() . '/images/search_icon_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/search_icon_sticky.png'; ?>" alt="search_icon"></span>
		        </a>
		      </div>
		      <div class="bottom-nav-item">
		        <a class="bottom-nav-link" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
		          <span class="bottom-nav-icon"><img srcset="<? echo get_template_directory_uri() . '/images/account_icon_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/account_icon_sticky.png'; ?>" alt="account_icon_sticky"></span>
		        </a>
		      </div>
		      <div class="bottom-nav-item">
		        <a class="bottom-nav-link" href="<? echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'wishlist/'; ?>">
		          <span class="bottom-nav-icon"><img srcset="<? echo get_template_directory_uri() . '/images/wishlist_icon_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/wishlist_icon_sticky.png'; ?>" alt="wishlist_icon-white"><span class="counter wishlist-sticky-counter"><? echo yith_wcwl_count_products();?></span></span>
		        </a>
		      </div>
		      <div class="bottom-nav-item">
		        <a id="bottom-nav-link" class="bottom-nav-link" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>">
		          <span class="bottom-nav-icon"><img srcset="<? echo get_template_directory_uri() . '/images/cart_icon_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/cart_icon_sticky.png'; ?>" alt="cart_icon-white.png"><span class="counter"><? echo WC()->cart->get_cart_contents_count();?></span></span>
		        </a>
		      </div>
		    </nav>
		</div>
	</div>