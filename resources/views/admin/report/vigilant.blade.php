@extends('layouts.admin')

@push('styles')

    @livewireStyles

@endpush

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Clientes</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
    </div>

    @livewire('report.rvigilat')

</div>

@endsection

@push('scripts')

    @livewireScripts

@endpush
