@extends('layouts.admin')

@push('styles')

@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Creación de Usuarios</h1>
    </div>

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

    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Monitoreo de Guardias</h6>
        </div> --}}
        <form class="user" method="POST" action="{{ route('admin.user.store') }}">
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
                            <label for="">Contraseña:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" required placeholder="Contraseña...">
                                @error('password')
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
                            <label for="">Rol:</label>
                            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                                name="role" value="{{ old('role') }}" required placeholder="Rol...">
                            @error('role')
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
                            <label for="">Puesto:</label>
                            <input type="text" class="form-control @error('puesto') is-invalid @enderror" id="puesto"
                                name="puesto" value="{{ old('phone') }}" required placeholder="Puesto...">
                            @error('puesto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Cliente:</label>
                            <select class="form-control @error('clients_id') is-invalid @enderror" id="clients_id" name="clients_id">
                                <option selected="selected" disabled>Elegir</option>
                                @forelse($clients as $value)
                                    <option value="{{$value->id}}">{{$value->city}} - {{$value->name}}</option>
                                @empty
                                    <option value="">No existen datos</option>
                                @endforelse
                            </select>
                            @error('clients_id')
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
