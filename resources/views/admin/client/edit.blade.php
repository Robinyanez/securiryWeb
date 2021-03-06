@extends('layouts.admin')

@push('styles')

@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edición de Clientes</h1>
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
        <form class="user" method="POST" action="{{ route('admin.client.update', $clients->id) }}">
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $clients->name }}"
                                name="name" value="{{ $clients->name }}" required placeholder="Nombre...">
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
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" value="{{ $clients->cedula }}"
                                name="cedula" value="{{ $clients->cedula }}" placeholder="Cédula...">
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
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ $clients->phone }}"
                                name="phone" value="{{ $clients->phone }}" placeholder="Teléfono...">
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $clients->email }}"
                                name="email" value="{{ $clients->email }}" placeholder="E-mail...">
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
                            <label for="">Ciudad:</label>
                            <select class="form-control @error('country_id') is-invalid @enderror" id="country_id" name="country_id">
                                <option selected="selected" disabled>Elegir</option>
                                @forelse ($countries as $item)
                                    @if ($item->id == $clients->country_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @empty
                                    <option value="" selected>No existen datos</option>
                                @endforelse
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Zona:</label>
                            <select class="form-control @error('zone_id') is-invalid @enderror" id="zone_id" name="zone_id">
                                <option selected="selected" disabled>Elegir</option>
                                @forelse ($zones as $item)
                                    @if ($item->id == $clients->zone_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @empty
                                    <option value="" selected>No existen datos</option>
                                @endforelse
                            </select>
                            @error('zone_id')
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
