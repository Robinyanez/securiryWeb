@extends('layouts.admin')

@push('styles')

@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Creación de Clientes</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Monitoreo de Clientes</h6>
        </div>
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
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="">Provincia:</label>
                            <select class="form-control @error('countries_id') is-invalid @enderror" id="countries_id" name="countries_id">
                                <option selected="selected" disabled>Elegir</option>
                                    @forelse($countries as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @empty
                                            <option value="">No existen datos</option>
                                    @endforelse
                            </select>
                            @error('countries_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="">Zona:</label>
                            <select class="form-control @error('zones_id') is-invalid @enderror" id="zones_id" name="zones_id">
                                <option selected="selected" disabled>Elegir</option>
                                    @forelse($zones as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @empty
                                            <option value="">No existen datos</option>
                                    @endforelse
                            </select>
                            @error('zones_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="">Guardia:</label>
                            <select class="form-control @error('users_id') is-invalid @enderror" id="users_id" name="users_id">
                                <option selected="selected" disabled>Elegir</option>
                                    @forelse($users as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @empty
                                            <option value="">No existen datos</option>
                                    @endforelse
                            </select>
                            @error('users_id')
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
