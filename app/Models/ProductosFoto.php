<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductosFoto
 *
 * @property $id
 * @property $productos_id
 * @property $path
 * @property $principal
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductosFoto extends Model
{
    use SoftDeletes;

        /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'productos_fotos';

    static $rules = [
		'productos_id' => 'required',
		'path' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productos_id','path','principal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'productos_id');
    }
    

}
