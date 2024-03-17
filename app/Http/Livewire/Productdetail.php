<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Descuento;
use App\Models\ProductosFoto;
use App\Models\ProductosNota;
use Livewire\WithFileUploads;
use Livewire\widthFileUploads;
use App\Models\ModificadoresTipo;
use App\Models\ModificadoresOpcione;
use App\Models\ProductosAdicionalDef;
use App\Http\Controllers\UtilesController;
use App\Models\ProductosAdicionalDefSelect;

class Productdetail extends Component
{
    use WithFileUploads;
    public $productoId;
    public $producto;
    public $categorias;
    public $descuento;
    public $descuento_tipo;
    public $productos_adicional_def;
    public $productos_fotos;
    public $tipos = [];
    public $tipos_id;
    public $opciones = [];
    public $opciones_id;
    public $productos_adicional_def_select;
    public $width_inches = 0;
    public $width_feet = 0;
    public $height_inches = 0;
    public $height_feet = 0;
    public $adic = [];
    public $unitprice = 0;
    public $precio_unitario = 0;
    public $customerprice = 0;
    public $precio_venta;
    public $quantity = 1;
    public $error = [];
    public $restricciones_id;
    public $notas_id;
    public $nota;
    public $nota_ini;
    public $sel_opciones = [];
    public $cant_tipos = 0;

    public $error_width = '';
    public $error_inches = '';
    public $error_height = '';

    protected $listeners = ['valorAntesDeModificar'];

    public function mount($id)
    {
        $this->productoId = $id;
        $this->producto = Producto::v_producto($this->productoId)->first();
        $this->categorias = Categoria::find($this->producto->categorias_id);
        $desc1 = UtilesController::traeDescuentoProd($id);
        // $desc2 = array_filter($desc1, function ($key) use ($id) {
        //     return $key == $id;}, ARRAY_FILTER_USE_KEY);
        // dd($desc1, $id);
        if($desc1 != []) {
            $this->descuento = $desc1[$id];
            $this->cambioPrecio();
        }

        // dd($this->descuento);
        $this->opciones = ModificadoresOpcione::v_modificadoresOpciones()->where('productos_id', $this->productoId)->get();
        $this->tipos = ModificadoresTipo::where('productos_id', $this->productoId)->get();
        $this->cant_tipos = $this->tipos->count();
        $this->notas_id = $this->producto->notas_id;
        $nota = ProductosNota::where("id", $this->producto->notas_id)->first();
        if ($nota) {
            $this->nota = $nota->descripcion;
        }

        $this->nota_ini = $this->nota;
        // dd($this->descuento);
    }

    protected $rules = [
        'opciones.*' => 'required', // Aquí puedes ajustar la regla según tus necesidades
    ];

    public function render()
    {
        $this->producto = Producto::v_producto($this->productoId)->first();
        $this->productos_adicional_def = ProductosAdicionalDef::where('productos_id', $this->productoId)->get();
        //$productos_adicional_val = productos_adicional_val::where('productos_id', $this->productoId)->get();
        $this->productos_adicional_def_select = ProductosAdicionalDefSelect::where('productos_id', $this->productoId)->get();
        $this->productos_fotos = ProductosFoto::where('productos_id', $this->productoId)->get();
        // $this->tipos = ModificadoresTipo::where('productos_id',$this->productoId)->get();
        $this->precio_venta = $this->producto->precio_venta;
        $this->restricciones_id = $this->producto->restricciones_id;

        // $this->productoId = $this->producto->id;
        if ($this->unitprice === 0) {
            $this->unitprice = $this->producto->precio_venta;
        }


        // foreach ($this->tipos as $tipo) {
        //     $this->opciones[$tipo->id] = null;
        // }

        return view('livewire.productdetail');
    }

    // public function cargaOpciones()
    // {
    //     if ($this->tipos_id) {
    //         $this->opciones = ModificadoresOpcione::where('modif_tipos_id', $this->tipos_id)->get();
    //     } else {
    //         $this->opciones = [];
    //     }
    // }

