<?
/**
* The page default contact us
* @package 24apotek
* @author 24apotek
* Template Name: Contact Us
*/
global $post;
get_header();
?>
<div class="contact-us">
    <div class="contact-us__wrapper">
        <div class="container">
            <div class="contact-us__heading section-pd-top-50 text-center">
               <h1 ><? _e('Contact Us','24apotek'); ?></h1>
            </div>
            <div class="contact-us__banner-img-wrapper">
             	<div class="contact-us__banner-image">
             		<img src="<? echo get_the_post_thumbnail_url(); ?>">
             	</div>
            </div>
            <div class="contact-us__form-wrapper section-pd-top-50 section-pd-bottom-100">
	            <div class="row contact-us__form-row">
	                    <div class="col-sm-12 col-lg-6 contact-us__form-col">
	                        <div class="contact-us__form-wrap">
	                            <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 2, 'title' => false, 'description' => true ) ); ?>
	                        </div>
	                    </div>
	                    <div class="col-sm-12 col-lg-6 contact-us__general-contacts-col">
	                    	<h5><? _e('CONTACT US','24apotek'); ?></h5>
	                        <div class="contact-us__general-contacts">
	                            <h2><? the_field('heading_for_contact_information') ?></h2>
	                            <div class="contact-us__email-wrapper">
	                                <div class="contact-us__email">
	                                	<h4><? _e('E-mail','24apotek'); ?></h4>
	                                	<?
	                                	 $email = get_field('email');
	                                	 if( !empty( $email  ) ) {
	                                	 	foreach( $email  as $key => $value  ) {
	                                		?>
	                                		<a href="mailto: <? echo $value['email'] ?>" target="_blank"><? echo $value['email'] ?></a>
	                                		<? } ?>
	                                	<? } ?>
	                                </div>
	                                <div class="contact-us__tel">
	                                	<h4><? _e('Telephone','24apotek'); ?></h4>
	                                	<? 
	                                	 $phone = get_field('phone');
	                                	 if( !empty( $phone  ) ) {
	                                	 	foreach( $phone  as $key => $value  ) {
	                                	?>
	                                	<a href="tel: <? echo $value['phone']; ?>" target="_blank"><? echo $value['phone']; ?></a>
	                                	<? } ?>
	                                		<? } ?>
	                                </div>
	                                <div class="contact-us__address">
	                                	<h4><? _e('Address','24apotek'); ?></h4>
	                                	<a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<? echo urlencode( get_field('address') );  ?>"><? the_field( 'address' );?></a>
	                                </div>	
	                            </div>
	                        </div>
	                    </div>
	            </div>
	        </div>
            <div class="contact-membership section-pd-bottom-100">
				<? include_once get_template_directory().'/template-parts/home-page/membership.php' ; ?>
			</div>
	        
        </div>

        
    </div>
</div>
<?php
get_footer();