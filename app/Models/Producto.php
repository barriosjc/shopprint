<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Producto
 *
 * @property $id
 * @property $nombre
 * @property $precio_compra
 * @property $precio_venta
 * @property $destacado
 * @property $habilitado
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $descuentos_id
 * @property $categorias_id
 *
 * @property Categoria $categoria
 * @property Descuento $descuento
 * @property PedidosDetalle[] $pedidosDetalles
 * @property ProductosAdicionalVal[] $productosAdicionalVals
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    use SoftDeletes;

    static $rules = [
		'nombre' => 'required|max:100',
        'detalle' => 'required|max:1000',
		'precio_compra' => 'required|numeric',
		'precio_venta' => 'required|numeric',
		'categorias_id' => 'required',
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','precio_compra','precio_venta','destacado','habilitado','descuentos_id','categorias_id',
                            'slug', 'detalle', 'cat_descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categorias_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function descuento()
    {
        return $this->hasOne('App\Models\Descuento', 'id', 'descuentos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidosDetalles()
    {
        return $this->hasMany('App\Models\PedidosDetalle', 'productos_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productosAdicionalVals()
    {
        return $this->hasMany('App\Models\ProductosAdicionalVal', 'productos_id', 'id');
    }

    public static function v_listado ($campo, $valor) {

        $resu = Producto::query()
        ->join('productos_fotos','productos_id', 'productos.id')
        ->select(['productos.*', 'path'])
        ->where($campo, $valor)
        ->where('principal', 1)
        ->whereNull('productos_fotos.deleted_at')
        ->orderby('orden', 'asc');
  
        return $resu;
    }

    public static function v_producto ($id) {
        $resu = Producto::query()
        ->join('categorias as c', 'c.id', 'productos.categorias_id')
        ->leftjoin('productos_restricciones','productos_restricciones.id', 'restricciones_id')
        ->leftjoin('productos_notas','productos_notas.id', 'notas_id')
        ->select(['c.descripcion as cat_descripcion', 'productos.*', 
                            'productos_restricciones.descripcion as restricciones_descrip',
                            'productos_restricciones.id as restricciones_id', 
                            'productos_notas.descripcion as notas_descrip'])
        ->where('productos.id', $id)
        ->whereNull('productos_notas.deleted_at')
        ->whereNull('productos_restricciones.deleted_at');

        return $resu;
    }
}
