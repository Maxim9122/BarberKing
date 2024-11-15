<?php
namespace App\Models;
use CodeIgniter\Model;
class Turnos_model extends Model
{
	protected $table = 'turnos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cliente','id_barber', 'tipo_servicio' ,'fecha_registro','fecha_turno','hora_turno','estado'];

    public function getUsuario($id){

    	return $this->where('id',$id)->first($id);
    }
}