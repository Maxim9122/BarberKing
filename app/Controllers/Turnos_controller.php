<?php
namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\Productos_model;
Use App\Models\Cabecera_model;
Use App\Models\VentaDetalle_model;
use App\Models\Turnos_model;
use App\Models\Usuarios_model;
use App\Models\Clientes_model;
//use Dompdf\Dompdf;

class Turnos_controller extends Controller{

	public function __construct(){
           helper(['form', 'url']);
	}

    public function ListarTurnos()
{
    $fechaHoy = date('d-m-Y');
    $estado = 'Pendiente';

    // Me conecto a la base de datos
    $db = db_connect();
    // Inicio la consulta desde la tabla turnos con un alias "t"
    $builder = $db->table('turnos t');

    // Filtro las ventas para que solo rescate los turnos pendientes de hoy
    $builder->where('t.estado', $estado);
    $builder->where('t.fecha_turno', $fechaHoy);

    // Selecciono los campos que necesito de las tres tablas
    $builder->select('
        t.id, 
        t.id_barber, 
        t.hora_turno, 
        t.estado, 
        t.fecha_registro, 
        t.tipo_servicio,
        c.nombre AS cliente_nombre, 
        c.telefono AS cliente_telefono,
        u.nombre AS barber_nombre
    ');

    // Relaciono la tabla turnos con clientes
    $builder->join('cliente c', 'c.id_cliente = t.id_cliente');
    // Relaciono la tabla turnos con usuarios (barberos)
    $builder->join('usuarios u', 'u.id = t.id_barber');

    // Ejecuto la consulta
    $turnos = $builder->get();

    // Transformo los resultados en un array para la vista
    $datos['turnos'] = $turnos->getResultArray();

    // Cargo las vistas
    $data['titulo'] = 'Listado de Turnos';
    echo view('navbar/navbar');
    echo view('header/header', $data);
    echo view('turnos/ListaTurnos_view', $datos);
    echo view('footer/footer');
}

//Carga la vista del formulario para nuevos turnos
    public function nuevoTurno() {
        $data['titulo']='Crear Nuevo Turno'; 
        echo view('navbar/navbar');
        echo view('header/header',$data);        
        echo view('turnos/nuevoTurno_view');
        echo view('footer/footer');
    
   }

   //Verifica y guarda los turnos
   public function RegistrarTurno() {
    $input = $this->validate([
        'nombre_cliente' => 'required|min_length[3]',
        'telefono' => 'required|min_length[10]|max_length[10]',
        'tipo_servicio' => 'required|max_length[13]'
    ]);

    $turnosModel = new Turnos_model();
    $clienteModel = new Clientes_model();

    if (!$input) {
        $data['titulo'] = 'Registro'; 
        echo view('navbar/navbar');
        echo view('header/header', $data);                
        echo view('turnos/nuevoTurno_view', ['validation' => $this->validator]);
        echo view('footer/footer');
    } else {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date('d-m-Y');

        // Validación y carga de la imagen
        $validation = $this->validate([
            'foto' => ['uploaded[foto]', 'mime_in[foto,image/jpg,image/jpeg,image/png]']
        ]);

        if ($validation) {
            $img = $this->request->getFile('foto');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);

            $clienteModel->save([
                'nombre' => $this->request->getVar('nombre_cliente'), 
                'telefono' => $this->request->getVar('telefono'),
                'foto' => $img->getName()
            ]);
        } else {
            $clienteModel->save([
                'nombre' => $this->request->getVar('nombre_cliente'), 
                'telefono' => $this->request->getVar('telefono')
            ]);
        }

        // Rescato el ID del cliente nuevo que se guardó para asignarle al turno
        $id_cliente = $clienteModel->getInsertID();

        // Convertir la fecha al formato dd-mm-yyyy
        $fecha_turno = $this->request->getVar('fecha_turno');
        $fecha_turno_formateada = date('d-m-Y', strtotime($fecha_turno));

        // Guardar el turno en la base de datos
        $turnosModel->save([
            'id_cliente' => $id_cliente,
            'id_barber' => 2,
            'fecha_registro' => $fecha,
            'fecha_turno' => $fecha_turno_formateada,
            'hora_turno' => $this->request->getVar('hora_turno'),
            'tipo_servicio' => $this->request->getVar('tipo_servicio'),
            'estado' => 'Pendiente',
        ]);

        session()->setFlashdata('msg', 'Turno Registrado');
        return redirect()->to(base_url('turnos'));
    }
}

}