    public function calculoTotal()
    {
        if ($this->height_inches > 12 || $this->width_inches > 12) {
            $error = "medidas|| Los valores de pulgadas deben estar entre 0 y 11.";
            // Manejar la excepción
            $resu = explode('||', $error);
            $this->error['item'] = $resu[0];
            $this->error['msg'] = $resu[1];
        } else {

            $this->width_feet = $this->width_feet == '' ? 0 : $this->width_feet;
            $this->width_inches = $this->width_inches == '' ? 0 : $this->width_inches;
            $this->height_feet = $this->height_feet == '' ? 0 : $this->height_feet;
            $this->height_inches = $this->height_inches == '' ? 0 : $this->height_inches;

            $this->quantity = $this->quantity == '' ? 0 : $this->quantity;
            $sup =  floatval($this->width_feet . "." . $this->width_inches) * floatval($this->height_feet . "." . $this->height_inches);

            //validacion de notas
            if ($this->notas_id) {
                if ($this->notas_id == 1) {
                    if ($sup < 1) {
                        $sup = 1;
                    }
                }
            }
            $this->unitprice = number_format($this->precio_unitario * $sup, 2,null,'');
// dd($this->unitprice , $this->quantity);     
            $precio = $this->unitprice * $this->quantity;

            $this->customerprice = number_format($precio, 2);
        }
    }

    public function cambioPrecio()
    {
        //valida si se cargan medidas por default y los pone en los inputs de medidas
        $this->cargarMedidasDefault();

        $val_adic = 0;
        $val_opcion = 0;
        foreach ($this->adic as $adic) {
            $array = explode("||", $adic);
            if (isset($array[2])) {
                $val_adic = $val_adic + floatval($array[2]);
            }
        }

        // if ($this->opciones_id) {
        //     $array = explode("||", $this->opciones_id);
        //     if (isset($array[2])){
        //         $val_opcion = $array[2] == "" ? 0 : floatval($array[2]);
        //     } 
        // }

        if (count($this->sel_opciones) > 0) {
            foreach ($this->sel_opciones as $opcion) {
                $array = explode("||", $opcion);
                if (isset($array[3])) {
                    $val_opcion = $val_opcion + ($array[3] == "" ? 0 : floatval($array[3]));
                }
            }
        }

        $precio_vta = floatval($this->precio_venta);
        $desc = empty($this->descuento) ? 0 : $this->descuento; 
        $precio = number_format(($precio_vta + $val_adic + $val_opcion) * ((100 - $desc) / 100), 2);
        $this->precio_unitario = $precio;
        // dd($precio_vta , $val_adic , $val_opcion, $this->sel_opciones,$this->precio_unitario);
        $this->calculoTotal();

    }

    public function cargarMedidasDefault(){
        $select = UtilesController::traerParamValores("selec_%");
        foreach($this->adic as $item) {
            if(isset(explode("||", $item)[3])){
                foreach($select as $item_sel){
                    // dd(explode("||", $item), explode("||", $item)[3] , $item_sel, json_decode($item_sel, true));
                    $arr_select = json_decode($item_sel, true);
                    $id_select = substr($arr_select['campo'],6);
                    // dd($id_select, explode("||", $item)[3]);
                    if(explode("||", $item)[3] == $id_select){
                        $medidas = explode(",", $arr_select['valor']);
                        $this->width_feet = $medidas[0] / 12;
                        $this->width_inches = $medidas[0] % 12; //calcula el resto
                        $this->height_feet = $medidas[1] / 12;
                        $this->height_inches = $medidas[1] % 12; //calcula el resto
                    }
                }
            }
        }
        //$producto = ProductosAdicionalDefSelect::where('productos_id',$this->productoId);





    }

