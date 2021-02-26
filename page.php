<?
/* The template for displaying all pages */
get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
		<?
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		} 
		?>
	</div>
	</main>

<?
//get_sidebar();
get_footer();
