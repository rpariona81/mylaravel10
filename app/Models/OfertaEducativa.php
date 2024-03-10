<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaEducativa extends Model
{
    use HasFactory;

    public function get_all()
    {
        $lista = OfertaEducativa::all();
        return $lista;
        //return json_encode($listCareers);
    }

    public function get_select($id)
    {
        $select = OfertaEducativa::findOrFail($id)->first();
        return $select;
        //return json_encode($listCareers);
    }

    /*
    Store the record in the database
    */
    public function store($request)
    {
        $data = array(
            'carrera_id' => $request->carrera_id,
            'activo' => $request->activo,
            'fecha_autorizacion' => $request->fecha_autorizacion,
            'resol_autorizacion' => $request->resol_autorizacion,
            'informacion_adicional' => $request->informacion_adicional,
            'ind_aer' => $request->ind_aer,
            'd_ind_aer' => $request->d_ind_aer,
            'programa_anterior' => $request->programa_anterior,
            'condicion_oferta' => $request->condicion_oferta,
            'decision_optimizacion' => $request->decision_optimizacion,
            'OfertaEducativamizacion' => $request->OfertaEducativamizacion,
            'proceso_admision' => $request->proceso_admision,
            'condicion_disertpa' => $request->condicion_disertpa,
            'programa_disertpa' => $request->programa_disertpa,
            'nivelform_disertpa' => $request->nivelform_disertpa,
            'nrocreditos_disertpa' => $request->nrocreditos_disertpa,
            'nrooficio_disertpa' => $request->nrooficio_disertpa,
            'personal_disertpa' => $request->personal_disertpa,
            'fechaoficio_disertpa' => $request->fechaoficio_disertpa,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        );

        $model = new OfertaEducativa();
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
    public static function updateOferta($request)
    {
        $model = OfertaEducativa::findOrFail($request->id);
        $data = array(
            'carrera_id' => $request->carrera_id,
            'activo' => $request->activo,
            'fecha_autorizacion' => $request->fecha_autorizacion,
            'resol_autorizacion' => $request->resol_autorizacion,
            'informacion_adicional' => $request->informacion_adicional,
            'ind_aer' => $request->ind_aer,
            'd_ind_aer' => $request->d_ind_aer,
            'programa_anterior' => $request->programa_anterior,
            'condicion_oferta' => $request->condicion_oferta,
            'decision_optimizacion' => $request->decision_optimizacion,
            'OfertaEducativamizacion' => $request->OfertaEducativamizacion,
            'proceso_admision' => $request->proceso_admision,
            'condicion_disertpa' => $request->condicion_disertpa,
            'programa_disertpa' => $request->programa_disertpa,
            'nivelform_disertpa' => $request->nivelform_disertpa,
            'nrocreditos_disertpa' => $request->nrocreditos_disertpa,
            'nrooficio_disertpa' => $request->nrooficio_disertpa,
            'personal_disertpa' => $request->personal_disertpa,
            'fechaoficio_disertpa' => $request->fechaoficio_disertpa,
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

    public static function getOfertaEducativa()
    {
        /*$cantIESTpublicos = DB::table('t_institutos')
            ->selectRaw('count(id) as cant_institutos, id_region')
            ->groupBy('id_region');
            */
        $data = OfertaEducativa::leftjoin('t_institutos', 't_institutos.id', '=', 't_institutos_ofertas.instituto_id')
            ->leftjoin('t_regiones', 't_regiones.id', '=', 't_institutos.id_region')
            ->leftjoin('t_carreras', 't_carreras.id', '=', 't_institutos_ofertas.carrera_id')
            ->orderBy('t_institutos_ofertas.updated_at', 'desc')
            ->orderBy('t_institutos.id_region', 'asc')
            ->orderBy('t_institutos.instituto', 'asc')
            ->orderBy('t_institutos_ofertas.cod_oferta', 'asc')
            ->get(['t_institutos_ofertas.*', 't_institutos.instituto','t_institutos.cod_mod', 't_regiones.region' , 't_carreras.carrera_digitacion']);

        return $data;
        //return $cantIESTpublicos;
    }
}
