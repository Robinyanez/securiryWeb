<div class="card">
    <div class="card-header">
        <div class="form-group">
            <div class="row">
                {{-- <h6 class="col-sm-12 col-md-6 mg-top-5 text-primary">Monitoreo de Clientes</h6> --}}
                <div class="col-sm-12 col-md-12">
                    <a href="{{ route("admin.client.create") }}" type="button" class="btn btn-primary float-sm-right">
                        Registrar nuevo Cliente
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
        @if ($clients->count())
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
                        <th scope="col" wire:click="sortByTable('city')">Ciudad
                            @if ($sortDirection !== 'asc' && $sortField == 'email')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                        {{-- <th scope="col" wire:click="sortByTable('cedula')">Cédula
                            @if ($sortDirection !== 'asc' && $sortField == 'cedula')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th> --}}
                        <th scope="col" wire:click="sortByTable('phone')">Teléfono
                            @if ($sortDirection !== 'asc' && $sortField == 'phone')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                        <th scope="col" wire:click="sortByTable('email')">E-mail
                            @if ($sortDirection !== 'asc' && $sortField == 'email')
                                <i class="far fa-angle-double-down"></i>
                            @else
                                <i class="far fa-angle-double-up"></i>
                            @endif
                        </th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->city }}</td>
                        {{-- <td>{{ $value->cedula }}</td> --}}
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->email }}</td>
                        <td>
                            <a href="{{ route('admin.client.edit', $value->id) }}" type="button" class="btn btn-outline-primary mt-1 mb-1 ml-3 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="" type="button" class="btn btn-outline-danger mt-1 mb-1 ml-3 mr-3" data-toggle="modal" data-backdrop="static" data-target="#exampleModal-{{$value->id}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    {{-- Modal --}}
                    <form action="{{ route('admin.client.destroy', $value->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal fade" id="exampleModal-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Eliminar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Esta seguro que desea eliminar el registro <strong>{{$value->name}}</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Si</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    @endforeach
                </tbody>
            </table>
            <div class="container text-center d-flex justify-content-center align-items-center m-3">
                {{ $clients->links() }}
            </div>
        @else
            <div class="container">
                No hay resultados para la busqueda "{{ $search }}" en la página {{ $page }} al mostrar {{ $perPage }} por pagina.
            </div>
        @endif
    </div>
</div>
