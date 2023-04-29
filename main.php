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


add_action( 'woocommerce_checkout_before_order_review', 'my_custom_checkout_js' );

function my_custom_checkout_js() {
    ?>
    <script>

        let country;
        
        /*
            Debende de como este configurado y plugins instalados
        */
        const payment_methods_by_country = {
            'US' : [
                'stripe'
            ],

            'MX' : [
                'stripe_cc',
                'stripe_oxxo',
                'yith_pos_cash_gateway',
                'bacs',
                //'cod'
            ]
        }

        /*
            payment_method seria algo como

            stripe                -US-
            stripe_cc             -MX-
            stripe_oxxo           -MX-
            yith_pos_cash_gateway -MX-
            bacs (transferencia)  -MX-

            cod (contra re-embolso)
        */
        const hide_payment = (payment_method) => {
            let __class = `.payment_method_${payment_method}`;
            
            //console.log('HIDDING .... ' + __class);
            jQuery(__class).remove()
        }


        window.addEventListener("DOMContentLoaded", (event) => {            
           
            setTimeout(() => {  
                //console.log('HIDDING ....');

                country = jQuery('#billing_country').val();

                switch(country){
                    case 'MX':
                        hide_payment('stripe')
                        break;
                    case 'US':
                        hide_payment('stripe_cc')
                        hide_payment('stripe_oxxo')
                        hide_payment('yith_pos_cash_gateway')
                        hide_payment('bacs')
                        hide_payment('cheque')
                        hide_payment('cod')
                        break;

                    default:
                        hide_payment('stripe')
                        hide_payment('stripe_cc')
                        hide_payment('stripe_oxxo')
                        hide_payment('yith_pos_cash_gateway')
                        hide_payment('bacs')
                        hide_payment('cheque')
                        hide_payment('cod')
                 }
            }, 1000)
        });

    </script>
    <?php
}


add_action('wp_loaded', function(){
    if (defined('WC_ABSPATH') && !is_admin())
	{
        $country = WC()->customer->get_billing_country();

        dd($country, 'COUNTRY');
    }    
});


