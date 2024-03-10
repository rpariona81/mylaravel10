<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituto extends Model
{
    use HasFactory;

    protected $table = 't_institutos';

    protected $fillable = [
        'cod_mod',
        'instituto',
        'es_licenciado',
        'rm_licenciamiento',
        'es_idex',
        'codgeo',
        'd_dpto',
        'd_prov',
        'd_dist',
        'created_by',
        'updated_by'
    ];

	public static function getCronogramaInstitutos($region_id = NULL)
	{
		$cantPrograms = DB::table('t_institutos_ofertas')
			->selectRaw('count(activo) as cant_programs, instituto_id')
			->where('activo', 1)
			->groupBy('instituto_id');

		$data = Instituto::leftjoin('t_regiones', 't_regiones.id', '=', 't_institutos.region_id')
			->leftjoin('t_institutos_fortalecimien', 't_institutos_fortalecimien.instituto_id', '=', 't_institutos.id')
			->leftjoinSub($cantPrograms, 'cantPrograms', function ($join) {
				$join->on('t_institutos.id', '=', 'cantPrograms.instituto_id');
			})
			->orderBy('t_institutos.region_id', 'asc')
			->get(['t_institutos.*', 't_regiones.region','t_institutos_fortalecimien.proceso_licenciamiento','t_institutos_fortalecimien.fecha_max_presentacion','cantPrograms.cant_programs']);

		return $data;
	}


	public static function getMarcoInstitutos($region_id = NULL)
	{
		$cantUsers = DB::table('t_marco_instituto')
			->selectRaw('count(user_id) as cant_users, instituto_id')
			->groupBy('instituto_id');

		$data = Instituto::leftjoin('t_regiones', 't_regiones.id', '=', 't_institutos.region_id')
			->leftjoinSub($cantUsers, 'cantUsers', function ($join) {
				$join->on('t_institutos.id', '=', 'cantUsers.instituto_id');
			})
			->orderBy('t_institutos.region_id', 'asc')
			->get(['t_institutos.*', 't_regiones.region', 'cantUsers.cant_users']);

		return $data;
	}

    public function region(){
        return $this->belongsTo(Region::class);
    }

}
