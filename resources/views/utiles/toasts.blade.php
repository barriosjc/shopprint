@if (session()->has('success'))
<div class="alert alert-success ">
    {{ session('success') }}
</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success ">
    {{ session('message') }}
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger ">
    {{ session('error') }}
</div>
@endif
@if (session()->has('noticia'))
<div class="alert alert-warning ">
    {{ session('noticia') }}
</div>
@endif

{{-- @endif --}}
@if ($errors->any())
<div class="alert alert-danger ">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('error') ||
    session()->has('noticia') ||
    session()->has('message') ||
    session()->has('success') ||
    $errors->any())
<script>
    window.onload = function() {
        window.scrollTo(0, 0); // Mueve el cursor a la esquina superior del formulario
    };
</script>
@endif

    @if(session('error_msg'))
        <div class="position-fixed top-0 end-0 p-3">
            <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-primary text-white">
                    <i class="ci-bell me-2"></i>
                    <strong class="fw-medium me-auto">Message</strong>
                    <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                @if(session('error_msg'))
                    <div class="toast-body text-primary">
                        {{ session('error_msg') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="toast-body text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    @endif

@if(session('success_msg'))
    <div class="position-fixed top-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-info text-white">
                <i class="ci-bell me-2"></i>
                <strong class="fw-medium me-auto">Message</strong>
                <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            @if(session('success_msg'))
                <div class="toast-body text-info">
                    {!! session('success_msg') !!}
                </div>
            @endif
            @if ($errors->any())
                <div class="toast-body text-info">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {!! $error !!}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endif

<script>
    // Muestra el Toast si existe un mensaje
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success_msg') || $errors->any())
            var toast = new bootstrap.Toast(document.getElementById('toast'));
            toast.show();
        @endif
        @if(session('error_msg') || $errors->any())
            var toast = new bootstrap.Toast(document.getElementById('toast'));
            toast.show();
        @endif
    });
</script>