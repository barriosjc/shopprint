<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ModificadoresOpcione
 *
 * @property $id
 * @property $modif_tipos_id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ModificadoresOpcione extends Model
{
    use SoftDeletes;

    protected $table = "modificadores_opciones";

    static $rules = [
		'modif_tipos_id' => 'required',
		'descripcion' => 'required',
    'costo' => 'required',
    'precio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['modif_tipos_id','descripcion','costo','precio'];

    public function modificadoresTipo()
    {
        return $this->belongsTo(ModificadoresTipo::class, 'tipos_id', 'id');
    }

    public static function v_modificadoresOpciones() {

      $resu = ModificadoresOpcione::query()
        ->join('modificadores_tipos as mt','mt.id', 'modif_tipos_id')
        ->select(['modificadores_opciones.*', 'mt.descripcion as tipos_descripcion', 'mt.productos_id'])
        ->orderby('modificadores_opciones.descripcion', 'asc');
      
      return $resu;
   }

}
