<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 't_roles';
    //protected $dateFormat = 'Ymd H:i:s';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rolename',
        'guard_name', //lowercase
        'description', // optional
        'level' //optional, set to 1 by default
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'description',
        'guard_name',
        'level',
        'roleflag'
    ];

    protected $appends = ['roleflag'];

    public function getRoleflagAttribute()
    {
        //return date_diff(date_create($this->date_vigency), date_create('now'))->d;
        //https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
        //return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
        if ($this->status) {
            return 'Activo';
        } else {
            return 'Suspendido';
        }
    }

    public static function getRoleOpciones($role_level)
    {
        $opcionesRole = array();
        $opcionesRole[NULL] = 'Seleccione rol';
        $lista = Role::where('id', '>=', $role_level)->select('id', 'rolename')->get();
        foreach ($lista as $registro) {
            $opcionesRole[$registro->id] = $registro->rolename;
        }
        return $opcionesRole;
    }

    public static function all_by_name($rolename)
    {
        $model = Role::where('rolename', '=', $rolename)->first();
        return $model;
    }

    public static function all_filter($field, $value)
    {
        $model = Role::where($field, '=', $value)->get();
        return $model;
    }

    public static function findRecord($id)
    {
        $model = Role::findOrFail('id', $id);
        return $model;
    }

    public static function insertRecord($registro)
    {

        $model = new Role();
        $model->fill($registro);
        $model->save($registro);

        return $model;
    }

    public static function updateRecord($registro)
    {
        $model = Role::findOrFail('id', $registro['id']);
        $model->fill($registro);
        $model->save($registro);
        return $model;
    }

    public function menus()
    {
        return $this
            ->belongsToMany(Menu::class, 't_roles_menus', 'menu_id', 'role_id');
        //->belongsToMany('App\Models\Menu', 't_menu_role', 'menu_id', 'role_id');
    }

    public function users()
    {
        /*return $this
            ->belongsToMany(User::class)->get();*/
        return $this
            ->belongsToMany('App\Models\Role', 't_role_user', 'user_id', 'role_id');
    }
}
