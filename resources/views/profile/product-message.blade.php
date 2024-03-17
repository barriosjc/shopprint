@extends('profile.main')

@section('p-content')
    <section class="col-lg-12">
        <!-- Orders list-->
        <!-- Light table with striped rows -->
        <div class="table-responsive">
            <section class="col-lg-12">
                <!-- Ticket details (visible on mobile)-->
                @foreach ($tickets as $item)
                    @if ($item->cli_imp === 'i')
                    <div class="d-flex align-items-start border-bottom pt-4 mt-4 ps-5">
                    @else
                    <div class="d-flex align-items-start pt-4 mt-4 pb-4 border-bottom">
                    @endif
                        <div class="ps-3">
                            <h6 class="fs-md mb-2">{{ $item->name }}</h6>
                            <p class="fs-md mb-1">{{ $item->insidente }}</p><span class="fs-ms text-muted"><i
                                    class="ci-time align-middle me-2"></i>
                                {{ $item->created_at }}</span>

                            @if ($item->cut_path)
                                <span>CUT FILE: </span>  
                                {{-- para crear el nombre de archivo en base a lo pedido                           --}}
                                @php
                                    $cut_name_parts = [
                                        'cut',
                                        $item->cli_id,
                                        $item->cat_desc,
                                        $item->nombre,
                                        ($item->width_feet > 0 ? $item->width_feet : ""),
                                        ($item->width_inches > 0 ? $item->width_inches : ""),
                                        ($item->height_feet > 0 ? $item->height_feet : ""),
                                        ($item->height_inches > 0 ? $item->height_inches : "")
                                    ];
                                
                                    $cut_name_parts = array_filter($cut_name_parts);
                                    $original_extension = explode(".", $item->cut_path);
                                    $ext = $original_extension[1];
                                    $cut_name = implode("_", $cut_name_parts);
                                    $cut_name = $cut_name.".".$ext;
                                @endphp
                                <a class="btn btn-sm-80 btn-secondary btn-icon"
                                    href="{{ asset('storage/clientes/' . $item->cut_path) }}" 
                                    download="{{$cut_name}}">
                                    <i class="text-body ci-download"></i>
                                </a>
                            @endif
                            @if ($item->print_path)
                                <span>PRINT FILE: </span>
                                @php
                                    $print_name_parts = [
                                        'print',
                                        $item->cli_id,
                                        $item->cat_desc,
                                        $item->nombre,
                                        ($item->width_feet > 0 ? $item->width_feet : ""),
                                        ($item->width_inches > 0 ? $item->width_inches : ""),
                                        ($item->height_feet > 0 ? $item->height_feet : ""),
                                        ($item->height_inches > 0 ? $item->height_inches : "")
                                    ];
                                
                                    $print_name_parts = array_filter($print_name_parts);
                                    $original_extension = explode(".", $item->print_path);
                                    $ext = $original_extension[1];
                                    $print_name = implode("_", $print_name_parts);
                                    $print_name = $print_name.".".$ext;
                                @endphp
                                <a class="btn btn-sm-80 btn-secondary btn-icon"
                                    href="{{ asset('storage/clientes/' . $item->print_path) }}" 
                                    download="{{$print_name}}">
                                    <i class="text-body ci-download"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
                @if( $tickets->count() == 0 )
                    <h3 class="h5 mt-2 pt-4 pb-2">Aun no se han ingresado mensajes</h3>
                    <hr>
                @endif
                <!-- Leave message-->
                <form method="POST" action="{{ route('tikets.save') }}" role="form" enctype="multipart/form-data">
                    {{-- {{ method_field('PATCH') }} --}}
                    @csrf
                    <input type="hidden" name="ordenes_compras_det_id" value="{{ $detalle_id }}">
                    <h3 class="h5 mt-2 pt-4 pb-2">Leave a Message</h3>
                    <div class="mb-3">
                        <textarea class="form-control" rows="8" placeholder="Write your message here..." name='mensaje' required></textarea>
                        <div class="invalid-tooltip">Please write the message!</div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="formFile" class="form-label">PRINT FILE:</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="print" name="print">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="formFile" class="form-label">CUT FILE:</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="cut" name="cut">
                            </div>
                        </div>
                        {{-- <div class="d-flex flex-wrap justify-content-between align-items-center"> --}}
                        <div class="col-6">
                            <button class="btn btn-primary my-2" type="submit">Submit message</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </section>
@endsection
