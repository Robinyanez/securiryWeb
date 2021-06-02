<div class="card">
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
                        <th scope="col" wire:click="sortByTable('date')">Fecha
                            @if ($sortDirection !== 'asc' && $sortField == 'date')
                                <i class="fas fa-sort-amount-down-alt"></i>
                            @else
                                <i class="fas fa-sort-amount-up-alt"></i>
                            @endif
                        </th>
                        <th scope="col">Coordenadas</th>
                        <th scope="col" wire:click="sortByTable('description')">Descripción
                            @if ($sortDirection !== 'asc' && $sortField == 'description')
                                <i class="fas fa-sort-amount-down-alt"></i>
                            @else
                                <i class="fas fa-sort-amount-up-alt"></i>
                            @endif
                        </th>
                        <th scope="col" wire:click="sortByTable('name')">Nombre
                            @if ($sortDirection !== 'asc' && $sortField == 'name')
                                <i class="fas fa-sort-amount-down-alt"></i>
                            @else
                                <i class="fas fa-sort-amount-up-alt"></i>
                            @endif
                        </th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $value)
                        <tr>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->lat}}, {{$value->lng}}</td>
                            @if (is_null($value->description))
                                <td>Descripción Vacia</td>
                            @else
                                <td>{{ $value->description}}</td>
                            @endif
                            <td>{{ $value->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" onclick="verImagenes({{$value->id_comment}})" ><i class="fas fa-images"></i></button>
                                <input type="hidden" class="coordenadasMap" data-estaticodatos="{{$value->latcli}},{{$value->lngcli}}" data-clientedatos="{{$value->lat}}, {{$value->lng}}" data-iditem="{{$value->id}}" >
                                <a type="button" class="btn btn-outline-success btnRepotes" id="btnMap{{$value->id}}" onClick="positions({{$value->lat}},{{$value->lng}},'map2');" data-toggle="modal" data-backdrop="static" data-target="#modalPosition">
                                    <i class="fas fa-map-marked-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @include('modal.position')
            @include('modal.img')

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

@push('scripts')

    <script>

        var users = new Array();
        users = @JSON($users);

        var images = new Array();
        images = @JSON($images);

        function imgPosition(element){
            document.getElementById('imgModalP').src=element.dataset.imagem;
        }

        function verImagenes(idUser){
            var imgUser = images.filter( function (element){
                return  element.imageable_id == idUser ;
            } );

            if(imgUser.length > 0){
                $('#divCarrucel').empty();
                var imgs='';
                imgUser.forEach(function (img,index) {

                    var activo='';

                    if(index == 0){
                        activo='active';
                    }

                    imgs+= '<div class="carousel-item '+activo+'">'+
                        '<img class="d-block w-100 imgCarrucel" src="'+img.url+'" alt="First slide" >'+
                        '</div>';

                });
                /* console.log(imgs); */
                $('#divCarrucel').append(imgs);
                $('#modalImg').modal('show');
            }else{
                alert('El usuario no contiene imagenes');
            }
        }

    </script>

@endpush

