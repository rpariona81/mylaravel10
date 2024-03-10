<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 't_regiones';

    protected $guarded=[];

    protected $fillable = [
        'codregion',
        'region',
        'region_alias',
        'region_politica',
        'folder',
        'url_folder',
        'ruta_alterna'
    ];

    public function institutos()
    {
        return $this->belongsToMany(Instituto::class)->get();

    }
}
