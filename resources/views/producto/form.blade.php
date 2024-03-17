<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmarBorrar(txt_id) {
        // Utiliza SweetAlert en lugar de confirm
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres borrar el dato adicional?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario hace clic en "Sí, enviar", enviar el formulario
                document.getElementById(txt_id).submit();
            }
        });
    }

</script>
@if (isset($producto->id))
    <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form"
        enctype="multipart/form-data">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('productos.store') }}" role="form" enctype="multipart/form-data">
@endif
@csrf

<div class="card">
    <div class="card-header">New Product</div>
    <div class="card-body">
        {{-- @dd($id) --}}
        <input id="id" name="id" type="hidden" value="{{ $producto->id }}" />
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Categorias</label>
                    <select name="categorias_id" class="form-select" id="categorias_id">
                        <option value=""> --- Select ---</option>
                        @foreach ($categorias as $data)
                            <option
                                value="{{ $data->id }}"{{ old('categorias_id', $producto->categorias_id) == $data->id ? 'selected' : '' }}>
                                {{ $data->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                        value="{{ old('nombre', $producto->nombre) }}" placeholder="nombre">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="detalle">Detalle</label>
                    <textarea rows="3" name="detalle" id="detalle" class="form-control" placeholder="detalle">{{ old('detalle', trim($producto->detalle)) }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="precio_compra">Precio compra</label>
                    <input type="text" name="precio_compra" id="precio_compra" class="form-control"
                        value="{{ old('precio_compra', $producto->precio_compra) }}" placeholder="Precio Compra">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="precio_venta">Precio venta</label>
                    <input type="text" name="precio_venta" id="precio_venta" class="form-control"
                        value="{{ old('precio_venta', $producto->precio_venta) }}" placeholder="Precio Venta">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="precio_venta">Orden</label>
                    <input type="text" name="orden" id="orden" class="form-control"
                        value="{{ old('orden', $producto->orden) }}" placeholder="orden">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="destacado"
                                name="destacado" {{ !$producto->destacado ?? checked }}>
                            <label class="form-check-label" for="habilitado">destacado
                                (No/Si)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <a >
                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#RestriccionesModal"> --}}
                    {{-- <i class="icono-grilla ci-add-circle"></i> --}}
                    Descripciones de restricciones</a>
                <select name="restricciones_id" class="form-select" id="restricciones_id">
                    <option value=""> --- Select ---</option>
                    @foreach ($restricciones as $data)
                        <option
                            value="{{ $data->id }}"{{ old('restricciones_id', $producto->restricciones_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#NotasModal">                 --}}
                <a >
                    {{-- <i class="icono-grilla ci-add-circle"></i>  --}}
                    Descripciones de notas</a>
                <select name="notas_id" class="form-select" id="notas_id">
                    <option value=""> --- Select ---</option>
                    @foreach ($notas as $data)
                        <option
                            value="{{ $data->id }}"{{ old('notas_id', $producto->notas_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="box-footer mt20 pt-4">
                <button type="submit" class="btn btn-primary">{{ __('Save product') }}</button>
            </div>
        </div>
    </div>
</div>
</form>
{{-- //-------------------------------------------------------------------------------------------------------------------- --}}
<div class="card-footer fs-sm text-muted  ">
    <div class="row">
        <div class="col-4">
            <a href="#" data-bs-toggle="modal" data-bs-target="#AdicionalModal">
                <i class="icono-grilla ci-add-circle"></i> Adicionales</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos_adicional_def as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->definicion_descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#AdicionalModal"
                                            class="btn btn-sm-70 btn-success" data-item-id="{{ $item->id }}"
                                            id="itemId_{{ $item->id }}">
                                            <i class="text-body ci-edit-alt size-icon"></i></a>
                                        <form id="adic_borrar_{{ $item->id }}"
                                            action="{{ route('ProductosAdicionalDef.destroy', $item->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-sm-70 btn-danger"
                                                onclick="confirmarBorrar('adic_borrar_{{ $item->id }}')">
                                                <i class="text-body ci-trash size-icon"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$productos_adicional_def)
                            <tr>
                                <td colspan="2">No hay datos a mostrar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- ------------------------------------------------------------------------------- --}}
        <div class="col-4">
            <a href="#" data-bs-toggle="modal" data-bs-target="#ModifTipoModal">
                <i class="icono-grilla ci-add-circle"></i> Modificadores - Tipos</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipos as $item)
                            <tr>
                                <td><input class="radio-tipo" type="radio" data-id="{{ $item->id }}"
                                        name="tipo"> </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModifTipoModal"
                                            class="btn btn-sm-70 btn-success" data-item-id="{{ $item->id }}"
                                            id="tipoId_{{ $item->id }}">
                                            <i class="text-body ci-edit-alt size-icon"></i></a>
                                        <form id="tipo_borrar_{{ $item->id }}"
                                                action="{{ route('tipos.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm-70 "
                                                    onclick="confirmarBorrar('tipo_borrar_{{ $item->id }}')">
                                                    <i class="text-body ci-trash size-icon"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$productos_adicional_def)
                            <tr>
                                <td colspan="2">No hay datos a mostrar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- ------------------------------------------------------------------------------- --}}
        <div class="col-4">
            <a href="#" data-bs-toggle="modal" data-bs-target="#ModifOpcionesModal" class="deshabilitar"
                id="a_opciones_modal">
                <i class="icono-grilla ci-add-circle"></i> Modificadores - Opciones </a>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="opcionesTabla">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$productos_adicional_def)
                            <tr>
                                <td colspan="2">No hay datos a mostrar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- ------------------------------------------------------------------------------- --}}
<div class="card-footer fs-sm text-muted">
    <div class="row">
        <div class="col-4">
            <form action="{{ route('productos.fotos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input id="productos_id" name="productos_id" type="hidden" value="{{ $producto->id }}" />
                {{-- <div class="col-8"> --}}
                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Agregar fotos del producto</label>
                        <label for="formFile" class="comentario-red">Attention!: Para que el producto sea visible en el listado de producto de la home, debe tener una de las fotos con la marca de Principal</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="path" name="path">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" data-bs-toggle="tooltip"
                                    title="Marcar para que sea la foto principal del producto" name="principal">
                            </div>
                            <button class="input-group-text" type="submit" for="path">Upload</button>
                        </div>
                        <h6 class="h6 nota-red">"Subir imagen en formato PNG con transparencia. Tamaño: 512 x
                            152px"
                        </h6>
                    </div>
                </div>
                {{-- </div> --}}
            </form>
            <div class="row">
                @foreach ($productos_fotos as $fotos)
                    <div class="col-6">
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
        <div class="col-8" style="display: none">
            <a href="#"><i class="icono-grilla ci-add-circle"></i> Reglas de restricciones</a>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        falta armarcar
                        @foreach ($productos_adicional_def as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm-70 btn-success"
                                            href="{{ route('productos.edit', $producto->id) }}"><i
                                                class="text-body ci-edit-alt size-icon"></i></a>
                                        <form action="{{ route('productos.restart', $producto->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm-70 "><i
                                                    class="text-body ci-trash size-icon"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$productos_adicional_def)
                            <tr>
                                <td colspan="2">No hay datos a mostrar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- no se va usar 
        <div class="row">
        <div class="box-footer mt20 pt-4">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div> --}}
