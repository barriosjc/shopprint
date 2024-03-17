<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="campo">Campo</label>
            <input type="text" name="campo" id="campo" class="form-control" value="{{ old('campo', $parametro->campo) }}" placeholder="Campo">
        </div>
        
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" class="form-control" value="{{ old('valor', $parametro->valor) }}" placeholder="Valor">
        </div>
        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>