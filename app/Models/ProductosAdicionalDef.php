<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductosAdicionalDef
 *
 * @property $id
 * @property $productos_id
 * @property $definicion_descripcion
 * @property $definicion_tipo
 * @property $definicion_largo
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductosAdicionalDef extends Model
{
    use SoftDeletes;

    protected $table = "productos_adicional_def";

    static $rules = [
		'productos_id' => 'required',
		'definicion_descripcion' => 'required',
		'definicion_tipo' => 'required',
		'definicion_largo' => 'required',
    'cant_columnas' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productos_id','definicion_descripcion','definicion_tipo','definicion_largo', 
                          'cant_columnas'];

    public static function v_ProductosAdicionalDef () {

      $resu = ProductosAdicionalDef::query()
      ->join('productos','productos.id', 'productos_id')
      ->select(['productos_adicional_def.*', 'nombre'])
      ->whereNull('productos.deleted_at');

      return $resu;
  }

}
