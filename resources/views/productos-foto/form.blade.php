<div class="box box-info padding-1">
    <div class="box-body">
        <form action="{{ route('productos.fotos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input id="productos_id" name="productos_id" type="hidden" value="{{ $productos->id }}" />
            <div class="col-8">
                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Agregar fotos del producto</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="path" name="path">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" data-bs-toggle="tooltip"
                                    title="Marcar para que sea la foto principal del producto" name="principal">
                            </div>
                            <button class="input-group-text" type="submit" for="path">Upload</button>
                        </div>
                        <h6 class="text-danger">"Subir imagen en formato PNG con transparencia. Tamaño: 512 x 152px"
                        </h6>
                    </div>
                </div>
            </div>
        </form>
        
        <div class="row">
            @foreach ($productos_fotos as $fotos)
                <div class="col-3">
                    <div class="card h-100">
                        <img src="{{ Storage::disk('productos')->url($fotos->path) }}" class="card-img-top">
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div>
                                <label class="form-check-label me-2">Principal</label>
                                <input type="checkbox" class="form-check-input"
                                    {{ $fotos->principal == 1 ? 'checked' : '' }}>
                            </div>
                            <div>
                                <form
                                    action="{{ route('productos.fotos.destroy', [$fotos->id, $fotos->productos_id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm-80"
                                        onclick="return confirm('Confirma eliminar?')" value="Delete">
                                        <i class="text-body ci-trash size-icon"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>