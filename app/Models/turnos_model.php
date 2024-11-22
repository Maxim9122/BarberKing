<?php
namespace App\Models;
use CodeIgniter\Model;
class Turnos_model extends Model
{
	protected $table = 'turnos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cliente','id_barber', 'id_servi' ,'fecha_registro','fecha_turno','hora_turno','estado'];

    public function getUsuario($id){

    	return $this->where('id',$id)->first($id);
    }

    public function actualizar_turno($id_turno, $data) {
        return $this->db->table('turnos') // Indicar la tabla
                        ->where('id', $id_turno) // Condición
                        ->update($data); // Actualización
    }
}