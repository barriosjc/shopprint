<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Descuento
 *
 * @property $id
 * @property $descripcion
 * @property $porcentaje
 * @property $orden
 * @property $vigencia_desde
 * @property $vigencia_hasta
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Cliente[] $clientes
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Descuento extends Model
{
    use SoftDeletes;

    protected $perPage = 5;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clientes_id', 'categorias_id', 'productos_id', 'users_id',
        'prioridad','porcentaje','cupon','vigencia_desde','vigencia_hasta'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente', 'descuentos_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'descuentos_id', 'id');
    }
    
    // atributos formateados
    public function getCreatedAtAttribute($value)
    {
        $resu = '';
        if (!empty($value)) {
            $resu = date('m/d/Y', strtotime($value));
        }

        return $resu;
    }

    public function getVigenciaDesdeAttribute($value)
    {
        $resu = '';
        if (!empty($value)) {
            $resu = date('m/d/Y', strtotime($value));
        }

        return $resu;
    }
    
    public function getVigenciaHastaAttribute($value)
    {
        $resu = '';
        if (!empty($value)) {
            $resu = date('m/d/Y', strtotime($value));
        }

        return $resu;
    }

    public static function v_descuentos() {

        $resu = descuento::query()
            ->join('users', 'users.id', '=', 'descuentos.users_id')
            ->leftjoin('categorias', 'categorias.id', 'descuentos.categorias_id')
            ->leftjoin('productos', 'productos.id', 'descuentos.productos_id')
            ->leftjoin('clientes','clientes.id', 'descuentos.clientes_id')
            ->select(['descuentos.*', 'categorias.descripcion as categoria_desc',
                    'productos.nombre', 'productos.detalle',
                    'users.name', 'users.last_name' , 'clientes.company']);
    
        return $resu;
    }
}
