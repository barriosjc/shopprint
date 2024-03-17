@extends('layouts.init')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 pt-5">
                <div class="card mt-9">
                    {{-- <div class="card-header bg-secondary">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">

                        </ul>
                    </div> --}}
                    <div class="card-body">
                        @includeif('utiles.alerts')
                        <form method="POST" action="{{ route('login.email') }}" 
                                        class="needs-validation" autocomplete="off" novalidate id="signin-tab">
                            @csrf
                            <div class="container py-4 py-lg-5 my-4">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-md-10">
                                        <h2 class="h3 mb-4">Forgot your password?</h2>
                                        <p class="fs-md">Change your password in three easy steps. This helps to keep your
                                            new password secure.</p>
                                        <ol class="list-unstyled fs-md">
                                            <li><span class="text-primary me-2">1.</span>Fill in your email address below.
                                            </li>
                                            <li><span class="text-primary me-2">2.</span>We'll email you a temporary code.
                                            </li>
                                            <li><span class="text-primary me-2">3.</span>Use the code to change your
                                                password on our secure website.
                                            </li>
                                        </ol>
                                        <div class="card py-2 mt-4">
                                            <form class="card-body needs-validation" novalidate>
                                                <div class="mb-3">
                                                    <label class="form-label" for="recover-email">Enter your email
                                                        address</label>
                                                    <input class="form-control" type="email" id="email" name="email" required>
                                                    <div class="invalid-feedback">Please provide valid email address.</div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Get new password</button>
                                                <a class="btn btn-warning btn-shadow d-block w-100 mt-4" 
                                                href="{{route('login')}}">Back to login</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
