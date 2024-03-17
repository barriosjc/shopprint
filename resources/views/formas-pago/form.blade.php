<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $formasPago->descripcion) }}" placeholder="Descripcion">
        </div>        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>