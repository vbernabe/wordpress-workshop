<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

				$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
				$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				?>
				<div class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item clear', $cart_item, $cart_item_key ) ); ?>">

					<?php if ( ! $_product->is_visible() ) : ?>
						<div class="mini_cart_img">
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
						</div>
						<div class="mini_cart_details">
							<p class="mini_cart_product"><?php echo $product_name; ?></p>
							<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							<p class="mini_cart_cost"><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></p>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
							<div class="mini_cart_img">
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							</div>
							<div class="mini_cart_details">
								<p class="mini_cart_product"><?php echo $product_name; ?></p>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
								<p class="mini_cart_cost"><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></p>
							</div>
						</a>
					<?php endif; ?>
				</div>
				<?php
			}
		} ?>

	<?php else : ?>

		<div class="empty"><?php _e( 'No products in the cart.', 'siteorigin-north' ); ?></div>

	<?php endif; ?>

</div><!-- end product list -->

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<p class="total"><strong><?php _e( 'Subtotal', 'siteorigin-north' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward mini_cart_view"><?php _e( 'View Cart', 'siteorigin-north' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward mini_cart_checkout"><?php _e( 'Checkout', 'siteorigin-north' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
