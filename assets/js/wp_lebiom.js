

/*
    Podria enviar al backend la localizacion
*/

get_geolocation_2().then((ubicacion) => {
    // console.log(ubicacion);
});


/*
    @param string country_code ej: 'CO'

    Trabaja con CheckoutController@update_country
*/
const update_country = function(country_code){
    
    const countries_list = {
        "es" : "España",
        "pe" : "Perú",
        "co" : "Colombia",
        "mx" : "México",
        "us" : "Estados Unidos"
    }

    country_code = country_code.toUpperCase()

    jQuery.ajax({
        url: '/api/checkout/country',
        type: "patch",
        dataType: 'json',
        cache: false,
        processData: false, // important
        contentType: false, // important
        data: JSON.stringify({country: country_code}),
        success: function(res) {
                // if is successful,...

                jQuery('#billing_country').val(country_code) 

                // Campo especifico del tema de WP LEBIOM
                jQuery('#billing_country_field').children('span').text(countries_list[country_code.toUpperCase()])

                //clearAjaxNotification();
                //setNotification(msg);			

                console.log(res);                        
            },
            error: function(res) {
                //clearAjaxNotification();

                if (typeof res['message'] != 'undefined'){
                    //setNotification(res['message']);
                }

                console.log(res);
                console.log("An error occured, please try again.");         
            }
    });
}   