</div>

{{-- //----------------------------------------------------------------------------- --}}
{{-- combo de Restricciones \\ MODAL --}}
<div class="modal fade" id="RestriccionesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog adicionales-modal-width">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restricciones as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm-70 btn-success btn-restricciones"
                                            data-item-id="{{ $item->id }}" id="itemId_{{ $item->id }}">
                                            <i class="text-body ci-edit-alt size-icon"></i></a>
                                        <form id="restricciones_{{ $item->id }}"
                                            action="{{ route('restricciones.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm-70 btn-danger">
                                                <i class="text-body ci-trash size-icon"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$restricciones)
                            <tr>
                                <td colspan="2">No hay datos a mostrar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- ------------------------------------------ --}}
            <form id="form_restricciones" action="{{ route('restricciones.store') }}" method="POST">
                @csrf
                <input id="productos_id" name="productos_id" type="hidden" value="{{ $producto->id }}" />
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <label class="label-control">Restricciones</label>
                    <input type="text" class="form-control" name="descripcion" id="restricciones_descripcion">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save new</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- //----------------------------------------------------------------------------- --}}
{{-- combo de notas \\ MODAL --}}
<div class="modal fade" id="NotasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-width">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm-70  btn-success btn-notas"
                                            data-item-id="{{ $item->id }}" id="itemId_{{ $item->id }}">
                                            <i class="text-body ci-edit-alt size-icon"></i></a>
                                        <form id="notas_{{ $item->id }}"
                                            action="{{ route('notas.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm-70 btn-danger">
                                                <i class="text-body ci-trash size-icon"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$notas)
                            <tr>
                                <td colspan="2">No hay datos a mostrar</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- ------------------------------------------ --}}
            <form id="form_notas" action="{{ route('notas.store') }}" method="POST">
                @csrf
                <input id="productos_id" name="productos_id" type="hidden" value="{{ $producto->id }}" />
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <label class="label-control">Notas</label>
                    <input type="text" class="form-control" name="descripcion" id="notas_descripcion">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save new</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ---------------------------------------------------------------------------------------------------------- --}}
{{-- adicionales - MODAL --}}
<div class="modal fade" id="AdicionalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog adicionales-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aditionals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_adic" action="{{ route('ProductosAdicionalDef.store') }}" method="POST">
                @csrf
                <input id="productos_id" name="productos_id" type="hidden" value='{{ $producto->id }}' />
                <input id="adic_id" name="adic_id" type="hidden" value='' />
                <input id="j_tabla" name="j_tabla" type="hidden" value ="{}" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="definicion_descripcion">Description</label>
                                    <input type="text" name="definicion_descripcion" id="definicion_descripcion"
                                        class="form-control" placeholder="Definicion Descripcion" value="">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tipo de valor de atributo</label>
                                    <select name="definicion_tipo" class="form-select" id="definicion_tipo">
                                        <option value=""> --- Select ---</option>
                                        @foreach ($adic_tipo as $data)
                                            <option value="{{ $data->valor }}">
                                                {{ $data->valor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="definicion_largo">Definicion Largo</label>
                                <input type="text" name="definicion_largo" id="definicion_largo"
                                    class="form-control" placeholder="Definicion Largo">
                            </div>
                            <div class="form-group pb-3">
                                <label for="definicion_largo">Cantidad de columnas</label>
                                <input type="text" name="cant_columnas" id="cant_columnas" class="form-control"
                                    placeholder="Cantidad de columnas">
                            </div>
                        </div>
                        <div class="col-6" id="div6">
                            <label class="comentario-red" id="nota_select" for="definicion_largo">
                                Si selecciona el Tipo de valor de atributo -> Select, debe ingresar los valores del select (Description, Cost and Price) y hacer click en el boton mas.</label>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="t_valores" name="t_valores">
                                    <thead class="thead">
                                        <tr>
                                            <td>#</td>
                                            <th>Description</th>
                                            <th>Cost</th>
                                            <th>Price</th>
                                            <th style="width:20$">Opt.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos_adicional_def_select as $item)
                                            {{-- <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->descripcion }}</td>
                                                <td>{{ $item->precio }}</td>
                                                <td> hola
                                                    <div class="btn-group" role="group">
                                                        <form action="{{ route('productos_adicional_def_select.destroy', $item->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm-70 "><i
                                                                    class="text-body ci-trash size-icon"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr> --}}
                                        @endforeach
                                        @if (!$productos_adicional_def_select)
                                            <tr>
                                                <td colspan="5">No hay datos a mostrar</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="value_select">Value select</label>
                                    <div class="input-group input-group-sm mb-3" id="g_valor">
                                        <input type="text" class="form-control" id="v_valor"
                                            placeholder="Description" aria-label=""
                                            aria-describedby="button-addon2">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="v_costo" placeholder="Cost"
                                            aria-label="" aria-describedby="button-addon2">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="v_precio"
                                            placeholder="Price" aria-label="" aria-describedby="button-addon2">
                                        <button class="btn btn-primary" type="button" id="add_value"> 
                                            <i class="text-body ci-add-circle size-icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnAdicionales">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

