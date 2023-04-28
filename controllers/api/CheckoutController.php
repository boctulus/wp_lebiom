<?php

namespace boctulus\SW\controllers\api;

use boctulus\SW\core\libs\Files;

class CheckoutController
{
    /*
        /api/checkout/country o como este definido en la ruta

        {
            "billing": {
                "country": "ES"
            },

            "shipping": {
                "country": "ES"
            }
        }

        o...

        {
          "country": "ES"
        }    

    */
    function update_country(){
       $body =  request()->getBody(false);

       if (empty($body)){
            error("JSON invalido. Vacio?",  400);
       }

       $country = $body['country'] ?? null;

       if (empty($country)){
            $billing_country  = $body['billing']['country']  ?? null;
            $shipping_country = $body['shipping']['country'] ?? null;
       }

       WC()->customer->set_billing_country($country  ?? $billing_country);
       WC()->customer->set_shipping_country($country ?? $shipping_country);

       return response($body);
    }

}
