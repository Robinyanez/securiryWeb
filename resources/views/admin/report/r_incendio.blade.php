@extends('layouts.admin')

@push('styles')

    @livewireStyles

    <style type="text/css">
        #map {
            height: 550px;
        }
    </style>

@endpush

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reporte de Incendios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
    </div>

    @livewire('report.rincendio')

</div>

@endsection

@push('scripts')

    @livewireScripts

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0IWtnotDvo-ciYGFLFU8RXWkC496NFcU&callback=initMap&libraries=&v=weekly"
        async
    ></script>

    <script>
        function positions(data1,data2){
            const gpsPosition = {lat: data1, lng: data2 };
            initMap(gpsPosition);
        }

        let map;

        function initMap(gpsPosition) {
            map = new google.maps.Map(document.getElementById("map"), {
                center: gpsPosition,
                zoom: 17,
            });
            const marker = new google.maps.Marker({
            position: gpsPosition,
            map: map,
            });
        }

@endpush
