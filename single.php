<?
/**
 * The template for displaying all single posts
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<?
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				// the_post_navigation(
				// 	array(
				// 		'prev_text' => '<span class="nav-subtitle">' . __( 'Previous:', '24apotek' ) . '</span> <span class="nav-title">%title</span>',
				// 		'next_text' => '<span class="nav-subtitle">' . __( 'Next:', '24apotek' ) . '</span> <span class="nav-title">%title</span>',
				// 	)
				// );

				
				// if ( comments_open() || get_comments_number() ) {
				// 	comments_template();
				// }

			} 
			?>
		</div>

	</main><!-- #main -->

<?
get_footer();
