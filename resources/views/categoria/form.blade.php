<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $categoria->descripcion) }}" placeholder="Descripción">
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="descuentos_id">Descuentos Id</label>
            <input type="text" name="descuentos_id" id="descuentos_id" class="form-control" value="{{ old('descuentos_id', $categoria->descuentos_id) }}" placeholder="Descuentos Id">
            @error('descuentos_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>