{{-- //----------------------------------------------------------------------------- --}}
{{-- modificadores - tipo \\ MODAL --}}
<div class="modal fade" id="ModifTipoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_tipos" action="{{ route('tipos.store') }}" method="POST">
                @csrf
                <input id="productos_id" name="productos_id" type="hidden" value="{{ $producto->id }}" />
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <label class="label-control">Modificador - Tipo</label>
                    <input type="text" class="form-control" name="tipos_descripcion" id="tipos_descripcion">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- --------------------------------------------------------------------------------------- --}}
{{-- modificadores - opciones \\ MODAL --}}
<div class="modal fade" id="ModifOpcionesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_opciones" action="{{ route('opciones.store') }}" method="POST">
                @csrf
                <input id="modif_tipos_id" name="modif_tipos_id" type="hidden" value='' />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="id" value="">
                            <label class="label-control">Modificador - Opciones</label>
                            <input type="text" class="form-control" name="descripcion" id="opcion_descripcion">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="label-control">Cost</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" name="costo" id="opcion_costo"  oninput="validarNumeroDecimal(this)">
                              </div>
                        </div>
                        <div class="col-6">
                            <label class="label-control">Price</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" name="precio" id="opcion_precio"  oninput="validarNumeroDecimal(this)">
                              </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //si tiene la clase deshabilitar que no responda al click
        var elementosConClase = document.getElementsByClassName('deshabilitar');

        for (var i = 0; i < elementosConClase.length; i++) {
            elementosConClase[i].addEventListener('click', function(event) {
                event.preventDefault();
            });
        }

        // muestro segun el tipo seleccionado las opciones
        @if (!$producto->id)
            var cardFooters = document.querySelectorAll('.card-footer');
            cardFooters.forEach(function(cardFooter) {
                var elementosDentroCardFooter = cardFooter.querySelectorAll('*');

                elementosDentroCardFooter.forEach(function(elemento) {
                    elemento.disabled = true;
                    elemento.style.opacity = "0.8";
                    elemento.style.cursor = "not-allowed";
                });
            });
        @endif

        $('.radio-tipo').change(function() {
            // Obtener el valor del radio button seleccionado
            var tipoId = $(this).data('id');

            // Hacer la solicitud AJAX
            $.ajax({
                type: 'GET',
                url: '/modificador/opicones/lista/' + tipoId,
                success: function(data) {
                    $('#opcionesTabla tbody').empty();
                    data.forEach(function(dato) {
                        var row = `<tr>` +
                            `<td>` + (dato.id) + `</td>` +
                            `<td>` + dato.descripcion + `</td>` +
                            `<td>` +
                            `<div class="btn-group" role="group">` +
                            `<a href="#" data-bs-toggle="modal" data-bs-target="#ModifOpcionesModal"` +
                            `class="btn btn-sm-70 btn-success btn-modificar" data-item-id="` +
                            (dato.id) + `"` +
                            `id="opcionesId_` + (dato.id) + `">` +
                            `<i class="text-body ci-edit-alt size-icon"></i></a>` +
                            `<form id="opciones_borrar_` + (dato.id) + `" ` +
                                `action="/modificadores/opciones/` + (dato.id) +
                            `" method="POST">` +
                            `@method('DELETE')` +
                            `@csrf` +
                            `<button type="button" class="btn btn-danger btn-sm-70" ` + 
                                    `onclick="confirmarBorrar('opciones_borrar_` + (dato.id) + `')">` +
                            `<i class="text-body ci-trash size-icon"></i></button>` +
                            `</form>` +
                            `</div>` +
                            `</td>` +
                            `</tr>`;
                        $('#opcionesTabla tbody').append(row);
                    });
                    //habilitar <a> para dar de alta
                    document.getElementById('a_opciones_modal').classList.remove(
                        'deshabilitar');
                    $('#modif_tipos_id').val(tipoId);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // ---------------------------------------------------------------------------------------
        // Función para agregar una nueva fila a la tabla
        function agregarFila(descripcion, costo, precio) {
            var table = $("#t_valores");
            var newRow = $("<tr>");

            // newRow.append("<td>" + (table.find("tbody tr").length + 1) + "</td>");
            // console.log("fila")
            // console.log(precio);
            newRow.append("<td></td>");
            newRow.append("<td>" + descripcion + "</td>");
            var costoNumero = parseFloat(costo);
            var costoFormateado = costoNumero.toFixed(2);
            var precioNumero = parseFloat(precio);
            var precioFormateado = precioNumero.toFixed(2);
            newRow.append("<td>$ " + costoFormateado + "</td>");
            newRow.append("<td>$ " + precioFormateado + "</td>");
            newRow.append(`
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger btn-sm-70 eliminar-fila">
                            <i class="text-body ci-trash size-icon"></i>
                        </button>
                    </div>
                </td>
            `);

            table.find("tbody").append(newRow);
            $("#g_valor input").val("");
        }

        // Evento de clic en el botón para agregar valores a la tabla
        $("#add_value").on("click", function() {
            var descripcion = $("#v_valor").val();
            var costo = $("#v_costo").val();
            var precio = $("#v_precio").val();
            if ($("#t_valores tbody tr:first-child td:first-child").attr('colspan') == 4) {
                $("#t_valores tbody tr:first-child").remove();
            }

            if (descripcion && precio) {
                agregarFila(descripcion, costo, precio);
            }
        });

        // borra la fila de la grilla que recien se subio, quiero borrar una guardada es el otro script de js, mas abajo
        $("#t_valores").on("click", ".eliminar-fila", function() {
            // console.log("id 2")
            // console.log(valorId)
            $(this).closest("tr").remove();
        });


        // -----------------------------------------------------------------------------
        // Obtén una referencia al select y al div que quieres habilitar o deshabilitar
        var selectTipo = $("#definicion_tipo");
        var div6 = $("#div6");

        function gestionarHabilitarElementos() {
            var valorSeleccionado = selectTipo.val();

            var elementosDiv6 = div6.find(':input');
            elementosDiv6.prop('disabled', valorSeleccionado !== "select");
        }

        selectTipo.on("change", gestionarHabilitarElementos);

        gestionarHabilitarElementos();

        // -------------------------------------------------------------------------------
        // hacer el submit para guardar los adicionales
        function actualizarCampoOculto() {
            var datosTabla = [];
            // Recorre las filas de la tabla y obtén los datos
            $("#t_valores tbody tr").each(function() {
                var fila = {};
                // dd($(this).find("td:eq(1)").text());
                // if(!$(this).find("td:eq(1)").text()){
                fila.id = $(this).find("td:eq(0)").text();
                fila.descripcion = $(this).find("td:eq(1)").text();
                fila.precio = $(this).find("td:eq(3)").text();
                fila.precio = fila.precio.trim().replace("$", "");
                fila.costo = $(this).find("td:eq(2)").text();
                fila.costo = fila.costo.trim().replace("$", "");
                datosTabla.push(fila);
                // }
            });

            $("#j_tabla").val(JSON.stringify(datosTabla));
        }

        var formAdic = document.getElementById('form_adic');

        // Agrega un evento de envío (submit) al formulario
        formAdic.addEventListener('submit', function(event) {
            // Evita el envío predeterminado del formulario
            event.preventDefault();

            actualizarCampoOculto();

            // Envía el formulario si todo está listo
            formAdic.submit();
        });
        // -------------------------------------------------------------------------------
        // click para modificar Adicionales
        $('[id^="itemId_"]').on('click', function(event) {
            event.preventDefault();

            var itemId = $(this).data('item-id');
            // Realiza una solicitud AJAX para obtener los datos del servidor
            $.ajax({
                url: '/productosadicionaldef/editar/' + itemId,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#definicion_descripcion').val(data.definicion_descripcion);
                    $('#definicion_largo').val(data.definicion_largo);
                    $('#cant_columnas').val(data.cant_columnas);
                    $('#definicion_tipo').val(data.definicion_tipo);

                    $('#t_valores tbody').empty();

                    for (var i = 0; i < data.valores.length; i++) {
                        var valor = data.valores[i];
                        // Crea una nueva fila con los datos del valor
                        costoFormateado = null;
                        if (valor.costo != null) {
                            var costoNumero = parseFloat(valor.costo);
                            var costoFormateado = costoNumero.toFixed(2);
                        }
                        precioFormateado = null;
                        if (valor.precio != null) {
                            var precioNumero = parseFloat(valor.precio);
                            var precioFormateado = precioNumero.toFixed(2);
                        }
                        var newRow = '<tr>' +
                            '<td>' + valor.id + '</td>' +
                            '<td>' + valor.descripcion + '</td>' +
                            '<td>$ ' + (costoFormateado || '0.00') + '</td>' +
                            '<td>$ ' + (precioFormateado || '0.00') + '</td>' +
                            '<td>' +
                            `<div class="btn-group" role="group">
                                    <form action="/ProductosAdicionalDefSelect/delete/` + valor.id + `"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger btn-sm-70 "><i
                                                class="text-body ci-trash size-icon"></i></button>
                                    </form>
                                </div>`
                        '</td>' +
                        '</tr>';

                        // Agrega la nueva fila al cuerpo de la tabla
                        $('#t_valores tbody').append(newRow);
                    }
                    // $('#form_adic').attr('method', 'PUT');
                    var newAction = "/productosadicionaldef/update/" + itemId;
                    $('#form_adic').attr('action', newAction);
                    $('#adic_id').val(itemId);
                    $('#v_valor').prop('disabled', false);
                    $('#v_costo').prop('disabled', false);
                    $('#v_precio').prop('disabled', false);
                    $('#add_value').prop('disabled', false);
                    // $('#nota_select').prop('disabled', true);
   

                    // Muestra el modal
                    $('#AdicionalUpdateModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos del servidor:', error);
                }
            });
        });
        //-----------------------------------------------
        // click para modificar tipos
        $('[id^="tipoId_"]').on('click', function(event) {
            event.preventDefault();

            var itemId = $(this).data('item-id');
            // Realiza una solicitud AJAX para obtener los datos del servidor
            $.ajax({
                url: '/modificadores/tipos/' + itemId + '/edit',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#tipos_descripcion').val(data.descripcion);

                    var newAction = "/modificador/tipos/update/" + itemId;
                    $('#form_tipos').attr('action', newAction);
                    // document.getElementById('a_opciones_modal').classList.remove('deshabilitar');
                    // Muestra el modal
                    $('#ModifTipoModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos del servidor:', error);
                }
            });
        });

        //-----------------------------------------------
        // click para modificar opciones
        //console.log("Agregando evento delegado");
        $('#opcionesTabla').on('click', '.btn-modificar', function(event) {
            event.preventDefault();

            var itemId = $(this).data('item-id');

            // Realiza una solicitud AJAX para obtener los datos del servidor
            $.ajax({
                url: '/modificadores/opciones/' + itemId + '/edit',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#opcion_descripcion').val(data.descripcion);                    
                    $('#opcion_costo').val(data.costo);                    
                    $('#opcion_precio').val(data.precio);

                    var newAction = "/modificador/opciones/update/" + itemId;
                    $('#form_opciones').attr('action', newAction);
                    // document.getElementById('a_opciones_modal').classList.remove('deshabilitar');
                    // Muestra el modal
                    $('#ModifOpcionesModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos del servidor:', error);
                }
            });
        });

        //-----------------------------------------------
        // Captura el clic en el botón de modificar
        $('.btn-restricciones').on('click', function() {
            var itemId = $(this).data('item-id');
            var descripcion = $('#itemId_' + itemId).closest('tr').find('td:eq(1)').text();
            $('#restricciones_descripcion').val(descripcion);
            var newAction = "/restricciones/update/" + itemId;
            $('#form_restricciones').attr('action', newAction);
            //$('#RestriccionesModal').modal('show');
        });

        // Captura el clic en el botón de modificar
        $('.btn-notas').on('click', function() {
            var itemId = $(this).data('item-id');
            var descripcion = $('#itemId_' + itemId).closest('tr').find('td:eq(1)').text();
            $('#notas_descripcion').val(descripcion);
            var newAction = "/notas/update/" + itemId;
            $('#form_notas').attr('action', newAction);
            //$('#RestriccionesModal').modal('show');
        });

        // $('#t_valores').on('click', '.delete-btn', function() {
        //     var fila = $(this).closest('tr');
        //     var valorId = fila.data('valor-id');
        //     console.log("id")
        //     console.log(valorId)
        //     if (valorId != ""){
        //         $.ajax({
        //             type: "DELETE", 
        //             url: "/productosadicionaldefselect/yyyy/xxxx/" + itemId,  
        //             data: {
        //                 id: valorId 
        //             },
        //             success: function (response) {
        //                 // La llamada fue exitosa, puedes manejar la respuesta aquí si es necesario
        //                 console.log("Dato eliminado con éxito");
        //             },
        //             error: function (error) {
        //                 // La llamada tuvo un error, puedes manejar el error aquí si es necesario
        //                 console.error("Error al intentar eliminar el dato", error);
        //             }
        //         });
        //     }
        //     fila.remove();
        // });

    });

    // valida carga de solo numeros
    function validarNumeroDecimal(input) {
        // Patrón para permitir solo números con hasta 2 decimales
        var regex = /^\d*\.?\d{0,2}$/;

        // Validar el valor del campo con el patrón
        if (!regex.test(input.value)) {
            // Si el valor no cumple con el patrón, eliminar el último carácter ingresado
            input.value = input.value.slice(0, -1);
        }
    }
</script>
