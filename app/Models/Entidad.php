<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 't_entidades';
	//protected $dateFormat = 'Ymd H:i:s';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'codregion',
		'region', //lowercase
		'codentidad', // optional
		'entidad', //optional, set to 1 by default
		'titulo_entidad', //optional, set to 1 by default
		'codtipo_entidad',
		'tipo_entidad', //optional, set to 1 by default
		'codgestion_entidad',
		'gestion_entidad'
	];

	public static function getEntidades($region, $tipo)
	{
		$entidades = array();
		$entidades[0] = 'Seleccione entidad';
		$lista = Entidad::select('codentidad', 'titulo_entidad')
			->where('codregion', $region)
			->where('codtipo_entidad', $tipo)
			->where('estado', '=', 1)->get();
		foreach ($lista as $registro) {
			$entidades[$registro->codentidad] = $registro->titulo_entidad;
		}
		$entidades['GOBNAMINEDU'] = 'MINEDU';
		$entidades['OTROS'] = 'OTRA INSTITUCIÓN';
		/*$minedu = ['GOBNAMINEDU'=>'MINEDU'];
		$otros = ['OTROS'=>'OTRA INSTITUCIÓN'];
		array_push($entidades,$minedu);
		array_push($entidades,$otros);
		/*array_push($entidades,$minedu);
		array_push($entidades,$otros);*/
		return $entidades;
	}


}
