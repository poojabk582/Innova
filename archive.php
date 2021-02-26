<?
/* The template for displaying archive pages */

get_header();
$get_field = get_field('tips_and_advice','option');
?>

	<main id="primary" class="site-main">
		<div class="tips-page">
			<div class="container">
				<div class="tips-page__title text-center section-pd-top-50">
					<h1> <? echo $get_field['title']; ?> </h1>
				</div>
				<div class="tips-page__banner-wrapper">
					<div class="tips-page__banner-image">
						<img src="<? echo $get_field['image']; ?>">
					</div>
					<div class="tips-page__latest-news">
						<div class="tips-page__latest-news-row row">
							<div class="tips-page__latest-news-col">
								<? echo apply_filters( 'the_content', $get_field['text'] ); ?>
							</div>
							<?
							$tip_and_advice = get_field('tips_and_advice','option');
							?>
							<div class="tips-page__ask-ques-col">
								<h5> <? echo !empty($tip_and_advice['question_heading']) ? $get_field['question_heading'] : ''; ?> </h5>
								<p> <? echo !empty($tip_and_advice['question_desc']) ? $get_field['question_desc'] : ''; ?> </p>
								<div class="tips-page__ask-btn">
									<div class="tips-page__contact-btn"><a href="<?echo apotek_get_page_link('kontakt oss');?>" class="btn-black"><? _e('CONTACT US','24apotek'); ?></a></div>
									<div class="tips-page__live-btn">
										<a class="btn-live"><? _e('LIVE CHAT','24apotek'); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tips-page__category-heading section-pd-top-50 text-center">
					<h3><? _e('Choose from the categories or search articles','24apotek'); ?></h3>
				</div>
				<div class="tips-page__cat-section section-pd-top-50">
					<? do_action('apotek24_add_cat_listing'); ?>
					<div class="tips-page__search-wrapper">
						<div class="tips-search-bar">
						    <input class="searchbar" type="text" name="s" placeholder="<? _e('Search','24apotek'); ?>" id="tips-search" value="" autocomplete="off">
							<div class="search-bar-icon-image">
								<img srcset="<? echo get_template_directory_uri() . '/images/search_icon-2x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/search_icon.png'; ?>" alt="search_icon.png">
							</div>
						</div>
					</div>
				</div>
				<div class="tips-page__aktuelt">
					<div class="aktuelt__section-wrapper">
						<div class="aktuelt__section row">
							<? if ( have_posts() ) {
								while ( have_posts() ) { the_post();
									get_template_part( 'template-parts/tips-listing', get_post_type() );
								 }
								 //the_posts_navigation(); ?>
							<? } ?>
						</div>
					</div>
				</div>
				<div class="tips-page__related-aktuelt">
					<? do_action('apotek24_after_post'); ?>
				</div>
				<div class="tip-membership section-pd-bottom-50">
					<?
					get_template_part('template-parts/home-page/membership'); ?>
				</div>
				
			</div>
		</div>
	</main>

<?
// get_sidebar();
get_footer();
