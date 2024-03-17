    <!-- Steps-->
    <div class="steps steps-light pt-2 pb-3 mb-5">
        <a class="step-item paso" data-step="1" href="{{ route('cart.index') }}">
            <div class="step-progress"><span class="step-count">1</span></div>
            <div class="step-label"><i class="ci-cart"></i>Cart</div>
        </a>
        <a class="step-item paso" data-step="2" href="{{ route('cart.entrega') }}">
            <div class="step-progress"><span class="step-count">2</span></div>
            <div class="step-label"><i class="ci-package"></i>Shipping</div>
        </a>
        <a class="step-item paso" data-step="3" href="{{ route('cart.confirm') }}">
            <div class="step-progress"><span class="step-count">3</span></div>
            <div class="step-label"><i class="ci-bag"></i>Confirm</div>
        </a>
        <a class="step-item paso" data-step="4" href="{{ route('cart.pago') }}">
            <div class="step-progress"><span class="step-count">4</span></div>
            <div class="step-label"><i class="ci-card"></i>Payment</div>
        </a>
        <a class="step-item paso" data-step="5" href="{{ route('cart.review', 0) }}">
            <div class="step-progress"><span class="step-count">5</span></div>
            <div class="step-label"><i class="ci-check-circle"></i>Review</div>
        </a>
    </div>


    <script>
        // Obtén el valor de la variable $step (simulado aquí con una variable JavaScript)
        var step = {{$step}}; // Puedes cambiar este valor según tus necesidades

        // Obtiene todos los elementos con la clase "paso"
        var pasoElements = document.querySelectorAll('.paso');
    
        // Itera a través de los elementos y agrega la clase "active" según el valor de $step
        for (var i = 0; i < pasoElements.length; i++) {
            var elemento = pasoElements[i];
            var dataStep = elemento.getAttribute('data-step');
            if (dataStep <= step) {
                elemento.classList.add('active');
            } else {
                elemento.classList.remove('active');
            }
            if (dataStep == step) {
                elemento.classList.add('current');
            } else {
                elemento.classList.remove('current');
            }
        }
    </script>
    
    
    
    
    
    

