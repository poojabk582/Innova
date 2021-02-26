<?
/**
* The page default contact Us
* @package Apotek 24
* @author Apotek 24
* Template Name: Work Page
*/
global $post;
get_header();
?>
<div class="hiring-page section-pd-top-50 section-pd-bottom-100">
	<div class="container">
		<header class="entry-header">
			<h1 class="entry-title"><? the_title(); ?></h1>
		</header>
		
		<div class="hiring-page__content-wrapper">
			<? echo apply_filters('the_content',$post->post_content ); ?>
		</div>
		<div class="hiring-page__form-section">
			<div class="hiring-page__form-wrapper">
			
				<div class="hiring-page__form">
					<?php echo FrmFormsController::get_form_shortcode( array( 'id' => 6, 'title' => false, 'description' => true ) ); ?>
				</div>
			</div>
		</div>


	</div>
</div>

<?
get_footer();