<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( $order ) : ?>

	<?php if ( in_array( $order->status, array( 'failed' ) ) ) : ?>

		<div class="alert alert-danger-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></div>

		<div class="alert alert-warning-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
			else
				_e( 'Please attempt your purchase again.', 'woocommerce' );
		?></div>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<div class="alert alert-success-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php _e( 'Thank you. Your order has been received.', 'woocommerce' ); ?></div>

		<table class="shop_table order_details">
            <tfoot>
			<tr>
				<th scope="row"><?php _e( 'Order:', 'woocommerce' ); ?></th>
				<td><?php echo $order->get_order_number(); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Date:', 'woocommerce' ); ?></th>
				<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Total:', 'woocommerce' ); ?></th>
				<td><?php echo $order->get_formatted_order_total(); ?></td>
            </tr>
			<?php if ( $order->payment_method_title ) : ?>
            <tr>
                <th scope="row"><?php _e( 'Payment method:', 'woocommerce' ); ?></th>
				<td><?php echo $order->payment_method_title; ?></td>
            </tr>
			<?php endif; ?>
            </tfoot>
		</table>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

    <div class="alert alert-success-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php _e( 'Thank you. Your order has been received.', 'woocommerce' ); ?></div>

<?php endif; ?>