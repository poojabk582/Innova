<?
/* The template for displaying 404 pages (not found) */

get_header();
?>
	<main id="primary" class="site-main">

		<section class="error-404 not-found section-pd-70 text-center">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( '404', '24apotek' ); ?></h1>
				<h3 class="page-sub-title"><?php esc_html_e( 'Opps! Can’t find the page you’re looking for.', '24apotek' ); ?></h3>
				<div class="error-404__btn-black">
    				<a class="btn-black text-center" href="<? echo home_url();?>" data-text="<? _e('back to home','24apotek'); ?>">
	    				<span><? _e('back to home','24apotek'); ?></span>
	    			</a>
				</div>
			</header>
		</section><!-- .error-404 -->

	</main><!-- #main -->
<?
get_footer();
