<?
/* The template for displaying the footer */
$contact = get_field('footer_contact','option');
?>	
	<!-- Newsletter-popup -->
	<div class="newsletter-modal">
		<!-- Modal -->
		<div class="modal fade" id="newsletter-modal" tabindex="-1" role="dialog" aria-labelledby="newsletter-modal-title" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		     <!--  <div class="modal-header">
		        
		      </div> -->
		      <?
		      $newsletter_form = get_field('newsletter_popup','option');
		      ?>
		      <div class="modal-body newsletter__main-wrapper">
		      	<div class="newsletter__row row ">
		      		<div class="col-sm-12 col-lg-5 newsletter__col-image">
		      			<div class="newsletter__image" style="background-image: url('<? echo !empty( $newsletter_form['image'] ) ? $newsletter_form['image'] : '' ?>');">
			      		</div>
		      		</div>
		      		<div class="col-sm-12 col-lg-7 newsletter__col-form">
		      			<div class="newsletter-popup-form">
		      				<div class="newsletter-popup__header">
		      					<? echo !empty( $newsletter_form['heading'] ) ? $newsletter_form['heading'] : '' ?>
			      				
			      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          	<span aria-hidden="true"></span>
						        </button>
						    </div>
		      				<!-- Begin Mailchimp Signup Form -->
							<div id="mc_embed_signup">
	
							<form action="https://innovacare.us8.list-manage.com/subscribe/post?u=af50fe4963e421c4228665a40&amp;id=6f6eccbbda" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							    <div id="mc_embed_signup_scroll">
							<div class="mc-field-group form-group form-email">
								<label for="mce-FNAME"><? _e('First Name','24apotek'); ?> <span class="asterisk">*</span></label>
								<input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
							</div>	
							<div class="mc-field-group form-group form-name">
								<label for="mce-EMAIL"><? _e('Email Address','24apotek') ?>  <span class="asterisk">*</span></label>
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							</div>
							<div id="mergeRow-gdpr" class="mergeRow gdpr-mergeRow content__gdprBlock mc-field-group">
							    <div class="content__gdpr">
							        <fieldset class="mc_fieldset gdprRequired mc-field-group" name="interestgroup_field">
									<label class="checkbox subfield" for="gdpr_30326"><input type="checkbox" id="gdpr_30326" name="gdpr[30326]" value="Y" class="av-checkbox gdpr"><span><? _e('I accept that ApotekForDeg.no can send me emails with news and special offers','24apotek'); ?>*</span></label>
							        </fieldset>
							    </div>
							</div>
							<div class="checkbox">
							       <label for="privacy"><input class="required" type="checkbox" name="" id="privacy">
							       		<span> <?_e('I have read and agree to Apotek For Alle ','24apotek'); ?> <a id="newsletter-privacy" data-target="#privacy-policy-modal"><? _e('Privacy Policy','24apotek'); ?></a>.*</span>
							       	</label>
						      </div>
								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_af50fe4963e421c4228665a40_2f732f98a6" tabindex="-1" value=""></div>
							    <div class="clear"><input type="submit" value="Abonner" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							    </div>
							</form>
							</div>
							<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($)
							 {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
		      			</div>
		      		</div>
		      	</div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<!-- Privacy-Policy-Popup -->
	<div class="privacy-policy-modal">
		<!-- Modal -->
		<div class="modal fade" id="privacy-policy-modal" tabindex="-1" role="dialog" aria-labelledby="privacy-policy-modal-title" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		     <div class="modal-header">
		        <div class="privacy-policy__header">
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true"></span>
			        </button>
      				<h2><? _e('Privacy Policy','24apotek');?></h2>
			    </div>
		      </div> 
		      <div class="modal-body privacy-policy__main-wrapper">
		      		<div class="privacy-policy_section">
					    <div class="privacy-policy__content">
					    	<? 
					    	$policy_page_id = (int) get_option( 'wp_page_for_privacy_policy' );
					    	if( !empty( $policy_page_id ) ) {
					    		echo apply_filters( 'the_content', get_the_content( '','', $policy_page_id ) );	
					    	}
					    	 ?>
					    </div>
		      		</div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<!-- Terms-And-Policy -->
	<div class="terms-modal">
		<!-- Modal -->
		<div class="modal fade" id="terms-modal" tabindex="-1" role="dialog" aria-labelledby="terms-modal-title" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		     <div class="modal-header">
		        <div class="terms__header">
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true"></span>
			        </button>
      				<h2><? _e('Terms & Conditions','24apotek');?></h2>
			    </div>
		      </div> 
		      <div class="modal-body terms__main-wrapper">
		      		<div class="terms_section">
					    <div class="terms__content">
					    	<? 
					    		echo apply_filters( 'the_content', get_the_content( '','', 46 ) );	
					    	?>
					    </div>
		      		</div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<!--Footer-Section-->
	<div class="footer-section section-pd-top-100 section-pd-bottom-100 footer-section__desktop">
		<div class="container">
			<div class="footer-section__top">
				<div class="footer-section__logo">
					<div class="footer-logo">
						<?
							the_custom_logo();
						?>
					</div>
				</div>
				<div class="footer-section__social-wrapper">
					<? if( have_rows('social_media_link','option') ) { ?>
						<div class="footer-section__social">
							<? while( have_rows('social_media_link','option') ){ 
								the_row(); 
								?>
								<div class="footer-section__facebook footer-section__social-icon">
									<a href="<? the_sub_field('url','option') ?>" target="_blank">
										<img  data-hover="<? the_sub_field('hover_image') ?>" src="<? the_sub_field('icon') ?>" data-src="<? the_sub_field('icon') ?>">
									</a>
								</div>
							<? } ?>
						</div>
					<? } ?>
					
				</div>
			</div>
			<div class="row footer-section__row">
				<div class="col-sm-12 col-lg-4 footer-section__col-one">
					<div class="email-section-wrapper">
						<div class="email-section">
							<h4><? _e('E-mail','24apotek'); ?></h4> 
							<a href="mailto:<? echo apotek24_check_empty( $contact['email'] ); ?>" target="_blank"><? echo apotek24_check_empty( $contact['email'] ); ?></a>
						</div>
						<div class="phone-section">
							<h4><? _e('Telephone','24apotek'); ?></h4> 
							<a href="tel:<? echo apotek24_check_empty( $contact['telephone'] ); ?>" target="_blank"><? echo apotek24_check_empty( $contact['telephone'] ); ?> <span><? echo apotek24_check_empty( $contact['extra_information_with_telephone'] ); ?></span></a>
						</div>
						<div class="address-section">
							<h4><? _e('Address','24apotek'); ?></h4> 
							<a href="https://www.google.com/maps/search/?api=1&query=<? echo urlencode( apotek24_check_empty( $contact['address'] ) );  ?>" target="_blank"><? echo apotek24_check_empty( $contact['address'] ); ?></a>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-lg-4 footer-section__col-two">
					<div class="footer-menu">
						<h4><? _e('Navigation','24apotek'); ?></h4>
						<nav id="footer-navigation" class="navbar">
							<?
								wp_nav_menu( array(
									'theme_location'    => 'footer-menu',
									'depth'             => 2,
									'container'         => 'div',
									'container_id'      => 'bs-example-navbar-collapse-2',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
								) );
							?>
						</nav>
					</div>
					<div class="footer-section__banner-wrapper footer-section__banner-desc">
						<div class="footer-setion__banner-one">
							<a target="_blank" href="<? the_field('first_banner_link','option')?>">
								<img srcset="<? echo get_template_directory_uri() . '/images/img_banner_1_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/Logo-uten-ramme-150.png'; ?>" alt="Logo-uten-ramme-150.png">
							</a>
						</div>
						<div class="footer-setion__banner-two">
							<a target="_blank" href="<? the_field('second_banner_link','option')?>">
								<img srcset="<? echo get_template_directory_uri() . '/images/img_banner_2_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/Apotekfor_logo_medlem av.png'; ?>" alt="Apotekfor_logo_medlem av.png">
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-lg-4 footer-section__col-three">
					<div class="footer-form">
						<div class="footer-section__form-wrapper">
							<div class="form-title">
								<? the_field('footer_form_title','option'); ?>
							</div>
						    <input type="email" class="footer-email" id="footer-email" placeholder="<? _e('Enter your email','24apotek'); ?>" name="email">
						    <a id="newsletter_pre_button" data-toggle="modal" data-target="#newsletter-modal"><? _e('Subscribe our Newsletter','24apotek')?><img srcset="<? echo get_template_directory_uri() . '/images/arrow_newsletter_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/arrow_right.png'; ?>" alt="arrow_right.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="back-to-top" class="back-to-top-wrapper">
		  	<a id="top-btn" class="top-btn"><span></span></a>
		</div>
	</div>
	<div class="footer-section section-pd-top-100 section-pd-bottom-100 footer-section__mobile">
		<div class="container">
			<div class="footer-section__top">
				<div class="footer-section__logo">
					<div class="footer-logo">
						<?
							the_custom_logo();
						?>
					</div>
				</div>
			</div>
			<div class="footer-section__row">
				<div class="footer-section__col-one">
					<div class="email-section-wrapper">
						<div class="email-section">
							<h4><? _e('E-mail','24apotek'); ?></h4> 
							<a href="mailto:<? echo apotek24_check_empty( $contact['email'] ); ?>" target="_blank"><? echo apotek24_check_empty( $contact['email'] ); ?></a>
						</div>
						<div class="phone-section">
							<h4><? _e('Telephone','24apotek'); ?></h4> 
							<a href="tel:<? echo apotek24_check_empty( $contact['telephone'] ); ?>" target="_blank"><? echo apotek24_check_empty( $contact['telephone'] ); ?> <span><? echo apotek24_check_empty( $contact['extra_information_with_telephone'] ); ?></span></a>
						</div>
						<div class="address-section">
							<h4><? _e('Address','24apotek'); ?></h4> 
							<a href="https://goo.gl/maps/kiskwBZydJWTXrRy8" target="_blank"><? echo apotek24_check_empty( $contact['address'] ); ?></a>
						</div>
					</div>
				</div>
				<div class="footer-section__col-two">
					<div class="footer-menu">
						<h4><? _e('Navigation','24apotek'); ?></h4>
						<nav id="footer-navigation" class="navbar">
							<?
								wp_nav_menu( array(
									'theme_location'    => 'footer-menu',
									'depth'             => 2,
									'container'         => 'div',
									'container_id'      => 'bs-example-navbar-collapse-2',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
								) );
							?>
						</nav>
					</div>
				</div>
			</div>
			<div class="footer-section__banner-wrapper footer-section__banner-mob">
				<div class="footer-setion__banner-one">
					<a target="_blank" href="<? the_field('first_banner_link','option')?>">
						<img srcset="<? echo get_template_directory_uri() . '/images/img_banner_1_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/Logo-uten-ramme-150.png'; ?>" alt="Logo-uten-ramme-150.png">
					</a>
				</div>
				<div class="footer-setion__banner-two">
					<a target="_blank" href="<? the_field('second_banner_link','option')?>">
						<img srcset="<? echo get_template_directory_uri() . '/images/img_banner_2_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/Apotekfor_logo_medlem av.png'; ?>" alt="Apotekfor_logo_medlem av.png">
					</a>
				</div>
			</div>
			<div class="footer-section__social-wrapper">
				<? if( have_rows('social_media_link','option') ) { ?>
					<div class="footer-section__social">
						<? while( have_rows('social_media_link','option') ){ 
							the_row(); 
							?>
							<div class="footer-section__facebook footer-section__social-icon">
								<a href="<? the_sub_field('url','option') ?>" target="_blank">
									<img  data-hover="<? the_sub_field('hover_image') ?>" src="<? the_sub_field('icon') ?>" data-src="<? the_sub_field('icon') ?>">
								</a>
							</div>
						<? } ?>
					</div>
				<? } ?>
			</div>
			<div class="footer-section__col-three">
				<div class="footer-form">
					<div class="footer-section__form-wrapper">
						<div class="form-title">
							<? the_field('footer_form_title','option'); ?>
						</div>
					    <input type="email" class="footer-email" id="email" placeholder="<? _e('Enter your email','24apotek'); ?>" name="email">
					    <a id="newsletter_pre_button" data-toggle="modal" data-target="#newsletter-modal"><? _e('Subscribe our Newsletter','24apotek')?><img srcset="<? echo get_template_directory_uri() . '/images/arrow_newsletter_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/arrow_right.png'; ?>" alt="arrow_right.png"></a>
					</div>
				</div>
			</div>
		</div>
		<div id="back-to-top-mob" class="back-to-top-wrapper">
		  	<a id="top-btn-mob" class="top-btn"><span></span></a>
		</div>
	</div>
	<div id="footer-info" class="footer-info section-pd-top-15 section-pd-bottom-15">
		<div class="container">
			<div class="footer-info__wrapper">
				<div class="footer-info__content-wrap">
					<div class="footer-info__content">
						<div class="footer-info__copy-right">
							<p>Stjerneapotek Paleet Shopping (913877004 MVA) @ <? echo date('Y'); ?> - <? _e('All Rights Reserved', '24apotek'); ?></p>
						</div>
						<div class="footer-info__privacy">
							<a id="privacy-policy-link" data-toggle="modal" data-target="#privacy-policy-modal"><? _e('Privacy Policy and Cookies','24apotek');?></a>
						</div>
						<div class="footer-info__prescription">
							<a href="https://helsenorge.no/legemidler/kjop-av-medisiner-pa-internett" target="_blank">Trygg netthandel av reseptvarer</a>
						</div>
					</div>
				</div>
				<div class="footer-info__logo-wrapper">
					<div class="footer-info__vipps-wrap">
						<div class="footer-info__vipps-logo">
							<img srcset="<? echo get_template_directory_uri() . '/images/vipps_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/Vipps_logo.png'; ?>" alt="Vipps_logo">
						</div>
					</div>
					<div class="footer-info__visa-logo">
						<img srcset="<? echo get_template_directory_uri() . '/images/pay_later_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/klarna.png'; ?>" alt="klarna.png">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<? wp_footer(); ?>
<input type="hidden" id="screen_view" value="" />
<script type="text/javascript"> _linkedin_partner_id = "2566930"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script>
</body>
</html>
