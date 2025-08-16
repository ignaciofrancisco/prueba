<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $fillable = ['nombre','fecha_inicio','estado','responsable','monto','created_by'];
}
