var dataEjemplo = new Array();

function positions(data1,data2,idmapa){
    dataEjemplo=[];
    const gpsPosition = {lat: data1, lng: data2 };
    console.log(gpsPosition);
    fetch('https://maps.googleapis.com/maps/api/geocode/json?latlng='+data1+','+data2+'&key=AIzaSyDfriie-SWjSHPb68aKUFlfcuCnyVuBl4U')
    .then(response => response.json())
    .then(data => {
        dataEjemplo=data.results;
        var datos = filtarElementos();
        initMap(gpsPosition,datos,idmapa);
        console.log('preba',datos.dato1);
    })
    .catch(error => console.log(error));
}

function filtarElementos(){
    var dataFinal= [];

    dataEjemplo.forEach(ele => {
        var addres=ele.address_components;
        addres.forEach(element => {
            var tipo= element.types.filter(function(zz){
                return zz =='route'})
            if(tipo.length > 0){
                dataFinal.push({
                    long_name:element.long_name,
                    short_name:element.short_name,
                })
            }
        });
    });

    var datosRuta={
        dato1:dataFinal[0].long_name == undefined ? '' : dataFinal[0].long_name,
        dato2 :dataFinal[1].long_name == undefined ? '' : dataFinal[1].long_name,
    }

    return datosRuta;
}

var map;

function initMap(gpsPosition,datos,idmodal) {
    map = new google.maps.Map(document.getElementById(idmodal), {
        center: gpsPosition,
        zoom: 17,
    });

    var marker = new google.maps.Marker({
    position: gpsPosition,
    map: map,
    });

    var infowindow = new google.maps.InfoWindow({
    content:'<h3>'+datos.dato1+', '+datos.dato2+'</h3>'
    });
    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });
    infowindow.open(map, marker);
}
