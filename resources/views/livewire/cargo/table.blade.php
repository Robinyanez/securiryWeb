<div class="card">
    <div class="card-header">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <a href="{{ route("admin.cargo.create") }}" type="button" class="btn btn-primary float-sm-right">
                        Registrar nuevo Cargo
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                    <div class="input-group-append">
                        @if ($search !== '')
                            <div class="card">
                                <button wire:click="clearTable" class="form-control">X</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <select class="outline-none form-control" wire:model="perPage">
                    <option value="5">5 por página</option>
                    <option value="10">10 por página</option>
                    <option value="15">15 por página</option>
                    <option value="25">25 por página</option>
                    <option value="50">50 por página</option>
                    <option value="100">100 por página</option>
                </select>
            </div>
        </div>
        @if ($cargos->count())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" wire:click="sortByTable('id')">#
                            @if ($sortDirection !== 'asc' && $sortField == 'id')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                        <th scope="col" wire:click="sortByTable('name')">Nombre
                            @if ($sortDirection !== 'asc' && $sortField == 'name')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                        <th scope="col" wire:click="sortByTable('description')">Descripción
                            @if ($sortDirection !== 'asc' && $sortField == 'description')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cargos as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->description }}</td>
                        <td>
                            <a href="{{ route('admin.puesto.edit', $value->id) }}" type="button" class="btn btn-outline-primary ml-3">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container text-center d-flex justify-content-center align-items-center m-3">
                {{ $cargos->links() }}
            </div>
        @else
            <div class="container">
                No hay resultados para la busqueda "{{ $search }}" en la página {{ $page }} al mostrar {{ $perPage }} por pagina.
            </div>
        @endif
    </div>
</div>
