<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property integer $users_id_aprobo
 * @property string $fecha_aprobo
 * @property string $email
 * @property string $form_path
 * @property int $forma_pago_tarjeta
 * @property int $forma_pago_cheque
 * @property int $forma_pago_ctacte
 * @property int $deshabilitado
 * @property float $factor_envio
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zipcode
 * @property string $address1
 * @property string $address2
 * @property string $company
 * @property string $wesite
 * @property string $taxid
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at

 */
class Cliente extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'clientes';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'first_name', 'last_name', 'phone', 'users_id_aprobo', 'fecha_aprobo', 'email', 
        'form_path', 'forma_pago_tarjeta', 'forma_pago_cheque', 'forma_pago_ctacte', 'deshabilitado', 'factor_envio', 
        'country', 'state', 'zipcode', 'address1', 'address2', 'company', 'website', 'taxid', 'about_us',
        'created_at', 'updated_at', 'deleted_at', 'city'];

    public function getFechaAprobotAttribute()
    {
        $resu = $this->fecha_aprobo;
        if (!empty($resu)) {
            $resu = date('m/d/y', strtotime($resu));
        }

        return $resu;
    }
    
    public function getFechaAproboyAttribute()
    {
        $resu = $this->fecha_aprobo;
        if (!empty($resu)) {
            $resu = substr($resu,0,4)."-".substr($resu,5,2)."-".substr($resu,8,2);
            //$resu = date('Y-m-d', strtotime($resu));
        }

        return $resu;
    }  
    
    /**
     * Define la relación uno a uno con el modelo User.
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function user_aprob()
    // {
    //     return $this->belongsTo(User::class, 'users_id_aprobo');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación uno a uno con el modelo User (user_id_aprobo)
    public function userAprobo()
    {
        return $this->belongsTo(User::class, 'users_id_aprobo');
    }
    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function clientesDatosFacturacions()
    // {
    //     return $this->hasMany('App\ClientesDatosFacturacion', 'clientes_id');
    // }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function clientesSectors()
    // {
    //     return $this->hasMany('App\ClientesSector', 'clientes_id');
    // }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function pedidos()
    // {
    //     return $this->hasMany('App\Pedido', 'clientes_id');
    // }
}
