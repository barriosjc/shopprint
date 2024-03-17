<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $ordenes_compras_id
 * @property int $productos_id
 * @property int $cantidad
 * @property int $descuento_id
 * @property float $precio
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ordenes_compras_det extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ordenes_compras_det';

    public function getCreatedAtAttribute($value)
    {
        $resu = '';
        if (!empty($value)) {
            $resu = date('m/d/y', strtotime($value));
        }

        return $resu;
    }

    /**
     * @var array
     */
    protected $fillable = [
                            'ordenes_compras_id', 'productos_id', 'cantidad', 'precio', 'descuento_id', 'obs', 'prod_type', 
                            'prod_option', 'width_feet', 'width_inches', 'height_feet', 'height_inches', 'path_print', 'path_cut', 
                            'cli_shop', 'cli_po', 'estados_id', 'estados_id_int', 'codigo'
                        ];

    // public static function v_ordenes_compras_det ($campo, $valor) {

    //     $resu = ordenes_compras_det::query()
    //     ->join('productos','productos.id', 'ordenes_compras_det.productos_id')
    //     ->join('categorias', 'categorias.id', 'productos.categorias_id')
    //     ->join('productos_fotos','productos_fotos.productos_id', 'ordenes_compras_det.productos_id')
    //     ->join('parametros', 'parametros.id', 'ordenes_compras_det.estados_id')
    //     ->leftjoin('modificadores_tipos', 'modificadores_tipos.productos_id', 'productos.id')
    //     ->leftjoin('modificadores_tipos', 'modificadores_tipos.id' , 'ordenes_compras_det.prod_type')
    //     ->leftjoin('modificadores_opciones', 'modificadores_opciones.modif_tipos_id', 'modificadores_tipos.id')
    //     ->leftjoin('modificadores_opciones', 'modificadores_opciones.id', 'ordenes_compras_det.prod_option')
    //     ->select(['ordenes_compras_det.*', 'categorias.descripcion as categoria_desc',
    //         'modificadores_tipos.descripcion as tipos_desc', 'modificadores_opciones.descripcion as opciones_desc',
    //         'parametros.valor as det_estado', 'productos_fotos.path', 'productos.nombre', 'productos.detalle'])
    //     ->where( $campo, $valor)
    //     ->where('principal', 1)
    //     ->orderby('ordenes_compras_det.id', 'asc')
    //     ->whereNull('productos_fotos.deleted_at');

    //     return $resu;
    // }

    public static function v_ordenes_compras_det($campo, $valor) {

        $resu = ordenes_compras_det::query()
            ->join('ordenes_compras as oc', 'oc.id', 'ordenes_compras_det.ordenes_compras_id')
            ->join('productos', 'productos.id', '=', 'ordenes_compras_det.productos_id')
            ->join('categorias', 'categorias.id', '=', 'productos.categorias_id')
            ->join('productos_fotos', 'productos_fotos.productos_id', '=', 'ordenes_compras_det.productos_id')
            ->join('parametros', 'parametros.id', '=', 'ordenes_compras_det.estados_id')        
            ->leftjoin('parametros as par_int', 'par_int.id', 'estados_id_int')
            ->leftJoin('modificadores_tipos', function ($join) {
                $join->on('modificadores_tipos.productos_id', '=', 'productos.id')
                     ->where('modificadores_tipos.id', '=', DB::raw('ordenes_compras_det.prod_type'));
            })
            ->leftJoin('modificadores_opciones', function ($join) {
                $join->on('modificadores_opciones.modif_tipos_id', '=', 'modificadores_tipos.id')
                     ->where('modificadores_opciones.id', '=', DB::raw('ordenes_compras_det.prod_option'));
            })
            ->leftJoin('tickets_det', 'tickets_det.ordenes_compras_det_id', '=', 'ordenes_compras_det.id')
            ->select(['ordenes_compras_det.*', 'categorias.descripcion as categoria_desc', 'par_int.valor as int_estado',
                    'modificadores_tipos.descripcion as tipos_desc', 'modificadores_opciones.descripcion as opciones_desc',
                    'parametros.valor as det_estado', 'productos_fotos.path', 'productos.nombre', 'productos.detalle',
                    DB::raw('COUNT(tickets_det.id) as cant_msg')])
            ->where( $campo, $valor)
            ->where('productos_fotos.principal', '=', 1)
            ->whereNull('productos_fotos.deleted_at')
            ->orderBy('ordenes_compras_det.id', 'asc')
            ->groupBy('ordenes_compras_det.id', 'productos_fotos.path');
    
        return $resu;
    }
    

    public static function v_ordenes_detalle($campo, $valor) {

        $resu = ordenes_compras_det::query()
            ->join('productos', 'productos.id', '=', 'ordenes_compras_det.productos_id')
            ->join('categorias', 'categorias.id', '=', 'productos.categorias_id')
            ->join('ordenes_compras', 'ordenes_compras.id', 'ordenes_compras_det.ordenes_compras_id')
            ->join('users','users.id', 'ordenes_compras.users_id')
            ->join('clientes', 'clientes.user_id', 'users.id')
            ->select(['ordenes_compras_det.*', 'categorias.descripcion as categoria_desc',
                    'productos.nombre', 'productos.detalle',
                    'ordenes_compras.id as orden_id' , 'clientes.company'])
            ->where( $campo, $valor);
    
        return $resu;
    }
}
