<div class="box box-info padding-1">
    <div class="box-body">
        <div class="box-body">
            <div class="form-group">
                <label for="detalle">Detalle</label>
                <textarea  rows="4" name="descripcion" id="descripcion" class="form-control"  placeholder="detalle">
                    {{ old('detalle', $productosRestriccione->descripcion) }}
                </textarea>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>