<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ModificadoresTipo
 *
 * @property $id
 * @property $productos_id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ModificadoresTipo extends Model
{
    use SoftDeletes;
    
    protected $table = "modificadores_tipos";

    static $rules = [
		'productos_id' => 'required',
		'tipos_descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productos_id', 'descripcion'];

    public function opciones()
    {
        return $this->hasMany(ModificadoresOpcione::class);
    }

    public static function v_modificadoresTipos() {

      $resu = ModificadoresTipo::query()
        ->join('productos','productos.id', 'productos_id')
        ->select(['modificadores_tipos.*', 'nombre'])
        ->orderby('descripcion', 'asc');
      
      return $resu;
   }

   public static function v_opciones()
   {
      $resu = ModificadoresTipo::query()
        ->join('modificadores_opciones as mo', 'mo.modif_tipos_id', 'modificadores_tipos.id')
        ->select('modificadores_tipos.*', 'mo.descripcion as opc_descripcion');

        return $resu;
    }
}
