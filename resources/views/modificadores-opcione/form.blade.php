<div class="box box-info padding-1">
    <div class="box-body">
        <div class="col-12">
            <div class="form-group">
                <label>Modificadores Tipos</label>
                <select name="modif_tipos_id" class="form-control" id="modif_tipos_id">
                    <option value=""> --- Select ---</option>
                    @foreach ($tipos as $data)
                        <option
                            value="{{ $data->id }}"{{ old('modif_tipos_id', $modificadoresOpcione->modif_tipos_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $modificadoresOpcione->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>