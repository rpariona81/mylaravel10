<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registroasistentes extends Model
{
    use HasFactory;

    protected $table = 't_registroasistentes';
	//protected $dateFormat = 'Ymd H:i:s';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'time',
		'region', //lowercase
		'codentidad', // optional
		'titulo_entidad', //optional, set to 1 by default
		'dni', //optional, set to 1 by default
		'nombres',
		'apellidos', //optional, set to 1 by default
		'correo',
		'telf_celular',
		'cargo',
		'programa_cargo_especifico',
		'reunion',
		'dirigido_a',
		'hora_inicio',
		'hora_fin',
		'responsable',
		''
	];
    
}
