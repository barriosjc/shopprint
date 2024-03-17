<div class="box box-info padding-1">
    <div class="box-body">
        <div class="col-12">
            <div class="form-group">
                <label>Productos</label>
                <select name="productos_id" class="form-control" id="productos_id">
                    <option value=""> --- Select ---</option>
                    @foreach ($productos as $data)
                        <option
                            value="{{ $data->id }}"{{ old('productos_id', $productosAdicionalDef->productos_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="col-12">
            <div class="form-group">
                <label for="definicion_descripcion">Definicion Descripcion</label>
                <input type="text" name="definicion_descripcion" id="definicion_descripcion" class="form-control" value="{{ old('definicion_descripcion', $productosAdicionalDef->definicion_descripcion) }}" placeholder="Definicion Descripcion">
            </div>
        </div>
        
        <div class="col-12">
            <div class="form-group">
                <label>Tipo de valor de atributo</label>
                <select name="definicion_tipo" class="form-control" id="definicion_tipo">
                    <option value=""> --- Select ---</option>
                    @foreach ($adic_tipo as $data)
                        <option
                            value="{{ $data->valor }}"{{ old('definicion_tipo', $productosAdicionalDef->definicion_tipo) == $data->id ? 'selected' : '' }}>
                            {{ $data->valor }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="definicion_largo">Definicion Largo</label>
            <input type="text" name="definicion_largo" id="definicion_largo" class="form-control" value="{{ old('definicion_largo', $productosAdicionalDef->definicion_largo) }}" placeholder="Definicion Largo">
        </div>        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>