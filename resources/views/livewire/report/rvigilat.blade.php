<div class="card">
    <div class="card-header">
        <div class="form-group">
            <div class="row">
                <h6 class="col-sm-12 col-md-6 mg-top-5 text-primary">Gestión de Clientes</h6>
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
        @if ($users->count())
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
                        <th scope="col" {{-- wire:click="sortByTable('name')" --}}>Coordenadas
                            {{-- @if ($sortDirection !== 'asc' && $sortField == 'name')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif --}}
                        </th>
                        <th scope="col" wire:click="sortByTable('date')">Fecha
                            @if ($sortDirection !== 'asc' && $sortField == 'name')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $value)
                        {{-- @foreach ($value->times as $item)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $item->lat}}, {{$item->lng}}</td>
                            <td>{{ $item->date }}</td>
                        </tr>
                        @endforeach --}}
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->lat}}, {{$value->lng}}</td>
                            <td>{{ $value->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container text-center d-flex justify-content-center align-items-center m-3">
                {{ $users->links() }}
            </div>
        @else
            <div class="container">
                No hay resultados para la busqueda "{{ $search }}" en la página {{ $page }} al mostrar {{ $perPage }} por pagina.
            </div>
        @endif
    </div>
</div>

