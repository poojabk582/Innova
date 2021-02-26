<?
/**
* The page default contact Us
* @package Apotek 24
* @author Apotek 24
* Template Name: Customer Service
*/
global $post;
get_header();
$tab = get_field('tabs');
?>
<div class="customer-service section-pd-top-50 section-pd-bottom-100">
	<div class="container">
		<header class="entry-header">
			<h1 class="entry-title"><? the_title(); ?></h1>
		</header>
		<div class="customer-service__banner-image">
			<img src="<? echo the_post_thumbnail_url(); ?>">
		</div>
		<div class="customer-service__wrapper section-pd-top-50">
			<div class="row customer-service__row">
				<div class="col-sm-12 col-lg-3 customer-service__col">
					<? do_action( 'apotek24_list_subchildren_pages', get_the_ID() ); ?>
				</div>
				<div class="col-sm-12 col-lg-9 customer-service__col">	
					<div class="customer-service__col-wrapper">
						<div id="tab-<? echo $no; ?>" class="customer-service__content active ">
								<? echo apply_filters( 'the_content', $post->post_content ); ?>
						</div>
					</div>
					<div class="need-help-section need-help__mob">
						<h4><?_e('Still Need Help?','24apotek');?></h4>
						<p><? _e('Have something to say? We\'d love to hear from you.','24apotek'); ?></p>
						<div class="need-help__btn-section-wrap">
							<div class="customer-service__contact-btn">
								<a class="btn-black" href="<? echo apotek_get_page_link ('kontakt-oss' );?>"><? _e('CONTACT US','24apotek'); ?></a>
							</div>
							<div class="customer-service__live-chat-btn">
								<a class="btn-live"><? _e('LIVE CHAT','24apotek'); ?></a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?
get_footer();