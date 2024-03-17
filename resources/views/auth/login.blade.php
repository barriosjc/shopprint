@extends('layouts.init')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
             <div class="mt-5">
				<center> <img style="" src="img/logo-login.png" width="210" height="88" alt=""/><center> </div>
            <div class="card mt-5">
                <div class="card-header bg-secondary">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab"
                                role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Sign in</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    @includeif('utiles.alerts')
                    <form class="needs-validation" autocomplete="off" novalidate id="signin-tab"
                    method="POST" action="{{ url('login') }}">
                    @csrf
                        <div class="mb-3">
                            <label class="form-label" for="si-email">Email address</label>
                            <input class="form-control" type="email" id="si-email" name="email"
                                    value="{{ old('email') }}" maxlength="50" placeholder="johndoe@example.com"
                                required>
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="si-password">Password</label>
                            <div class="password-toggle">
                                <input class="form-control" type="password" id="si-password" name="password"
                                        maxlength="30" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span
                                        class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 d-flex flex-wrap justify-content-between">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="si-remember">
                                <label class="form-check-label" for="si-remember">Remember me</label>
                            </div><a class="fs-sm" href="{{route('login.restablecer')}}">Forgot password?</a>
                        </div>
                        <button class="btn btn-primary btn-shadow d-block w-100 " type="submit">Sign in</button>
                        <a class="btn btn-warning btn-shadow d-block w-100 mt-4" 
                                href="{{route('clientes.create','register')}}">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
