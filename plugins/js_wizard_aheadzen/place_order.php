<?php
session_start();
ob_start();
global $current_user;
$uid = $current_user->ID;
// build order data
$order_data = array(
    'post_name'     => 'order-' . date('M-d-Y-hi-a'), //'order-jun-19-2014-0648-pm'
    'post_type'     => 'shop_order',
    'post_title'    => 'Order &ndash; ' . date('F d, Y @ h:i A'), //'June 19, 2014 @ 07:19 PM'
    'post_status'   => 'publish',
    'ping_status'   => 'closed',
    'post_excerpt'  => 'New Site Creation Order',
    'post_author'   => $uid,
    'post_password' => uniqid( 'order_' ),   // Protects the post just in case
    'post_date'     => date('Y-m-d H:i:s e'), //'order-jun-19-2014-0648-pm'
    'comment_status' => 'open'
);



// create order
$order_id = wp_insert_post( $order_data, true );

if ( is_wp_error( $order_id ) ) {

    $order->errors = $order_id;

} else {

    $order->imported = true;
	
	// add a bunch of meta data
   // add_post_meta($order_id, 'transaction_id', 0, true); 
    add_post_meta($order_id, '_payment_method_title', 'Site Creation', true);
    add_post_meta($order_id, '_order_total', 0, true);
    add_post_meta($order_id, '_customer_user', $uid, true);
    add_post_meta($order_id, '_completed_date', date('Y-m-d H:i:s e'), true);
    add_post_meta($order_id, '_order_currency', 'USD', true);
    add_post_meta($order_id, '_paid_date', date('Y-m-d H:i:s e'), true);

    // billing info
    /*add_post_meta($order_id, '_billing_address_1', $_POST['billing_address_1'], true);
    add_post_meta($order_id, '_billing_address_2', $_POST['billing_address_2'], true);
    add_post_meta($order_id, '_billing_city', $_POST['billing_city'], true);
    add_post_meta($order_id, '_billing_state', $_POST['billing_state'], true);
    add_post_meta($order_id, '_billing_postcode', $_POST['billing_postcode'], true);
    add_post_meta($order_id, '_billing_country', $_POST['billing_country'], true);
    add_post_meta($order_id, '_billing_email', $_POST['billing_email'], true);
    add_post_meta($order_id, '_billing_first_name', $_POST['billing_first_name'], true);
    add_post_meta($order_id, '_billing_last_name', $_POST['billing_last_name'], true);
    add_post_meta($order_id, '_billing_phone', $_POST['billing_phone'], true);
	*/
	global $woocommerce;
	// get product by item_id
	$my_template = get_post($_SESSION['my_templateid']);
	//$product = new WC_Product( $my_template );
	
    if( $_SESSION['my_templateid'] ) {
		// add item
        $item_id = wc_add_order_item( $order_id, array(
            'order_item_name'       => get_the_title($_SESSION['my_templateid']),
            'order_item_type'       => 'line_item'
        ) );

        if ( $item_id ) {

            // add item meta data
            wc_add_order_item_meta( $item_id, '_qty', 1 ); 
            //wc_add_order_item_meta( $item_id, '_tax_class', $product->get_tax_class() );
			//wc_add_order_item_meta( $item_id, '_tax_class', '' );
            wc_add_order_item_meta( $item_id, '_product_id', $_SESSION['my_templateid'] );
           // wc_add_order_item_meta( $item_id, '_variation_id', '' );
            wc_add_order_item_meta( $item_id, '_line_subtotal', wc_format_decimal( 0 ) );
            wc_add_order_item_meta( $item_id, '_line_total', wc_format_decimal( 0 ) );
            wc_add_order_item_meta( $item_id, '_line_tax', wc_format_decimal( 0 ) );
            wc_add_order_item_meta( $item_id, '_line_subtotal_tax', wc_format_decimal( 0 ) );

        }

        // set order status as completed
        wp_set_object_terms( $order_id, 'completed', 'shop_order_status' );
		
		$order = new WC_Order($order_id);
		$order->update_status('completed', 'order_note'); // order note is optional, if you want to  add a note to order
		
		wc_delete_shop_order_transients( $order_id );

    } else {

        $order->errors = 'Product  '.get_the_title($_SESSION['my_templateid']).'(' . $_SESSION['my_templateid'] . ') not found.';
		
    }
}
?>