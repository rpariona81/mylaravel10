<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    use HasFactory;

    protected $table = 't_menu_role';
    //protected $dateFormat = 'Ymd H:i:s';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_id',
        'role_id',
    ];

    public static function getMenusRoles($role_id)
    {
        return MenuRole_Eloquent::leftjoin('t_roles', 't_menu_role.role_id', '=', 't_roles.id')
            ->leftjoin('t_menus', 't_menu_role.menu_id', '=', 't_menus.id')
            ->where('t_menu_role.role_id', '=',$role_id)
            ->get(['t_menu_role.*', 't_roles.status', 't_roles.rolename','t_menus.menu','t_menus.controller','t_menus.action','t_menus.orden','t_menus.menu_type','t_menus.icono']);
    }

}
