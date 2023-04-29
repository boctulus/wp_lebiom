<?php

use boctulus\SW\core\libs\Page;
use boctulus\SW\core\libs\Taxes;
use boctulus\SW\core\libs\Users;
use boctulus\SW\core\libs\Logger;
use boctulus\SW\core\libs\Plugins;
use boctulus\SW\core\libs\Template;

/*
    By boctulus
*/

function sw_init_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Start session on init hook.
// add_action('init', 'sw_init_session' );

require_once __DIR__ . '/shortcodes.php';

function assets(){
	//css_file('/css/bootstrap/bootstrap.min.css');
	//js_file('/js/bootstrap/bootstrap.bundle.min.js');

    //css_file('/css/styles.css');
    
    js_file('/js/utilities.js');
    //js_file('/js/sweetalert.js');
    //js_file('/js/notices.js');

    js_file('/js/geolocation.js');
    js_file('/js/wp_lebiom.js');
   
}

enqueue('assets');


add_filter( 'woocommerce_available_payment_gateways', 'payment_gateway_disable_country' );
  
function payment_gateway_disable_country( $available_gateways ) {
    if ( is_admin() ) return $available_gateways;

    $countries_payment_methods = [
        'US' => [
            'stripe'
        ],

        'MX' => [
            'stripe_cc',
            'stripe_oxxo',
            'yith_pos_cash_gateway',
            'bacs',
            'cod'
        ]
    ];

    $country = WC()->customer->get_billing_country() ?? null;

    foreach($countries_payment_methods as $ctry => $av_pm){
        if ($ctry != $country){
            foreach ($av_pm as $pm){

                //dd("Anulando ...  $pm");
            
                if (isset($available_gateways[$pm])){
                    unset($available_gateways[$pm] );
                }
    
            }
        }       
    }
   

    return $available_gateways;
}



add_action( 'woocommerce_checkout_before_order_review', 'my_custom_checkout_js' );

function my_custom_checkout_js() {
    ?>
    <script>

    </script>
    <?php
}


add_action('wp_loaded', function(){
    if (defined('WC_ABSPATH') && !is_admin())
	{
        // ..
    }    
});