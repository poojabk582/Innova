<?
/* The sidebar containing the main widget area */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
if ( is_account_page() ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<? dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
