<div class="box box-info padding-1">
    <div class="box-body">
        <div class="col-12">
            <div class="form-group">
                <label>Productos</label>
                <select name="productos_id" class="form-control" id="productos_id">
                    <option value=""> --- Select ---</option>
                    @foreach ($productos as $data)
                        <option
                            value="{{ $data->id }}"{{ old('productos_id', $modificadoresTipo->productos_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $modificadoresTipo->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>