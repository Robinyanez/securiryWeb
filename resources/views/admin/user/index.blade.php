@extends('layouts.admin')

@push('styles')

    @livewireStyles

@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Usuarios</h1>
        <div class="col-sm-12 col-md-3">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-backdrop="static" data-target="#modalImporUser"><i
                    class="fas fa-download fa-sm text-white-50"></i> Import Usuarios</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-backdrop="static" data-target="#modalExportUser"><i
                    class="fas fa-download fa-sm text-white-50"></i> Exportar Usuarios</a>
        </div>
    </div>

    <form action="{{ route('admin.import.user') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modalImporUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Importar Usuarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Selecciones el archivo:</label>
                                    <input style="width: 400px" type="file" class="form-control" id="file"
                                        name="file" required placeholder="file...">
                                        {{-- @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Importar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(Session::has('success'))
        <div class="alert alert-info alert-outline alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                {{Session::get('success')}}
            </div>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-info alert-outline alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                {{Session::get('error')}}
            </div>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @livewire('user.table')

</div>

@endsection

@push('scripts')

    @livewireScripts

@endpush

