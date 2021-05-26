@extends('layouts.admin')

@push('styles')

    @livewireStyles

    <style type="text/css">
        #map {
            height: 550px;
        }
        .shadow-1-strong {
            -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.25),0 3px 10px 0 rgba(0,0,0,.2)!important;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.25),0 3px 10px 0 rgba(0,0,0,.2)!important;
        }
        .imgCarrucel{
            min-height: 520px !important;
            height: 520px !important;
        }
    </style>

@endpush

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reporte de Reclamos</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
    </div>

    @livewire('report.rreclamo')

</div>

@endsection

@push('scripts')

    @livewireScripts

    <script>
        $(document).ready(function() {
            eachSelect();
        });

        function eachSelect(){
            $('.coordenadasMap').each(function(){
                var id=  $(this).data('iditem');
                var datosCliente=$(this).data('clientedatos').split(',');
                var datosStaticos=$(this).data('estaticodatos').split(',');

                var latitudStatico=parseFloat(datosStaticos[0]);
                var longitudStatico=parseFloat(datosStaticos[1]);

                var latitudCli=parseFloat(datosCliente[0]);
                var longitudCli=parseFloat(datosCliente[1]);

                var metrosDistancia=getDistanciaMetros(latitudStatico,longitudStatico,latitudCli,longitudCli);
                if(metrosDistancia > 25){
                    $('#btnMap'+id).removeClass('btn-outline-primary');
                    $('#btnMap'+id).addClass('btn-outline-danger');
                }
            });
        }

        function getDistanciaMetros(lat1,lon1,lat2,lon2)
        {
            rad = function(x) {return x*Math.PI/180;}
            var R = 6378.137; //Radio de la tierra en km
            var dLat = rad( lat2 - lat1 );
            var dLong = rad( lon2 - lon1 );
            var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat1)) *
            Math.cos(rad(lat2)) * Math.sin(dLong/2) * Math.sin(dLong/2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

            //aquí obtienes la distancia en metros por la conversion 1Km =1000m
            var d = R * c * 1000;
            return d.toFixed(2) ;
        }

        function positions(data1,data2){
            const gpsPosition = {lat: data1, lng: data2 };
            initMap(gpsPosition);
        }

        let mapa;

        function initMap(gpsPosition) {
            mapa = new google.maps.Map(document.getElementById("map"), {
                center: gpsPosition,
                zoom: 17,
            });
            const marker = new google.maps.Marker({
            position: gpsPosition,
            map: mapa,
            });
        }
    </script>

@endpush
