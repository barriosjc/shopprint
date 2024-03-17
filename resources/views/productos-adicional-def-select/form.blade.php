<div class="box box-info padding-1">
    <div class="box-body">
        <div class="col-12">
            <div class="form-group">
                <label>Productos adicionales</label>
                <select name="productos_adicionales_def_id" class="form-control" id="productos_adicionales_def_id">
                    <option value=""> --- Select ---</option>
                    @foreach ($productosAdicionalDef as $data)
                        <option
                            value="{{ $data->id }}|{{ $data->productos_id }}"{{ old('productos_adicionales_def_id', $productosAdicionalDefSelect->productos_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->definicion_descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $productosAdicionalDefSelect->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>