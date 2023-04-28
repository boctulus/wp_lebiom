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
