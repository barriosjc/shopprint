<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $productos_id
 * @property string $adicional_descripcion
 * @property string $adicional_valor
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Producto $producto
 */
class productos_adicional_val extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'productos_adicional_val';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['productos_id', 'adicional_descripcion', 'adicional_valor', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo('App\Producto', 'productos_id');
    }
}
