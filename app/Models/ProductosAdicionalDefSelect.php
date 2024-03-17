<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductosAdicionalDefSelect
 *
 * @property $id
 * @property $productos_id
 * @property $productos_adicionales_def_id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductosAdicionalDefSelect extends Model
{
    use SoftDeletes;

    protected $table = "productos_adicional_def_select";

    static $rules = [
		'productos_adicionales_def_id' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productos_id', 'productos_adicionales_def_id', 'descripcion', 'precio', 'costo'];

    public static function v_ProductosAdicionalDefSelect () {

      $resu = ProductosAdicionalDefSelect::query()
      ->join('productos_adicional_def','productos_adicional_def.id', 'productos_adicionales_def_id')
      ->select(['productos_adicional_def_select.*', 'definicion_descripcion'])
      ->whereNull('productos_adicional_def.deleted_at');

      return $resu;
    }
}
