<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $users_id
 * @property string $forma_pago
 * @property string $tipo_envio
 * @property string $costo_envio
 * @property int $estado
 * @property string $stripe_id
 * @property float $total_descuento* 
 * @property string $fecha_entrega
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ordenes_compras extends Model
{
    protected $perPage = 5;
    /**
     * @var array
     */
    protected $fillable = ['users_id', 'forma_pago', 'tipo_envio', 'costo_envio', 
    'estado', 'stripe_id', 'total_descuento', 'fecha_entrega', 'estados_id_int',
    'total', 'created_at', 'updated_at', 'deleted_at'];

    public function getCreatedAtAttribute($value)
    {
        $resu = '';
        if (!empty($value)) {
            $resu = date('m/d/y', strtotime($value));
        }

        return $resu;
    }

    public function getFechaEntregaAtAttribute($value)
    {
        $resu = '';
        if (!empty($value)) {
            $resu = date('m/d/y', strtotime($value));
        }

        return $resu;
    }
    public static function v_orden_compra($orden_id) {

        $resu = ordenes_compras::query()
        ->join('users','users.id', 'ordenes_compras.users_id')
        ->join('clientes', 'clientes.user_id', 'users.id')
        ->select(['ordenes_compras.*', 
        'first_name', 'clientes.last_name', 'phone', 'users_id_aprobo', 'users.email', 
        'factor_envio', 'country', 'state', 'zipcode', 'address1', 'address2', 'company', 'website', 'taxid'])
        ->where( 'ordenes_compras.id', $orden_id)
        ->orderby('ordenes_compras.id', 'asc');
        
        return $resu;
    }

    public static function v_ordenes_compras_front($users_id) {

        $resu = ordenes_compras::query()
        ->join('users','users.id', 'ordenes_compras.users_id')
        ->join('clientes', 'clientes.user_id', 'users.id')
        ->join('parametros', 'parametros.id', 'estados_id')
        ->select(['ordenes_compras.*', 
            'parametros.valor as oc_estado','first_name', 'clientes.last_name', 'phone', 'users_id_aprobo', 'users.email', 
            'factor_envio', 'country', 'state', 'zipcode', 'address1', 'address2', 'company', 'website', 'taxid',
            DB::raw('CASE WHEN ordenes_compras.forma_pago = "forma_pago_tarjeta" THEN "Credit (Stripe)" 
                                WHEN ordenes_compras.forma_pago = "forma_pago_ctacte" THEN "Check"
                                ELSE "Saving Account" END AS forma_pago_desc'),
            DB::raw('CASE WHEN ordenes_compras.tipo_envio = 1 THEN "Envio a domicilio" 
            ELSE "Retiro en local" END AS tipo_envio_desc')
        ])
        ->where( 'ordenes_compras.users_id', $users_id)
        ->orderby('ordenes_compras.id', 'asc');
        
        return $resu;
    }
    

    public static function v_ordenes_compras() {

        $resu = ordenes_compras::query()
        ->join('users','users.id', 'ordenes_compras.users_id')
        ->join('clientes', 'clientes.user_id', 'users.id')
        ->leftjoin('parametros as par_oc', 'par_oc.id', 'estados_id')
        ->select(['ordenes_compras.*', 
            'par_oc.valor as oc_estado', 'first_name', 'clientes.last_name', 'phone', 'users_id_aprobo', 'users.email', 
            'factor_envio', 'country', 'state', 'zipcode', 'address1', 'address2', 'company', 'website', 'taxid',
            DB::raw('CASE WHEN ordenes_compras.forma_pago = "forma_pago_tarjeta" THEN "Credit (Stripe)" 
                                WHEN ordenes_compras.forma_pago = "forma_pago_ctacte" THEN "Check"
                                ELSE "Saving Account" END AS forma_pago_desc'),
            DB::raw('CASE WHEN ordenes_compras.tipo_envio = 1 THEN "Envio a domicilio" 
            ELSE "Retiro en local" END AS tipo_envio_desc')
        ])
        ->orderby('ordenes_compras.id', 'asc');
        
        return $resu;
    }
}
