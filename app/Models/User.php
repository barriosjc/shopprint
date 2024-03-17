<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function cliente()
    // {
    //     return $this->hasOne(Cliente::class);
    // }
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'user_id');
    }

    // Relación uno a uno con el modelo Cliente (user_id_aprobo)
    public function clienteAprobo()
    {
        return $this->hasOne(Cliente::class, 'user_id_aprobo');
    }

    public static function v_empleados () {

        // $resu = User::query()
        // ->join('model_has_roles as mr','mr.model_id', 'users.id')
        // ->join('roles as r', 'r.id', 'mr.role_id')
        // ->select(['users.*', 'r.name'])
        // ->where('role_id','>',1)
        // ->orderby('users.name', 'asc');
  
        $resu = User::query()
        ->leftJoin('model_has_roles as mr', function ($join) {
            $join->on('mr.model_id', '=', 'users.id')
                ->where('mr.role_id', '>', 1);
        })
        ->leftJoin('roles as r', 'r.id', '=', 'mr.role_id')
        ->leftJoin('clientes as c', 'c.user_id', '=', 'users.id')
        ->whereNull('c.id')
        ->groupBy('users.id')
        ->orderBy('users.name', 'asc')
        ->select(['users.*', DB::raw('GROUP_CONCAT(r.name ORDER BY r.name ASC) as roles')]);
    
        return $resu;
    
    }
}
