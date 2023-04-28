<?php

use boctulus\SW\core\libs\Cart;


// shortcode [my_sc]
function my_sc()
{
   view('my_sc_view');
}


add_shortcode('my_sc', 'my_sc');
