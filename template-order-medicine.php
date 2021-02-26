<?
/**
* The page default contact Us
* @package Apotek 24
* @author Apotek 24
* Template Name: Order Medicine
*/
get_header();
$reg = ( get_field('registration_slug','option') ) ? get_field('registration_slug','option') : 'registration';
?>
	<div class="order-medicine section-pd-bottom-100">
		<div class="container">
			<header class="entry-header section-pd-50">
				<h1 class="entry-title"><? the_title(); ?></h1>
			</header>
			<div class="order-medicine__row"> 
				<div class="row">
					<div class="col-sm-12 col-lg-6 order-medicine__col-left">
						<? if ( !is_user_logged_in() ) {?>
						<div class="om-signin-section-wrap">
							<div class="om__signin-section">
								<h4> <? _e('Sign in or register a new account','24apotek') ?> </h4>
								<div class="om__signin-btn-wrap">
									<a href="<? echo rtrim( get_permalink( get_option('woocommerce_myaccount_page_id') ),'/' ).'?redirect_to='.get_permalink(); ?>" class="btn-black"><? _e('SIGN IN','24apotek'); ?></a>
									<a href="<? echo rtrim( get_permalink( get_option('woocommerce_myaccount_page_id') ),'/' ).'?'. $reg.'&redirect_to='.get_permalink(); ?>" class="btn-white"><? _e('REGISTER','24apotek'); ?></a>
								</div>
							</div>
						</div>
						<? } //elseif ( is_user_logged_in() ) {
							global $current_user; wp_get_current_user();
							$address = wc_get_account_formatted_address( 'billing' );
							$user_id = get_current_user_id();
							$customer = new WC_Customer( $user_id );
							// print_r( $customer->get_billing_country() );die;
							$edit_form = false;
								if( !empty( $customer->get_billing_email() ) 
								&& !empty( $customer->get_billing_first_name() ) 
								&& !empty( $customer->get_billing_last_name() )
								&& !empty( $customer->get_billing_phone() )
								&& !empty( $customer->get_billing_postcode() )
								&& !empty( $customer->get_billing_city() )
								&& !empty( $customer->get_billing_address() )
								&& !empty( $customer->get_billing_country() )
								) { 
									$edit_form = true;	
								}
							global $woocommerce;
						 ?>
						<div class="om__personal-info-wrapper">
							<div class="om__personal-info-name">
								<h2> <strong><? _e('Hey','24apotek'); ?>,</strong> <? echo !empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login; ?></h2>
							</div>
							<div class="om__edit-info-link">
								<a id="om-edit-info"><img srcset="<? echo get_template_directory_uri() . '/images/edit_icon_2@x.png'; ?>" src="<? echo get_template_directory_uri() . '/images/edit_icon.png'; ?>" alt="edit_icon.png"><? _e('Edit information','24apotek'); ?></a>
							</div>
						</div>
						<div class="order-medicine__form-wrapper <? echo ( $edit_form ) ? 'edit-info-active' : '' ; ?>">
							<h3 class="om__personal-info-title"><? _e('Personal info','24apotek'); ?></h3>
							<div class="order-medicine__personal-info">
								<div class="om__address-column">
									<address>
										<? echo !empty( $address ) ? $address : __('Address','24apotek'); ?>
									</address>
								</div>
								<div class="om__phone-column">
									<p class="om__personal-info-email"><? echo $customer->get_billing_email(); ?></p>
									<p class="om__personal-info-phone"><? echo !empty( $customer->get_billing_phone() ) ? $customer->get_billing_phone() : __('Phone','24apotek'); ?></p>
								</div>
							</div>
							<div class="order-medicine__form">
								<? 
								if( $edit_form ) {
								 echo FrmFormsController::get_form_shortcode( array( 'id' => 7, 'title' => false, 'description' => false ) );
								}
								?>
							</div>
						</div>
						<div class="order-medicine__edit-details <? echo ( !$edit_form ) ? 'edit-info-active' : '' ; ?>">
							<form enctype="multipart/form-data" method="post" class="om-edit-detail-form"  id="edit-detail-form">
								<fieldset>
									<div class="form-wrapper">
										<div class="form-field form_half">
											<label class="form-label"><? _e('First name','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<input type="text" id="ed-first-name" name="first-name" value="<? echo $customer->get_billing_first_name();?>">
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('Last name','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<input type="text" id="ed-last-name" name="last-name" value="<? echo $customer->get_billing_last_name() ?>">
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('Email','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<input type="email" id="ed-email" name="email" value="<? echo !empty( $customer->get_billing_email() ) ? $customer->get_billing_email() : $current_user->user_email ; ?>">
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('Phone','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<input type="text" id="ed-phone" name="phone" value="<? echo $customer->get_billing_phone(); ?>">
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('Address','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<textarea name="address" id="ed-address"><? echo $customer->get_billing_address(); ?></textarea>
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('ZIP code','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<input type="number" id="ed-zip-code" name="zip-code" value="<? echo $customer->get_billing_postcode(); ?>">
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('City','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<input type="text" id="ed-city" name="city" value="<? echo $customer->get_billing_city(); ?>">
										</div>
										<div class="form-field form_half">
											<label class="form-label"><? _e('Country','24apotek'); ?>
												<span class="form_required">*</span>
											</label>
											<? 
											$form_country_field = array( 
												'type' => 'country' ,
												'required' => true,
												);
											woocommerce_form_field( 'billing_country', $form_country_field,$customer->get_billing_country() ); ?>
											<!--<input type="text" id="ed-country" name="country" value="<? echo $customer->get_billing_country(); ?>">-->
										</div>
									</div>
									<div class="edit-detail__form_submit">
										<input class="btn-black form-submit-button" value="<? _e('save changes','24apotek'); ?>"type="submit" name="edit-medicine-form">
										<!-- <button class="btn-black form-submit-button" type="submit"><? _e('save changes','24apotek'); ?></button> -->
									</div>
								</fieldset>
							</form>	
						</div>
					<? //} ?>
					</div>
					<div class="col-sm-12 col-lg-6 order-medicine__col-right">
						<div class="order-medicine__content-section">
							<div class="order-medicine__banner-image" style="background-image: url(<? the_field('image') ?>);"></div>
							<div class="thankyou-page__content-section-wrap">
								<div class="order-medicine__content-wrapper account-page__content-vip section-pd-top-50 section-pd-bottom-30">
									<div class="order-medicine__content">
										<? the_field('text');?>
									</div>
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