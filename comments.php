<?
/* The template for displaying comments  */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?
			$apotek24_comment_count = get_comments_number();
			if ( '1' === $apotek24_comment_count ) {
				printf(
					__( 'One thought on &ldquo;%1$s&rdquo;', '24apotek' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $apotek24_comment_count, 'comments title', '24apotek' ) ),
					number_format_i18n( $apotek24_comment_count ), 
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<? the_comments_navigation(); ?>

		<ol class="comment-list">
			<?
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><? _e( 'Comments are closed.', '24apotek' ); ?></p>
			<?
		endif;

	endif; 

	comment_form();
	?>

</div>
