<?php
namespace App\Models;
use CodeIgniter\Model;
class ConfigHorariosModel extends Model
{
	protected $table = 'config_horarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'dia',
        'hora_inicio',
        'hora_fin',
        'habilitado'
    ];
}