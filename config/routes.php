<?php

/*
    Routes for Router

    Nota: la ruta mas general debe colocarse al final
*/

return [
    'PATCH:/api/checkout/country'  => 'boctulus\SW\controllers\api\CheckoutController@update_country',
    //'/cart/quote'  => 'boctulus\SW\controllers\CartController@save_form',
];
