<div class="card card-default ">
    <div class="card-header">
    <span class="card-title" style="font-size: 20px; font-weight: 600;"> Client</span>
    </div>
    <div class="card-body">
        <div class="row" style="margin-bottom: 25px;">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label" for="first_name">First Nane</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        value="{{ old('first_name', $cliente->first_name) }}" placeholder="Nombre fantasia">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{ old('last_name', $cliente->last_name) }}" placeholder="Last Name">
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">Usuario Aprobó</label>
                    <label  name="" id="fecha_aprobo" class="form-control"
                    value="{{ old('fecha_aprobo', $cliente->fecha_aproboy) }}" placeholder="">

                    <select name="users_id_aprobo" class="form-control" id="users_id_aprobo">
                        <option value=""> --- Select ---</option>
                        @foreach ($usuarios as $data)
                            <option
                                value="{{ $data->id }}"{{ old('users_id_aprobo', $cliente->users_id_aprobo) == $data->id ? 'selected' : '' }}>
                                {{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label" for="fecha_aprobo">Fecha Aprobo</label>
                    <input type="date" name="fecha_aprobo" id="fecha_aprobo" class="form-control"
                        value="{{ old('fecha_aprobo', $cliente->fecha_aproboy) }}" placeholder="Fecha Aprobo">
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="mb-3">
                        <label for="" class="form-label">Formulario</label>
                        <input class="form-control" name="form_path" type="file" id="form_path"
                            value="{{ $cliente->form_path }}" onchange="handleFileUpload()">
                        @if ($cliente->form_path)
                            <div name="form_path_text" class="nota-red">Valor actual: {{ $cliente->form_path }}
                                <a class="btn btn-sm-80 btn-secondary btn-icon"
                                    href="{{ asset('storage/clientes/' .$cliente->form_path) }}" download>
                                    <i class="text-body ci-download"></i>
                                </a>
                            </div>
                        @else
                            <p class="nota-red" id="msg_upload">se muestra val por js</p>
                        @endif
                        <h6 class="nota-red">"Subir imagen en formato PDF. no superar size 2 mb"<h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <input type="hidden" name="valida_confirm" value="no">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="text" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Habilitar usuario</label>
                    <div class="col">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="habilitar"
                                name="habilitar" {{ $cliente->fecha_aprobo != null ? 'checked' : '' }}>
                            <label class="form-check-label" for="habilitado">Ponga la opción en SI para habilitar al usuario el acceso al portal.
                                (No/Si)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
</div>

<div class="card card-default mt-3">
    <div class="card-header">
      <span class="card-title" style="font-size: 20px; font-weight: 600;"> Datos de facturación</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="form-label" for="company">Razon Social</label>
                    <input type="text" name="company" id="company" class="form-control"
                        value="{{ old('company', $cliente->company) }}" placeholder="Razon Social">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="form-label" for="cuit">TaxId</label>
                    <input type="text" name="taxid" id="taxid" class="form-control"
                        value="{{ old('taxid', $cliente->taxid) }}" placeholder="TaxId">
                </div>
            </div>            
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="form-label" for="factor_envio">Factor de envio</label>
                    <input type="text" name="factor_envio" id="factor_envio" class="form-control" maxlength="7"
                        value="{{ old('factor_envio', $cliente->factor_envio) }}" placeholder="Factor"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="El valor que ingrese aquí se multiplicará por el valor del km ingresado en parametros. El resultado será el Costo de envio.">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-default mt-3">
    <div class="card-header">
      <span class="card-title" style="font-size: 20px; font-weight: 600;"> Formas de pago</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="tarjeta"
                                name="tarjeta" {{ $cliente->forma_pago_tarjeta == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="habilitado">Tarjeta
                                (No/Si)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="cheque"
                                name="cheque" {{ $cliente->forma_pago_cheque == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="habilitado">Cheque
                                (No/Si)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="ctacte"
                                name="ctacte" {{ $cliente->forma_pago_ctacte == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="habilitado">Cuenta corriente
                                (No/Si)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-default mt-3">
    <div class="card-header">
       <span class="card-title" style="font-size: 20px; font-weight: 600;">Location</span>
    </div>
    <div class="card-body">
        <div class="row">
			<div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label" for="address1">Address 1</label>
                    <input type="text" name="address1" id="address1" class="form-control"
                        value="{{ old('address1', $cliente->address1) }}" placeholder="Address1">
                </div>
            </div>
            <div class="col-sm-6" style="margin-bottom: 25px;">
                <div class="form-group">
                    <label class="form-label" for="sector_address2">Address 2</label>
                    <input type="text" name="address2" value="{{ old('address2', $cliente->address2) }}"
                        class="form-control" placeholder="Address 2">
                </div>
            </div>           
            <div class="col-sm-5">
                <label class="form-label" for="reg-ln">City</label>
                <input class="form-control" type="text" id="city" name="city"
                    value="{{ old('city', $cliente->city) }}">
            </div>
            <div class="col-sm-5">
                <label class="form-label" for="reg-ln">State</label>
                <input class="form-control" type="text" id="state" name="state"
                    value="{{ old('state', $cliente->state) }}">
            </div>
            <div class="col-sm-2" style="margin-bottom: 25px;">
                <label class="form-label" for="reg-ln">Zip Code</label>
                <input class="form-control" type="text" id="zipcode" name="zipcode"
                    value="{{ old('zipcode', $cliente->zipcode) }}">
            </div>			
			 <div class="col-sm-4">
                <label class="form-label" for="reg-fn">Country</label>
                <input class="form-control" type="text" id="country" name="country"
                    value="{{ old('country', $cliente->country) }}">
            </div>
			 <div class="col-4">
                <div class="form-group">
                    <label class="form-label" for="phone">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $cliente->phone) }}" class="form-control"
                        placeholder="Phone">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label" for="sector_email">Web Site</label>
                    <input type="text" name="website" value="{{ old('website', $cliente->website) }}" class="form-control"
                        placeholder="Web Site">
                </div>
            </div>
           
        </div>
    </div>

    <div class="card-footer">
        <div class="box-footer mt-3">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>
</div>
<script>
        var inputFile = document.getElementById('form_path');
        var successMessage = document.getElementById('msg_upload');
        successMessage.textContent = 'Debe seleccionar un archivo';

    function handleFileUpload() {

        console.log(inputFile.files.length > 0)
        if (inputFile.files.length > 0) {
            successMessage.textContent = 'El archivo se ha cargado correcmente.';
        } else {
            successMessage.textContent = 'Debe seleccionar un archivo';
        }
    }

</script>