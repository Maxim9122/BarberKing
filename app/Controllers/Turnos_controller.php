<?php
namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\Productos_model;
Use App\Models\Cabecera_model;
Use App\Models\VentaDetalle_model;
use App\Models\Turnos_model;
use App\Models\Usuarios_model;
use App\Models\Clientes_model;
use App\Models\Servicios_model;
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
        t.id_servi,
        c.nombre AS cliente_nombre, 
        c.telefono AS cliente_telefono,
        u.nombre AS barber_nombre,
        s.descripcion,
        s.precio
    ');

    // Relaciono la tabla turnos con clientes
    $builder->join('cliente c', 'c.id_cliente = t.id_cliente');
    // Relaciono la tabla turnos con usuarios (barberos)
    $builder->join('usuarios u', 'u.id = t.id_barber');
    // Relaciono la tabla turnos con servicio
    $builder->join('servicios s', 's.id_servi = t.id_servi');

    // Ejecuto la consulta
    $turnos = $builder->get();
     // Transformo los resultados en un array para la vista
    $datos['turnos'] = $turnos->getResultArray();

    $UsModel = new Usuarios_model();
        $baja='NO';
        $datos2['barbers'] = $UsModel->getUsBaja($baja);

    $serviModel = new Servicios_model();
        $datos3['servicios'] = $serviModel->getServicio();
       
    $ClienteModel = new Clientes_model();
        $datos4['clientes'] = $ClienteModel->getClientes();

    // Cargo las vistas
    $data['titulo'] = 'Listado de Turnos';
    echo view('navbar/navbar');
    echo view('header/header', $data);
    echo view('turnos/ListaTurnos_view', $datos+$datos2+$datos3+$datos4);
    echo view('footer/footer');
        }


        public function nuevoTurno()
        {
            // Cargar el modelo de servicios
            $serviciosModel = new Servicios_model();
    
            // Obtener todos los servicios desde la base de datos
            $servicios = $serviciosModel->getServicio();
    
            // Preparar los datos para la vista
            $data = [
                'titulo' => 'Crear Nuevo Turno',
                'servicios' => $servicios // Pasamos los servicios a la vista
            ];
    
            // Cargar las vistas
            echo view('navbar/navbar');
            echo view('header/header', $data);
            echo view('turnos/nuevoTurno_view', $data); // Pasamos los datos a la vista
            echo view('footer/footer');
        }


   //Verifica y guarda los turnos
   public function RegistrarTurno() {
    $input = $this->validate([
        'nombre_cliente' => 'required|min_length[3]',
        'telefono' => 'required|min_length[10]|max_length[10]|is_unique[cliente.telefono]',
        'tipo_servicio' => 'required|max_length[13]'
    ]);

    $turnosModel = new Turnos_model();
    $clienteModel = new Clientes_model();

        if (!$input) {
        $data['titulo'] = 'Registro Turno'; 
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
            'id_servi' => $this->request->getVar('tipo_servicio'),
            'estado' => 'Pendiente',
        ]);

        session()->setFlashdata('msg', 'Turno Registrado!');
        return redirect()->to(base_url('turnos'));
        }
        }


    //Verifica y guarda los turnos de clientes ya registrados
    public function turnoClienteRegistrado() {

        $turnosModel = new Turnos_model();
        $clienteModel = new Clientes_model();

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date('d-m-Y');

         // Rescato el ID del cliente.
         $id_cliente = $this->request->getVar('id_cliente');

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
             'id_servi' => $this->request->getVar('tipo_servicio'),
             'estado' => 'Pendiente',
         ]);
 
         session()->setFlashdata('msg', 'Turno Registrado!');
         return redirect()->to(base_url('turnos'));
    }

    //Actualiza el turno
    public function turno_actualizar($id_turno){ 
     // Cargar el modelo
     $Turnos_model = new Turnos_model();

     // Capturar los datos enviados desde el formulario
     $id_barber = $this->request->getPost('id_barber');
     $hora_turno = $this->request->getPost('hora_turno');
     $id_servi = $this->request->getPost('id_servi');

     // Preparar los datos para actualizar
     $data = array(
         'id_barber' => $id_barber,
         'hora_turno' => $hora_turno,
         'id_servi' => $id_servi
     );

     // Actualizar en la base de datos
     $Turnos_model->actualizar_turno($id_turno, $data);

     // Redirigir a la lista de turnos
     session()->setFlashdata('msg', 'Turno Actualizado!');
    return redirect()->to(base_url('turnos'));
    }
        
    
    //Guarda el turno Completado
   public function Turno_completado($id_turno) {

    $turnos_model = new Turnos_model();

        // Cambia el estado a Listo o sea completado
        $data = array(
            'estado' => 'Listo'
        );

        $turnos_model->actualizar_turno($id_turno, $data);

        session()->setFlashdata('msg', 'Turno Completado!');
        return redirect()->to(base_url('turnos'));
        }


         //Guarda el turno Cancelado
   public function Turno_cancelado($id_turno) {

    $turnos_model = new Turnos_model();

        // Cambia el estado a Listo o sea completado
        $data = array(
            'estado' => 'Cancelado'
        );

        $turnos_model->actualizar_turno($id_turno, $data);

        session()->setFlashdata('msgEr', 'Turno Cancelado!');
        return redirect()->to(base_url('turnos'));
        }
    
    //Muestra todos los turnos realizados    
    public function turnosCompletados(){
            {
                $estado = 'Listo';
            
                // Me conecto a la base de datos
                $db = db_connect();
                // Inicio la consulta desde la tabla turnos con un alias "t"
                $builder = $db->table('turnos t');
            
                // Filtro las ventas para que solo rescate los turnos pendientes de hoy
                $builder->where('t.estado', $estado);
                
            
                // Selecciono los campos que necesito de las tres tablas
                $builder->select('
                    t.id, 
                    t.id_barber, 
                    t.hora_turno, 
                    t.estado, 
                    t.fecha_registro,
                    t.fecha_turno, 
                    t.id_servi,
                    c.nombre AS cliente_nombre, 
                    c.telefono AS cliente_telefono,
                    u.nombre AS barber_nombre,
                    s.descripcion,
                    s.precio
                ');
            
                // Relaciono la tabla turnos con clientes
                $builder->join('cliente c', 'c.id_cliente = t.id_cliente');
                // Relaciono la tabla turnos con usuarios (barberos)
                $builder->join('usuarios u', 'u.id = t.id_barber');
                // Relaciono la tabla turnos con servicio
                $builder->join('servicios s', 's.id_servi = t.id_servi');
            
                // Ejecuto la consulta
                $turnos = $builder->get();
                 // Transformo los resultados en un array para la vista
                $datos['turnos'] = $turnos->getResultArray();
            
                $UsModel = new Usuarios_model();
                    $baja='NO';
                    $datos2['barbers'] = $UsModel->getUsBaja($baja);
            
                $serviModel = new Servicios_model();
                    $datos3['servicios'] = $serviModel->getServicio();
                   
                $ClienteModel = new Clientes_model();
                    $datos4['clientes'] = $ClienteModel->getClientes();
            
                // Cargo las vistas
                $data['titulo'] = 'Listado de Turnos';
                echo view('navbar/navbar');
                echo view('header/header', $data);
                echo view('turnos/turnosCompletados', $datos+$datos2+$datos3+$datos4);
                echo view('footer/footer');
        }
        }

//Filtrado de turnos por fecha y barber
public function filtrarTurnos()
{
    // Rescato las fechas que vienen del formulario y las convierto al formato correcto (dia-mes-año)
    $fecha_desde = $this->request->getVar('fecha_desde');
    $fecha_desdeOK = date('d-m-Y', strtotime($fecha_desde));
    $fecha_hasta = $this->request->getVar('fecha_hasta');
    $fecha_hastaOK = date('d-m-Y', strtotime($fecha_hasta));
    $barber = $this->request->getVar('id_barber');
    $estado = 'Listo';

    // Me conecto a la base de datos
    $db = db_connect();

    // Inicio la consulta desde la tabla turnos con un alias "t"
    $builder = $db->table('turnos t');

    // Aplico filtros
    $builder->where('t.estado', $estado);

    // Filtrar por rango de fechas (considerando el formato dd-mm-yyyy)
    if (!empty($fecha_desdeOK)) {
        $builder->where('STR_TO_DATE(t.fecha_turno, "%d-%m-%Y") >=', date('Y-m-d', strtotime($fecha_desdeOK)));
    }
    if (!empty($fecha_hastaOK)) {
        $builder->where('STR_TO_DATE(t.fecha_turno, "%d-%m-%Y") <=', date('Y-m-d', strtotime($fecha_hastaOK)));
    }

    // Filtrar por barbero si se seleccionó alguno
    if (!empty($barber)) {
        $builder->where('t.id_barber', $barber);
    }

    // Selección de campos y joins
    $builder->select('t.id, 
                      t.id_barber, 
                      t.hora_turno, 
                      t.estado, 
                      t.fecha_turno,
                      t.fecha_registro, 
                      t.id_servi,
                      c.nombre AS cliente_nombre, 
                      c.telefono AS cliente_telefono,
                      u.nombre AS barber_nombre,
                      s.descripcion,
                      s.precio');

    // Relaciono la tabla turnos con cliente, usuarios (barberos) y servicios
    $builder->join('cliente c', 'c.id_cliente = t.id_cliente');
    $builder->join('usuarios u', 'u.id = t.id_barber');
    $builder->join('servicios s', 's.id_servi = t.id_servi');

    // Ejecuto la consulta
    $turnos = $builder->get();

    // Transformo los resultados en un array para la vista
    $datos['turnos'] = $turnos->getResultArray();

    $UsModel = new Usuarios_model();
        $baja='NO';
        $datos2['barbers'] = $UsModel->getUsBaja($baja);

    $serviModel = new Servicios_model();
        $datos3['servicios'] = $serviModel->getServicio();
       
    $ClienteModel = new Clientes_model();
        $datos4['clientes'] = $ClienteModel->getClientes();

    // Cargo las vistas
    $data['titulo'] = 'Listado de Turnos';
    echo view('navbar/navbar');
    echo view('header/header', $data);
    echo view('turnos/turnosCompletados', $datos+$datos2+$datos3+$datos4);
    echo view('footer/footer');
    }


}