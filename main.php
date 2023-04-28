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



add_action('wp_loaded', function(){
    if (defined('WC_ABSPATH') && !is_admin())
	{
       // ...
    }    
});


