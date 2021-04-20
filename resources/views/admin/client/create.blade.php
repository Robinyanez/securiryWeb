@extends('layouts.admin')

@push('styles')


@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Creación de Clientes</h1>
    </div>

    @if(Session::has('error'))
        <div class="alert alert-danger alert-outline alert-dismissible" role="alert">
            <div class="row">
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
        </div>
    @endif

    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Monitoreo de Clientes</h6>
        </div> --}}
        <form class="user" method="POST" action="{{ route('admin.client.store') }}">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required placeholder="Nombre...">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Cédula:</label>
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula"
                                name="cedula" value="{{ old('cedula') }}" required placeholder="Cédula...">
                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Teléfono:</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}" required placeholder="Teléfono...">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">E-mail:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required placeholder="E-mail...">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Provincia:</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                name="city" value="{{ old('city') }}" required placeholder="Ciudad...">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Zona:</label>
                            <input type="text" class="form-control @error('zone') is-invalid @enderror" id="zone"
                                name="zone" value="{{ old('zone') }}" required placeholder="Zona...">
                            {{-- <select class="form-control @error('zone') is-invalid @enderror" id="zone" name="zone">
                                <option selected="selected" disabled>Elegir</option>
                                    <option value="Zona 1">Zona 1</option>
                                    <option value="Zona 2">Zona 2</option>
                                    <option value="Zona 3">Zona 3</option>
                                    <option value="Zona 4">Zona 4</option>
                                    <option value="Zona 5">Zona 5</option>
                                    <option value="Zona 6">Zona 6</option>
                                    <option value="Zona 7">Zona 7</option>
                                    <option value="Zona 8">Zona 8</option>
                                    <option value="Zona 9">Zona 9</option>
                                    <option value="Zona 10">Zona 10</option>
                            </select> --}}
                            @error('zone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Guardar</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')


@endpush