    public function guardarDatos()
    {
        $valido = [];
        //-----------------------------------------------------------------
        // antes de guardar, validamos los valores ingresados
        if ($this->restricciones_id > 0) {
            $valido = $this->validarRestricciones();
        }

        if ($valido == []) {

            $tmppath = '';
            if (isset($this->productos_fotos[0])) {
                $tmppath = $this->productos_fotos[0]->path;
            }
            //si no lo cargo aca, producto es el model y no la vista
            $this->producto = Producto::v_producto($this->productoId)->first();
            // dd($this->producto);
            \Cart::add(array(
                'id' => $this->producto->id,
                'name' => $this->producto->cat_descripcion . " / " . $this->producto->nombre,
                'price' => $this->unitprice,
                'quantity' => $this->quantity,
                'attributes' => array(
                    'descuento' => $this->descuento,
                    'descuento_tipo' => $this->descuento_tipo,
                    'categorias_id' => $this->producto->categorias_id,
                    'productos_id' => $this->producto->id,
                    'options' => $this->sel_opciones,
                    'image' => $tmppath,
                    'slug' => $this->producto->detalle,
                    'aditionals' => $this->adic,
                    'width_feet' => $this->width_feet,
                    'width_feet' => $this->width_feet,
                    'width_inches' => $this->width_inches,
                    'height_feet' => $this->height_feet,
                    'height_inches' => $this->height_inches,
                    'total' => $this->customerprice,
                )
            ));

            $nota = '';
            // if($this->notas_id > 0) {
            //     $nota = $this->validarNotas($this->notas_id);
            // }

            $msg = 'Item Agregado a su Carrito!' .
                '<br/>' . '<br/>' .
                $nota;

            return redirect()->route('productos.list', $this->categorias->id)->with('success_msg', $msg);
        }

        // $cartCollection = \Cart::getContent();
        // dd($cartCollection);
    }

    public function validarNotas($nota_id)
    {
        $resu = '';
        try {
            if ($nota_id == 1) {
                if ($this->height_inches >= 10 || $this->width_inches >= 10) {
                    $desc = ProductosNota::where("id", $nota_id)->first();
                    // si se borra el id y se crea nueva nota hay que modificar codigo
                    throw new Exception($desc->descripcion);
                }
            }

            if ($nota_id == 10) {
                $desc = ProductosNota::where("id", $nota_id)->first();
                // si se borra el id y se crea nueva nota hay que modificar codigo
                throw new Exception($desc->descripcion);
            }
        } catch (Exception $e) {
            // Manejar la excepción
            $resu = $e->getMessage();
        }

        return $resu;
    }

