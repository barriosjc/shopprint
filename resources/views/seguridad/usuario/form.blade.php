{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css"/>
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> 

<!-- Incluye jQuery desde CDN -->
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <input type="hidden" name="id" value="{{ old('user_id', $user->id) }}" />

<!-- Form Row-->
<div class="row gx-3 mb-3">
    <div class="col-md-6">
        <label class="form-label" for="name">Nombre</label>
        <input class="form-control" id="name" name="name" type="text" placeholder="Usuario"
            value="{{ old('name', $user->name) }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="last_name">Apellido</label>
        <input class="form-control" id="last_name" name="last_name" type="text"
            placeholder="Ingrese su nombre y apellido" value="{{ old('last_name', $user->last_name) }}" />
    </div>
</div>
<div class="mb-3">
    <label class="form-label" for="email">Email </label>
    <input class="form-control" id="email" name="email" type="email" placeholder="Ingrese su email"
        value="{{ old('email', $user->email) }}" />
</div>

<div class="col-3">
    <label class="form-label">Perfil/es</label>
    <select name="perfil_id[]" class="form-control" id="perfil_id" multiple>
    @foreach ($perfiles as $data)
        <option value="{{ $data->id }}" {{ in_array($data->id, $perfiles_user) ? 'selected' : '' }}>
            {{ $data->name }}</option>
    @endforeach
    </select>
</div>
<div class="col-12 mt-4">
    <!-- Save changes button-->
    <button class="btn btn-primary" type="submit">Guardar</button>
</div>

<script>
    $(document).ready(function () {
        $('#perfil_id').select2();
    });
</script>

