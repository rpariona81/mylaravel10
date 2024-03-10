<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalWebLineal extends Model
{
    use HasFactory;

    private $count = 0;
    private $total = 0;
    private $results = null;

    protected $table = 't_mv8_lineal';

    protected $primaryKey = 'instituto_id';

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $casts = [

    ];


    public static function get_select($id=null)
    {
        $select = PortalWebLineal::where('instituto_id', $id)->firstOrFail()->first();
        return $select;
        //return json_encode($listCareers);
    }

    public static function get_cifras()
    {
        $cifras = [];
        $cifras['conteo'] = PortalWebLineal::where('mv8_lineal_p1', 1)->count();
        $cifras['porcentaje'] = round($cifras['conteo'] / PortalWebLineal::count(),2)*100;
        return $cifras;
        //return json_encode($listCareers);
    }

    /*
    Store the record in the database
    */
    public function store($request)
    {
        $data = array(
            'region_id' => $request->region_id,
            'codentidad' => $request->codentidad,
            'entidad' => $request->entidad,
            'titulo_entidad' => $request->titulo_entidad,
            'codtipoentidad' => $request->codtipoentidad,
            'codgestionentidad' => $request->codgestionentidad,
            'estado' => $request->estado,
            'flag_visible' => $request->flag_visible,
            'flag_formulario' => $request->flag_formulario
        );

        $model = new PortalWebLineal();
        $model->fill($data);
        $model->save($data);
    }

}

