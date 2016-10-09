<?php

if ( ! function_exists( 'siteorigin_north_woocommerce_change_hooks' ) ) :
/**
 * Adjust hooks to accomodate design.
 */
function siteorigin_north_woocommerce_change_hooks(){
	// Move the price higher
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );

	// Move the
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 35);

	// Use a custom upsell function to change number of items
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	add_action('woocommerce_after_single_product_summary', 'siteorigin_north_woocommerce_output_upsells', 15);

	// Remove actions in the cart
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );

	// Quick view action hooks
	add_action( 'siteorigin_north_woocommerce_quick_view_images', 'siteorigin_north_woocommerce_quick_view_image', 5 );
	add_action( 'siteorigin_north_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
	add_action( 'siteorigin_north_woocommerce_quick_view_content', 'woocommerce_template_single_price', 10 );
	add_action( 'siteorigin_north_woocommerce_quick_view_content', 'woocommerce_template_loop_rating', 15 );
	add_action( 'siteorigin_north_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
	add_action( 'siteorigin_north_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );
}
endif;
add_action('after_setup_theme', 'siteorigin_north_woocommerce_change_hooks');

if ( ! function_exists( 'siteorigin_north_woocommerce_quick_view_image' ) ) :
/**
 * Displays image in the product quick view.
 */
function siteorigin_north_woocommerce_quick_view_image() {
	echo woocommerce_get_product_thumbnail('shop_single');
}
endif;

if ( ! function_exists( 'siteorigin_north_woocommerce_add_to_cart_text' ) ) :
/**
 * Displays add to cart text.
 */
function siteorigin_north_woocommerce_add_to_cart_text( $text ) {
	return $text;
}
endif;
add_filter('woocommerce_product_single_add_to_cart_text', 'siteorigin_north_woocommerce_add_to_cart_text');

if ( ! function_exists( 'siteorigin_north_woocommerce_enqueue_styles' ) ) :
/**
 * Enqueue WooCommerce styles.
 */
function siteorigin_north_woocommerce_enqueue_styles( $styles ){
	$styles['northern-woocommerce'] = array(
		'src' => get_template_directory_uri() . '/woocommerce.css',
		'deps' => 'woocommerce-layout',
		'version' => SITEORIGIN_THEME_VERSION,
		'media' => 'all'
	);

	if( is_rtl() ) {
		$styles['northern-woocommerce-rtl'] = array(
			'src' => get_template_directory_uri() . '/woocommerce-rtl.css',
			'deps' => 'northern-woocommerce',
			'version' => SITEORIGIN_THEME_VERSION,
			'media' => 'all'
		);
		$styles['northern-woocommerce-smallscreen-rtl'] = array(
			'src' => get_template_directory_uri() . '/woocommerce-smallscreen-rtl.css',
			'deps' => 'northern-woocommerce',
			'version' => SITEORIGIN_THEME_VERSION,
			'media' => 'only screen and (max-width: ' . apply_filters( 'woocommerce_style_smallscreen_breakpoint', $breakpoint = '768px' ) . ')'
		);
	}

	if( siteorigin_setting( 'responsive_disabled' ) ) {
		unset( $styles['woocommerce-smallscreen'] );
		unset( $styles['northern-woocommerce-smallscreen-rtl'] );
	}

	return $styles;
}
endif;
add_filter('woocommerce_enqueue_styles', 'siteorigin_north_woocommerce_enqueue_styles');

if ( ! function_exists( 'siteorigin_north_woocommerce_enqueue_scripts' ) ) :
/**
 * Enqueue WooCommerce scripts.
 */
function siteorigin_north_woocommerce_enqueue_scripts( ){
	if( !function_exists('is_woocommerce') ) return;

	if( is_woocommerce() ) {
		wp_enqueue_script( 'siteorigin-north-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_localize_script( 'siteorigin-north-woocommerce', 'so_ajax', array ( 'ajaxurl' => admin_url( 'admin-ajax.php' )  ) );
	}
}
endif;
add_filter('wp_enqueue_scripts', 'siteorigin_north_woocommerce_enqueue_scripts');

if ( ! function_exists( 'siteorigin_north_woocommerce_loop_shop_columns' ) ) :
/**
 * Define the number of columns in the loop.
 */
function siteorigin_north_woocommerce_loop_shop_columns(){
	return 3;
}
endif;
add_filter('loop_shop_columns', 'siteorigin_north_woocommerce_loop_shop_columns');

if ( ! function_exists( 'siteorigin_north_woocommerce_related_product_args' ) ) :
/**
 * Define the number of columns/posts_per_page for related products.
 */
function siteorigin_north_woocommerce_related_product_args( $args ) {
	$args['columns'] = 3;
	$args['posts_per_page'] = 3;
	return $args;
}
endif;
add_filter('woocommerce_output_related_products_args', 'siteorigin_north_woocommerce_related_product_args');

if( !function_exists('siteorigin_north_woocommerce_output_upsells') ) :
function siteorigin_north_woocommerce_output_upsells(){
	woocommerce_upsell_display( -1, 3 );
}
endif;

if( !function_exists('siteorigin_north_woocommerce_template_single_undertitle_meta') ) :
function siteorigin_north_woocommerce_template_single_undertitle_meta(){
	wc_get_template( 'single-product/meta-undertitle.php' );
}
endif;
add_action('woocommerce_single_product_summary', 'siteorigin_north_woocommerce_template_single_undertitle_meta', 7);

if( !function_exists('siteorigin_north_woocommerce_update_cart_count') ) :
/**
 * Update cart count with the masthead cart icon.
 */
function siteorigin_north_woocommerce_update_cart_count( $fragments ) {
	ob_start();
	?>
	<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count;?></span>
	<?php

	$fragments['span.shopping-cart-count'] = ob_get_clean();

	return $fragments;
}
endif;
add_filter('add_to_cart_fragments', 'siteorigin_north_woocommerce_update_cart_count');

if( !function_exists('siteorigin_north_woocommerce_quick_view_button') ) :
/**
 * Add the quick view button in the products in loop.
 */
function siteorigin_north_woocommerce_quick_view_button() {
	global $product;
	if( siteorigin_setting( 'woocommerce_display_quick_view' ) ) :
		echo '<a href="#" id="product-id-' . $product->id . '" class="button product-quick-view-button" data-product-id="' . $product->id . '">' . __( 'Quick View', 'siteorigin-north') . '</a>';
	endif;
}
endif;
add_action( 'woocommerce_after_shop_loop_item', 'siteorigin_north_woocommerce_quick_view_button', 5 );

if( !function_exists('siteorigin_north_woocommerce_quick_view') ) :
/**
 * Setup quick view modal in the footer.
 */
function siteorigin_north_woocommerce_quick_view() { ?>
	<!-- WooCommerce Quick View -->
	<div id="quick-view-container">
		<div id="product-quick-view" class="quick-view"></div>
	</div>
<?php }
endif;
add_action( 'wp_footer', 'siteorigin_north_woocommerce_quick_view', 100 );

if ( ! function_exists( 'so_product_quick_view_ajax' ) ) :
/**
 * Add quick view modal content.
 */
function so_product_quick_view_ajax() {

	if ( ! isset( $_REQUEST['product_id'] ) ) {
		die();
	}

	$product_id = intval( $_REQUEST['product_id'] );

	// set the main wp query for the product
	wp( 'p=' . $product_id . '&post_type=product' );

	ob_start();

	// load content template
	wc_get_template( 'quick-view.php' );

	echo ob_get_clean();

	die();
}
endif;
add_action( 'wp_ajax_so_product_quick_view', 'so_product_quick_view_ajax');
add_action( 'wp_ajax_nopriv_so_product_quick_view', 'so_product_quick_view_ajax');

/*
* Enabling breadcrumbs in product pages and archives.
*/
add_action('woocommerce_single_product_summary','siteorigin_north_breadcrumbs', 6, 0);
add_action('woocommerce_before_shop_loop','siteorigin_north_breadcrumbs', 6, 0);
