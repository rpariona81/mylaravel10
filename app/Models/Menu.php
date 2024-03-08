<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 't_menus';
    //protected $dateFormat = 'Ymd H:i:s';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu',
        'controller', //lowercase
        'action', // optional
        'orden', //optional, set to 1 by default
        'url', //optional, set to 1 by default
        'menu_type',
        'icono' //optional, set to 1 by default
    ];

    public static function getMenuOpciones()
    {
        $opcionesMenu = array();
        $opcionesMenu[0] = 'Seleccione menu';
        $lista = Menu::select('id', 'menu')->where('status', '=', 1)->get();
        foreach ($lista as $registro) {
            $opcionesMenu[$registro->id] = $registro->menu;
        }
        return $opcionesMenu;
    }

    public static function all_by_name($rolename)
    {
        $model = Menu::where('menu', 'LIKE', "%{$rolename}%")->get();
        return $model;
    }

    public static function all_filter($field, $value)
    {
        $model = Menu::where($field, 'LIKE', "%{$value}%")->get();
        return $model;
    }

    public static function findRecord($id)
    {
        $model = Menu::findOrFail('id', $id);
        return $model;
    }

    public static function insertRecord($registro)
    {

        $model = new Menu();
        $model->fill($registro);
        $model->save($registro);

        return $model;
    }

    public static function updateRecord($registro)
    {
        $model = Menu::findOrFail('id', $registro['id']);
        $model->fill($registro);
        $model->save($registro);
        return $model;
    }

    public static function menu_usuario($role_id)
    {
        //$query = $this->db->query('select * from menus where id in (select menu_id from menu_perfil where perfil_id=' . $role_id . ')');
        //return $query->result();

        //return DB::select('SELECT * FROM t_menus t1 WHERE id IN (SELECT menu_id FROM t_menu_role WHERE role_id = ?');
        return Menu::leftjoin('t_menu_role', 't_menu_role.menu_id', '=', 't_menus.id')
        ->leftjoin('t_roles', 't_menu_role.role_id', '=', 't_roles.id')
        ->where('t_menu_role.role_id', '=', $role_id)
        ->where('t_roles.status', '=', 1)
        ->get(['t_menus.*', 't_roles.guard_name']);

        /*$roles_menus = DB::table('t_postulatejob')
            ->selectRaw('count(id) as cant_postulantes, offer_id')
            ->groupBy('offer_id');

        $data = Menu::leftjoin('t_menu_role', 't_careers.id', '=', 't_offersjob.career_id')
            ->leftjoinSub($cantPostulates, 'cantPostulates', function ($join) {
                $join->on('t_offersjob.id', '=', 'cantPostulates.offer_id');
            })
            ->orderBy('t_offersjob.updated_at', 'desc')
            ->get(['t_offersjob.*', 't_careers.career_title', 'cantPostulates.cant_postulantes']);

        return $data;*/

        //$model = Menu::leftjoin('t_menu_role', ('id', $registro['id']);
    }

}
