<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $ordenes_compras_det_id
 * @property string $descripcion
 * @property string $valor
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ordenes_compras_det_adic extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ordenes_compras_det_adic';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['ordenes_compras_det_id', 'descripcion', 'valor', 'created_at', 'updated_at', 'deleted_at'];
}
