<?php
namespace App\Models;
use CodeIgniter\Model;
class Turnos_model extends Model
{
	protected $table = 'turnos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cliente','id_barber', 'id_servi' ,'fecha_registro','inicio','fin','fecha_turno','estado'];

    public function getUsuario($id){

    	return $this->where('id',$id)->first($id);
    }

    public function actualizar_turno($id_turno, $data) {
        return $this->db->table('turnos') // Indicar la tabla
                        ->where('id', $id_turno) // Condición
                        ->update($data); // Actualización
    }

     // Obtiene turnos con las relaciones necesarias
     public function obtenerTurnos(array $filtros = [])
{
    $builder = $this->db->table('turnos t');

    $builder->select('
        t.*,
        c.nombre AS cliente_nombre,
        c.telefono AS cliente_telefono,
        s.descripcion AS servicio,
        s.precio,
        s.seccion_id
    ');

    $builder->join('cliente c', 'c.id_cliente = t.id_cliente');
    $builder->join('servicios s', 's.id_servi = t.id_servi');

    if (!empty($filtros['estado'])) {
        $builder->where('t.estado', $filtros['estado']);
    }

    if (!empty($filtros['fecha_turno'])) {
        $builder->where('t.fecha_turno', $filtros['fecha_turno']);
    }

    $builder->orderBy('t.inicio', 'ASC');
    
    return $builder->get()->getResultArray();
}

      // Actualiza el turno
    public function actualizarTurno($id_turno, $data)
    {
        return $this->update($id_turno, $data);
    }

    // Cambia el estado del turno
    public function cambiarEstado($id_turno, $estado)
    {
        return $this->update($id_turno, ['estado' => $estado]);
    }

    public function obtenerTurnosCompletados()
    {
        return $this->select('
                turnos.id, 
                turnos.id_barber, 
                turnos.hora_turno, 
                turnos.estado, 
                turnos.fecha_registro,
                turnos.fecha_turno, 
                turnos.id_servi,
                cliente.nombre AS cliente_nombre, 
                cliente.telefono AS cliente_telefono,
                usuarios.nombre AS barber_nombre,
                servicios.descripcion,
                servicios.precio
            ')
            ->join('cliente', 'cliente.id_cliente = turnos.id_cliente')
            ->join('usuarios', 'usuarios.id = turnos.id_barber')
            ->join('servicios', 'servicios.id_servi = turnos.id_servi')
            ->where('turnos.estado', 'Listo')
            ->orderBy('turnos.fecha_turno', 'DESC')
            ->orderBy('turnos.hora_turno', 'DESC ')
            ->findAll();
    }

    //Elimina de forma fisica el turno porque el Cliente del Soft asi lo quiere.
    public function eliminarTurno($id_turno)
    {
    return $this->db->table('turnos')->delete(['id' => $id_turno]);
    }

}