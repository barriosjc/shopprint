@extends('layouts.init')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-5">
                    <div class="card-header bg-secondary">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link fw-medium active" href="#" data-bs-toggle="tab"
                                    role="tab" aria-selected="true"><i class="ci-add-user me-2 mt-n1"></i>Sign up</a>
                                <a class="btn btn-primary  btn-sm" href="{{ route('login') }}">
                                    <i class="ci-sign-in me-2 mt-n1"></i>Back to login</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        @includeif('utiles.alerts')

                        <form id="registro" method="POST" id="signin-tab"
                            action="{{ route('clientes.store', 'register') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 pt-4 mt-3 mt-md-0">

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="result1" role="tabpanel">
                                            <div class="steps steps-dark mt-3">
                                                <a class="step-item active current" id="a-step1">
                                                    <div id="step1" class="step-progress"><span
                                                            class="step-count">1</span></div>
                                                    <div class="step-label"><i class="ci-add-user"></i>Step 1</div>
                                                </a><a class="step-item" href="#" id="a-step2">
                                                    <div id="step2" class="step-progress"><span
                                                            class="step-count">2</span></div>
                                                    <div class="step-label"><i class="ci-document"></i>Step 2</div>
                                                </a><a class="step-item" href="#" id="a-step3">
                                                    <div id="step3" class="step-progress"><span
                                                            class="step-count">3</span></div>
                                                    <div class="step-label"><i class="ci-check-circle"></i>Step 3</div>
                                                </a>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>

                                <div class="card-body">
                                    @php($currentTab = 1)
                                    <div class="tab-content" id="cardTabContent">
                                        <div class="tab-pane py-5 py-xl-3 fade {{ $currentTab == 1 ? 'show active' : '' }}"
                                            id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                                            <div class="row">

                                                <label class="form-label fs-5">PERSONAL INFORMATION</label>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="reg-fn">First Nane</label>
                                                    <input class="form-control" type="text" id="first_name"
                                                        name="first_name"
                                                        value="{{ old('first_name', $cliente->first_name) }}">
                                                </div>
                                                <div class="col-sm-6" style="margin-bottom: 25px;">
                                                    <label class="form-label" for="reg-ln">Last Name</label>
                                                    <input class="form-control" type="text" id="last_name"
                                                        name="last_name"
                                                        value="{{ old('last_name', $cliente->last_name) }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="valida_confirm" value="si">
                                                    <label class="form-label" for="reg-email">E-mail Address</label>
                                                    <input class="form-control" type="email" id="email" name="email"
                                                        value="{{ old('email', $cliente->email) }}">
                                                </div>
												 <div class="col-sm-6" style="margin-bottom: 25px;">
                                                    <label class="form-label" for="reg-email">Confirm E-mail Address</label>
                                                    <input class="form-control" type="email" id="conf_email" name="conf_email"
                                                        value="{{ old('conf_email', $cliente->email) }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="reg-fn">Phone</label>
                                                    <input class="form-control" type="text" id="phone" name="phone"
                                                        value="{{ old('phone', $cliente->phone) }}">
                                                </div>


                                                <nav class="d-flex justify-content-between pt-5"
                                                    aria-label="Page navigation">
                                                    <ul class="pagination">
                                                    </ul>
                                                    <ul class="pagination">
                                                        <li class="page-item"><button class="page-link" type="submit"
                                                                aria-label="Next" name="step1">Next<i
                                                                    class="ci-arrow-right ms-2"></i></button></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>


                                        <div class="tab-pane py-5 py-xl-3 fade {{ $currentTab == 2 ? 'show active' : '' }} "
                                            id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                                            <div class="row justify-content-center">
                                                <label class="form-label fs-5">ADDRESSES INFORMATION</label>
                                            </div>
                                            <div class="row justify-content-center">
												 <div class="col-sm-6">
                                                    <label class="form-label" for="reg-ln">Address (Line 1)</label>
                                                    <input class="form-control" type="text" id="address1"
                                                        name="address1"
                                                        value="{{ old('address1', $cliente->address1) }}">
                                                </div>
                                                <div class="col-sm-6" style="margin-bottom: 25px;">
                                                    <label class="form-label" for="reg-ln">Address (Line 2)</label>
                                                    <input class="form-control" type="text" id="address2"
                                                        name="address2"
                                                        value="{{ old('address2', $cliente->address2) }}">
                                                </div>                                               
                                                <div class="col-sm-3">
                                                    <label class="form-label" for="reg-ln">City</label>
                                                    <input class="form-control" type="text" id="city"
                                                        name="city" value="{{ old('city', $cliente->city) }}">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="form-label" for="reg-ln">State</label>
                                                    <input class="form-control" type="text" id="state"
                                                        name="state" value="{{ old('state', $cliente->state) }}">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="form-label" for="reg-ln">Zip Code</label>
                                                    <input class="form-control" type="text" id="zipcode"
                                                        name="zipcode" value="{{ old('zipcode', $cliente->zipcode) }}">
                                                </div>
												 <div class="col-sm-3">
                                                    <label class="form-label" for="reg-fn">Country</label>
                                                    <input class="form-control" type="text" id="country"
                                                        name="country" value="{{ old('country', $cliente->country) }}">
                                                </div>

                                               
                                            </div>
                                            <nav class="d-flex justify-content-between pt-5" aria-label="Page navigation">
                                                <ul class="pagination">
                                                    <li class="page-item"><button class="page-link" type="submit"
                                                            name="step-2">
                                                            <i class="ci-arrow-left me-2"></i>Prev</button></li>
                                                </ul>
                                                <ul class="pagination">
                                                    <li class="page-item"><button class="page-link" type="submit"
                                                            aria-label="Next" name="step2">Next<i
                                                                class="ci-arrow-right ms-2"></i></button></li>
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="tab-pane py-5 py-xl-3 fade {{ $currentTab == 3 ? 'show active' : '' }}"
                                            id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                                            <div class="row justify-content-center">
                                                <label class="form-label fs-5">OTHER INFORMATION</label>

                                                <div class="col-sm-8">
                                                    <label class="form-label" for="reg-fn">Company</label>
                                                    <input class="form-control" type="text" id="company"
                                                        name="company" value="{{ old('company', $cliente->company) }}">
                                                </div>
                                                <div class="col-sm-4" style="margin-bottom: 25px;">
                                                    <label class="form-label" for="reg-fn">Website</label>
                                                    <input class="form-control" type="text" id="website"
                                                        name="website" value="{{ old('website', $cliente->website) }}">
                                                </div>
												<div class="col-sm-12" style="margin-bottom: 25px;">
                                                    <label class="form-label" for="reg-fn">How did you hear about us?</label>
                                                    <input class="form-control" type="text" id="aboutus"
                                                        name="about_us" value="{{ old('about_us', $cliente->about_us) }}">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="form-label" for="reg-fn">TAX id</label>
                                                    <input class="form-control" type="text" id="taxid"
                                                        name="taxid" value="{{ old('taxid', $cliente->taxid) }}">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">Formulario</label>
                                                        <input class="form-control" name="form_path" type="file" id="form_path" onchange="handleFileUpload()">
                                                        <p class="nota-red" id="p_path" style="display:none;">Archivo cargado correctamente</p>
                                                        
                                                        <h6 class="nota-red">"Formato de archivo permitido, jpeg,png,pdf.
                                                            no
                                                            superar size 2 mb"<h6>
                                                    </div>
                                                </div>

                                                @if (!session('success_msg'))
                                                    <div class="col-12 text-end">
                                                        <button class="btn btn-primary" type="submit" id="submitButton"
          
                                                            name="step3"><i class="ci-user me-2 ms-n1"></i>Sign Up
                                                        </button>
                                                    </div>
                                                @endif
                                                {{-- onclick="disableButtonFor5Seconds()" --}}
                                                <nav class="d-flex justify-content-between pt-5"
                                                    aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        <li class="page-item"><button class="page-link" type="submit"
                                                                name="step-3">
                                                                <i class="ci-arrow-left me-2"></i>Prev</button></li>
                                                    </ul>
                                                    <ul class="pagination">
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="tab-pane py-5 py-xl-3 fade {{ session('paso') == 4 ? 'show active' : '' }}"
                                            id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                                            <div class="row justify-content-center" style="text-align: center">

                                                </span><i class="ci-check-circle"
                                                    style="font-size: 60px; color: #398b22;"></i></span><br><br><br>

                                                <h2><strong>¡Registración exitosa!</strong></h2>
                                                <h5>Se van a analizar los datos ingresados y luego va a recibir un email con
                                                    el resultado del registro.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if( session('paso')  !== 4)
                            <h6 class="h6 nota-red">Para poder registrarse debe completar todos los campos</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Estilos para el botón deshabilitado */
        #submitButton[disabled] {
            display: none; /* Oculta el botón deshabilitado */
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var step1 = document.getElementById("step1");
            var step2 = document.getElementById("step2");
            var step3 = document.getElementById("step3");
            var a_step1 = document.getElementById("a-step1");
            var a_step2 = document.getElementById("a-step2");
            var a_step3 = document.getElementById("a-step3");
            var wizard1 = document.getElementById("wizard1");
            var wizard2 = document.getElementById("wizard2");
            var wizard3 = document.getElementById("wizard3");
            var wizard4 = document.getElementById("wizard4");

            function remove() {
                wizard1.classList.remove("show", "active");
                wizard2.classList.remove("show", "active");
                wizard3.classList.remove("show", "active");
                a_step1.classList.remove("active", "current");
                a_step2.classList.remove("active", "current");
                a_step3.classList.remove("active", "current");
            }
            @if (session('paso') == 1)
                function paso1() {
                    remove()
                    wizard1.classList.add("show", "active");
                    a_step1.classList.add("active", "current");
                }
                paso1();
            @endif

            @if (session('paso') == 2)
                function paso2() {
                    //            console.log("agrega los active")
                    remove()
                    wizard2.classList.add("show", "active");
                    a_step1.classList.add("active");
                    a_step2.classList.add("active", 'current');
                }
                paso2();
            @endif

            @if (session('paso') == 3)
                function paso3() {
                    remove()
                    wizard3.classList.add("show", "active");
                    a_step1.classList.add("active");
                    a_step2.classList.add("active");
                    a_step3.classList.add("active", "current");
                }
                paso3();
            @endif

            @if (session('paso') == 4 )
                function paso4() {
                    remove()
                    wizard4.classList.add("show", "active");
                    a_step1.classList.add("active");
                    a_step2.classList.add("active");
                    a_step3.classList.add("active");
                    // a_step4.classList.add("active", "current");
                }
                paso4();
            @endif

            step1.addEventListener("click", function() {
                paso1();
            });

            step2.addEventListener("click", function() {
                //               console.log("paso2")
                paso2();
            });

            step3.addEventListener("click", function() {
                paso3();
            });

            //trabaja en detectar los click en los a de pasos
            const aStep1 = document.getElementById("a-step1");
            const aStep2 = document.getElementById("a-step2");
            const aStep3 = document.getElementById("a-step3");
            const buttonStep1 = document.querySelector('button[name="step1"]');
            const buttonStep2 = document.querySelector('button[name="step2"]');
            const buttonStep3 = document.querySelector('button[name="step3"]');
     
    });

    function disableButtonFor5Seconds() {
        document.getElementById('submitButton').disabled = true;
        console.log('entro al disabled');
        setTimeout(function () {
            document.getElementById('submitButton').disabled = false;
        }, 15000);
    }

    function handleFileUpload() {
                var inputFile = document.getElementById('form_path');
                var successMessage = document.getElementById('p_path');

                if (inputFile.files.length > 0) {
                    successMessage.style.display = 'block';
                } else {
                    successMessage.style.display = 'none';
                }
            }

    </script>
@endsection


