<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionPlanes extends Model
{
    use HasFactory;

    public function get_all()
    {
        $lista = RegionPlanes::all();
        return $lista;
        //return json_encode($listCareers);
    }

    public function get_select($id)
    {
        $select = RegionPlanes::findOrFail($id)->first();
        return $select;
        //return json_encode($listCareers);
    }

    /*
    Store the record in the database
    */
    public function store($request)
    {
        $data = array(
            'documento_aprobacion' => $request->documento_aprobacion,
            'fecha_aprobacion' => $request->fecha_aprobacion,
            'cod_etapa_condicion' => $request->cod_etapa_condicion,
            'ord_referencia' => $request->ord_referencia,
            'observaciones' => $request->observaciones,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ruta_alterna' => $request->ruta_alterna,
            'visible' => $request->visible,
            'estado' => $request->estado,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        );

        $model = new RegionPlanes();
        $model->fill($data);
        //$model->save($data);
        if (!$model->save($data)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
    Store the record in the database
    */
    public function updateRegionPlan($request)
    {
        $model = RegionPlanes::findOrFail($request->id);
        $data = array(
            'documento_aprobacion' => $request->documento_aprobacion,
            'fecha_aprobacion' => $request->fecha_aprobacion,
            'cod_etapa_condicion' => $request->cod_etapa_condicion,
            'ord_referencia' => $request->ord_referencia,
            'observaciones' => $request->observaciones,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ruta_alterna' => $request->ruta_alterna,
            'visible' => $request->visible,
            'estado' => $request->estado,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        );

        $model->fill($data);
        //$model->save($data);
        if (!$model->save($data)) {
            return FALSE;
        } else {
            return TRUE;
        }

    }

    public static function getRegionesPlanes()
    {
        $cantIESTpublicos = DB::table('t_institutos')
            ->selectRaw('count(id) as cant_institutos, id_region')
            ->groupBy('id_region');

        $data = RegionPlanes::leftjoin('cod_etapa', 'cod_etapa.id', '=', 't_regiones_etapa_opti.cod_etapa')
            ->leftjoin('t_regiones', 't_regiones.id', '=', 't_regiones_etapa_opti.region_id')
            ->leftjoinSub($cantIESTpublicos, 'cantIESTpublicos', function ($join) {
                $join->on('t_regiones_etapa_opti.region_id', '=', 'cantIESTpublicos.id_region');
            })
            ->where('t_regiones_etapa_opti.cod_etapa',4)
            ->where('t_regiones_etapa_opti.visible',1)
            //->where('t_regiones_etapa_opti.region_id',5)
            ->orderBy('t_regiones_etapa_opti.region_id', 'asc')
            ->get(['t_regiones_etapa_opti.*', 'cod_etapa.item', 't_regiones.region' , 'cantIESTpublicos.cant_institutos']);

        return $data;
        //return $cantIESTpublicos;
    }

}
