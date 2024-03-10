<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalWebMatriz extends Model
{
    use HasFactory;

    protected $table = 't_mv8_matriz';

    //protected $primaryKey = 'id';

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mv8_matriz_p1',
        'mv8_matriz_p2',
        'mv8_matriz_p3',
        'mv8_matriz_p4',
        'mv8_matriz_p5',
        'mv8_matriz_p6',
        'mv8_matriz_p7'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = [];

    public function get_all()
    {
        $lista = PortalWebMatriz::all();
        return $lista;
        //return json_encode($listCareers);
    }

    public static function get_matriz($instituto_id = null)
    {
        /*$select = Portal_lineal::where('instituto_id', $id)->firstOrFail()->get();
        return $select;
        //return json_encode($listCareers);*/

        return PortalWebMatriz::leftjoin('t_institutos', 't_mv8_matriz.instituto_id', '=', 't_institutos.id')
            ->leftjoin('t_regiones', 't_institutos.id_region', '=', 't_regiones.id')
            ->leftjoin('cod_art42', 't_mv8_matriz.art42_id', '=', 'cod_art42.id')
            ->select('t_regiones.region', 't_institutos.id_region', 't_institutos.cod_mod', 't_institutos.instituto', 'cod_art42.text_rvm103', 'cod_art42.aplica_IES_art42', 't_mv8_matriz.*')
            ->where('t_mv8_matriz.instituto_id', '=', $instituto_id)
            ->get();
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

        $model = new PortalWebMatriz();
        $model->fill($data);
        $model->save($data);
    }
}