    public function validarRestricciones()
    {
        $this->error = [];
        $this->error_width = '';
        $this->error_inches = '';
        $this->error_height = '';

        try {

            $arr_opciones = array_filter($this->sel_opciones);
            if (count($arr_opciones) < $this->cant_tipos) {
                throw new Exception("opciones||Es obligatorio seleccionar un item de cada una de las -- Opciones --.");
            }

            if ($this->quantity < 1) {
                throw new Exception("cantidad||Debe ingresar una cantidad mayor a 0 (cero).");
            }
            if ($this->height_inches > 12 || $this->width_inches > 12) {
                $this->error_inches = 'error-select';
                throw new Exception("medidas|| Los valores de pulgadas deben estar entre 0 y 11.||2,4");
            }
            if ($this->width_feet == 0 && $this->width_inches == 0) {
                $this->error_width = 'error-select';
                throw new Exception("medidas||Es obligatorio ingresar el ancho, en feet mas inches o uno de ellos.||1,2");
            }
            if ($this->height_feet == 0 && $this->height_inches == 0) {
                $this->error_height  = 'error-select';
                throw new Exception("medidas|| Es obligatorio ingresar el alto, feet y inches o uno de ellos.||2,4");
            }
            $width = $this->width_feet;
            $width = 12 * intval($width);
            $width = $width + intval($this->width_inches);
            $height = $this->height_feet;
            $height = 12 * intval($height);
            $height = $height + intval($this->height_inches);

            $opc_id = null;
            if ($this->sel_opciones) {
                foreach($this->sel_opciones as $arr) {
                    $array = explode("||", $arr);
                    if (isset($array[1])) {
                        $opc_id[] = $array[1];
                    }
                }
            }
            // Banners por debajo de los 12”x12” no pueden ser soldados.
            if ($this->restricciones_id == 1) {
                if (array_intersect($opc_id, [2, 3, 5, 6])) {
                    if ($width < 12) {
                        $this->error_width = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho no puede ser < 12 pulgadas, si algún lado esta soldado.");
                    }
                    if ($height < 12) {
                        $this->error_height  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el alto no puede ser < 12 pulgadas, si algún lado esta soldado.");
                    }
                }
            }

            // canvas, Una de las medidas no puede superar los 74"
            if ($this->restricciones_id == 2) {
                if ($this->productoId == 13) {
                    if ($width > 74) {
                        $this->error_width  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 74 pulgadas.");
                    }
                    if ($height > 74) {
                        $this->error_height  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 74 pulgadas.");
                    }
                }
            }

            // poster, Una de las medidas no puede superar los 52"
            if ($this->restricciones_id == 3) {
                if ($this->productoId == 14) {
                    if ($height > 52) {
                        $this->error_height  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 52 pulgadas.");
                    }
                    if ($width > 52 ) {
                        $this->error_width  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 52 pulgadas.");
                    }
                }
            }

            // producto mesh, Una de las medidas no puede superar los 16"
            if ($this->restricciones_id == 4) {
                if ($this->productoId == 46) {
                    if ($height > 16) {
                         $this->error_height  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 16 pulgadas.");
                    }
                    if ($width > 16) {
                        $this->error_width  = 'error-select';
                       throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 16 pulgadas.");
                   }
                }
            }

            // categoria ADHESIVE, Una de las medidas no puede superar los 57".
            if ($this->restricciones_id == 5) {
                if ($this->categorias->id == 4) {
                    if ($height > 57) {
                        $this->error_height  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 57 pulgadas.");
                    }
                    if ($width > 57) {
                        $this->error_width  = 'error-select';
                        throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 57 pulgadas.");
                    }
                    // si lleva corte no puede ser < 3
                    if (array_intersect($opc_id, [19, 20])) {
                        if ($height < 3) {
                            $this->error_height  = 'error-select';
                            throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 3 pulgadas si se entrega cortado.");
                        }
                        if ($width < 3) {
                            $this->error_width  = 'error-select';
                            throw new Exception("medidas||Error de restricción, el ancho o alta no puede ser > de 3 pulgadas si se entrega cortado.");
                        }
                    }
                }
            }

            // producto .030 MAGNETIC MATERIAL, La maxima medida que el usuario puede elegir es de  24X96".
            if ($this->restricciones_id == 6) {
                if ($this->productoId == 15) {
                    if (($width > 24 || $height > 96) || ($width > 96 || $height > 24)) {
                        $this->error_height  = 'error-select';
                        $this->error_width  = 'error-select';
                        throw new Exception("medidas||Error de restricción, las medidas no pueden ser mayor a 24 x 96 pulgadas.");
                    }
                }
            }

            // La maxima medida que el usuario puede elegir es de  24X96".
            if ($this->restricciones_id == 6) {
                if ($this->productoId == 15) {       //cambiar a magnetic, el id
                    if (array_intersect($opc_id, [19, 20])) {
                        if ($width < 3) {
                            $this->error_width  = 'error-select';
                            throw new Exception("medidas||Error de restricción, el ancho no puede ser < 3 pulgadas, si requiere corte.");
                        }
                        if ($height < 3) {
                            $this->error_height  = 'error-select';
                            throw new Exception("medidas||Error de restricción, el alto no puede ser < 3 pulgadas, si requiere corte.");
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // Manejar la excepción
            $resu = explode('||', $e->getMessage());
            //dd($e->getMessage());
            $this->error['item'] = $resu[0];
            $this->error['msg'] = $resu[1];
            $this->error['tag'] = isset($resu[2]) ? $resu[2] : null;
        }

        return $this->error;

    }
}
