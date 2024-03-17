@extends('layouts.main-back')

@section('template_title')
    Cliente
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function confirmarBorrar(id) {
            // Utiliza SweetAlert en lugar de confirm
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres dar de baja al Cliente?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario hace clic en "Sí, enviar", enviar el formulario
                    console.log("adic_borrar_" + id)
                    document.getElementById("adic_borrar_" + id).submit();
                }
            });
        }
    </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               <strong> {{ __('Cliente') }}</strong>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clientes.create', 'abm') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>TaxId</th>
                                        <th>Habilitado</th>
                                        <th>Fecha hab.</th>
                                        <th>Estado</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td style="width: 5%;">{{ ++$i }}</td>
                                            <td style="width: 20%;">{{ $cliente->first_name }}</td>
                                            <td style="width: 30%;">{{ $cliente->last_name }}</td>
                                            <td style="width: 30%;">{{ $cliente->phone }}</td>
                                            <td style="width: 30%;">{{ $cliente->company }}</td>
                                            <td style="width: 30%;">{{ $cliente->taxid }}</td>
                                            <td style="width: 15%;">{{ $cliente->userAprobo == null ? "" : $cliente->userAprobo->name }}</td>
                                            <td style="width: 10%;">{{ $cliente->fecha_aprobot }}</td>
                                            <td style="width: 5%;" class="text-center align-middle">
                                                @if($cliente->fecha_aprobo != null)  
                                                    <i class="text-body ci-security-check c-green"></i> 
                                                @else 
                                                    <i class="text-body ci-security-close c-red"></i>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-between">
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" id="adic_borrar_{{ $cliente->id }}" method="POST">
                                                    <a class="btn btn-sm-80 btn-success" href="{{ route('clientes.edit', [$cliente->id, $origen]) }}"><i class="text-body ci-edit-alt size-icon"></i> </a>
                                                    @if($cliente->fecha_aprobo != null)
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm-80" onclick="confirmarBorrar('{{ $cliente->id }}')">
                                                            <i class="text-body ci-trash size-icon"></i> 
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($clientes) == 0)
                                    <tr>
                                        <td class="text-center" colspan='10'>Hasta el momento no hay clientes nuevos para habilitar.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
                {!! $clientes->links() !!}
            </div>
        </div>
    </div>
@endsection
