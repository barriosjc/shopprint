<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Clientes</label>
                    <select name="clientes_id" class="form-select" id="clientes_id" >
                        <option value=""> --- Select ---</option>
                        @foreach ($clientes as $data)
                            <option
                                value="{{ $data->id }}"{{ old('cliente_id', $descuento->clientes_id) == $data->id ? 'selected' : '' }}>
                                {{ $data->company }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Categorias</label>
                    <select name="categorias_id" class="form-select" id="categorias_id" >
                        <option value=""> --- Select ---</option>
                        @foreach ($categorias as $data)
                            <option
                                value="{{ $data->id }}"{{ old('cliente_id', $descuento->categorias_id) == $data->id ? 'selected' : '' }}>
                                {{ $data->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Productos</label>
                    <select name="productos_id" class="form-select" id="productos_id" >
                        <option value=""> --- Select ---</option>
                        @foreach ($productos as $data)
                            <option
                                value="{{ $data->id }}"{{ old('cliente_id', $descuento->productos_id) == $data->id ? 'selected' : '' }}>
                                {{ $data->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="cupon">Cupon</label>
                    <div class="input-group mb-3">
                        <input type="text" name="cupon" id="cupon" class="form-control"
                            value="{{ old('cupon', $descuento->cupon) }}" placeholder="Cupon"
                            aria-describedby="basic-addon2">
                        <button id="btn-cupon" class="btn btn-outline-primary" type="button" data-bs-toggle="tooltip" title="Genera un codigo al azar para el cupon"><i class="ci-idea"></i></button>
                    </div>
                </div>
            </div>            
            <div class="col-4">
                <div class="form-group">
                    <label for="porcentaje">Porcentaje</label><span class='comentario-red'>  (*)</span>
                    <input type="text" name="porcentaje" id="porcentaje" class="form-control" required
                        value="{{ old('porcentaje', $descuento->porcentaje) }}" placeholder="Numero entero entre 1 y 100">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="prioridad">Prioridad</label><span class='comentario-red'>  (*)</span>
                    <input type="text" name="prioridad" id="prioridad" class="form-control"
                        value="{{ old('prioridad', $descuento->prioridad) }}" placeholder="Numero entero entre 0 y 10">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="vigencia_desde">Vigencia Desde</label><span class='comentario-red'>  (*)</span>
                    <input type="date" name="vigencia_desde" id="vigencia_desde" class="form-control" required
                        value="{{ old('vigencia_desde', $descuento->vigencia_desde) }}" placeholder="Vigencia Desde">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="vigencia_hasta">Vigencia Hasta</label><span class='comentario-red'>  (*)</span>
                    <input type="date" name="vigencia_hasta" id="vigencia_hasta" class="form-control" required
                        value="{{ old('vigencia_hasta', $descuento->vigencia_hasta) }}" placeholder="Vigencia Hasta">
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <span class='comentario-red'>  (*)  Datos de carga obligatoria</span>
    </div>
</div>

<!-- Agrega esta sección al final de tu archivo HTML, antes de cerrar el cuerpo (</body>) -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Encuentra el botón y el input por sus IDs
        var btnCupon = document.getElementById("btn-cupon");
        var inputCupon = document.getElementById("cupon");

        // Agrega un event listener al botón para generar y mostrar el código al azar
        btnCupon.addEventListener("click", function () {
            // Genera un código al azar de 6 caracteres mezclando números y letras
            var randomCode = generateRandomCode(6);
            
            // Muestra el código en el input
            inputCupon.value = randomCode;
        });

        // Función para generar un código al azar de longitud 'length'
        function generateRandomCode(length) {
            var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var result = "";

            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * chars.length);
                result += chars.charAt(randomIndex);
            }

            return result;
        }
    });
</script>
