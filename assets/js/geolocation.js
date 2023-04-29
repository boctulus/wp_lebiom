/*
    GeoLocation - diferentes proveedores
*/

if (typeof $ == 'undefined' && typeof jQuery != 'undefined'){
    $=jQuery
}


/*
    get_geolocation_2().then((ubicacion) => {
      console.log(ubicacion);
    });

    Lo malo de esta API es que no soporta HTTPs
    porque el server no tiene SSL
/*/

async function get_geolocation_2() {
    const url = "http://ip-api.com/json"

    return await fetch(url)
    .then(response => {
        return response.json()
    })
    .then(payload => {
        return { 
            'country': payload.country
        }
    })
    .catch(error => {
        console.log('error', error)
        Promise.reject(error);
    });
}

/*
    get_geolocation().then((ubicacion) => {
      console.log(ubicacion);
    });

    Sin una API KEY ......  HTTP 429 status code 
    ... o sea many requests
/*/

async function get_geolocation() {
    const url = 'https://api.ipregistry.co/?key=tryout'

    return await fetch(url)
    .then(response => {
        return response.json()
    })
    .then(payload => {
        return { 
            'country': payload?.location?.country?.name, 
            'city': payload?.location?.city.name
        }
    })
    .catch(error => {
        console.log('error', error)
        Promise.reject(error);
    });
}


/*
    Podria enviar al backend la localizacion
*/

//get_geolocation().then((ubicacion) => {
    // console.log(ubicacion);
//});


/*
    @param string country_code ej: 'CO'

    Trabaja con CheckoutController@update_country

    Podria ocupar callbacks asi:

    update_country('CO', () => {
        const countries_list = {
            "es" : "España",
            "pe" : "Perú",
            "co" : "Colombia",
            "mx" : "México",
            "us" : "Estados Unidos"
            // ....
        }


        jQuery('#billing_country').val(country_code) 
        
        // Campo especifico del tema de WP LEBIOM
        jQuery('#billing_country_field').children('span').text(countries_list[country_code.toUpperCase()
    })
*/
const update_country = function(country_code, cb_success = null, cb_fail = null){

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

                if (cb_success != null){
                    cb_success(country_code, res)
                }

                //clearAjaxNotification();
                //setNotification(msg);			

                console.log(res);                        
            },
            error: function(res) {
                // if is a fail,...

                if (cb_fail != null){
                    cb_fail(country_code, res)
                }

                //clearAjaxNotification();

                if (typeof res['message'] != 'undefined'){
                    //setNotification(res['message']);
                }

                console.log(res);
                console.log("An error occured, please try again.");         
            }
    });
}   

