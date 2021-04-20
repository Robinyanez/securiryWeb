<form action="{{ route('admin.user.destroy', $value->id) }}" method="POST">
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
