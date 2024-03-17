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
                    <select name="definicion_tipo" class="form-control" id="definicion_tipo">
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
            <label for="definicion_largo"></label>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="t_valores" name="t_valores">
                    <thead class="thead">
                        <tr>
                            <td>#</td>
                            <th>Description</th>
                            <th>Precio</th>
                            <th style="width:20$">Opt.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos_adicional_def_select as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>{{ $item->precio }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        {{-- <form action="{{ route('productos_adicional_def_select.destroy', $item->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-danger btn-sm-70 "><i
                                                    class="text-body ci-trash size-icon"></i></button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$productos_adicional_def_select)
                            <tr>
                                <td colspan="4">No hay datos a mostrar</td>
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
                        <input type="text" class="form-control" id="v_precio"
                            placeholder="Price" aria-label="" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="add_value"> <i
                                class="text-body ci-add-circle
                            size-icon"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btnAdicionales">Save changes</button>
    </div>
