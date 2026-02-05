<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Usuarios_model;
use App\Models\Clientes_model;
  
class Login_controller extends Controller
{
    public function index()
    {
        helper(['form','url']);

         $dato['titulo']='login'; 
        
        echo view('navbar/navbar');
        echo view('header/header',$dato);
        echo view('login/login');
        echo view('footer/footer');
    } 
  
    public function auth()
    {
    $session = session();
    $usuariosModel = new Usuarios_model();
    $clientesModel = new Clientes_model();

    $email = $this->request->getVar('email');
    $password = $this->request->getVar('pass');

    /* =========================
       1️⃣ BUSCAR EN USUARIOS
    ========================== */
    $usuario = $usuariosModel->where('email', $email)->first();

    if ($usuario) {

        if (!password_verify($password, $usuario['pass'])) {
            $session->setFlashdata('error', 'Password Incorrecta');
            return redirect()->to('login');
        }

        if ($usuario['baja'] == 'SI') {
            $session->setFlashdata('error', 'Usted fue dado de baja');
            return redirect()->to('login');
        }

        $session->set([
            'id'         => $usuario['id'],
            'nombre'     => $usuario['nombre'],
            'apellido'   => $usuario['apellido'],
            'email'      => $usuario['email'],
            'telefono'   => $usuario['telefono'],
            'direccion'  => $usuario['direccion'],
            'perfil_id'  => $usuario['perfil_id'],
            'logged_in'  => true
        ]);

        // Redirección según perfil
        if ($usuario['perfil_id'] == 2) {
            return redirect()->to('turnos');
        } else {
            return redirect()->to('Lista_Productos');
        }
    }

    /* =========================
       2️⃣ BUSCAR EN CLIENTES
    ========================== */
    $cliente = $clientesModel->where('email', $email)->first();

    if ($cliente) {

        // Si el cliente no tiene password (registro simple)
        if (!empty($cliente['pass'])) {
            if (!password_verify($password, $cliente['pass'])) {
                $session->setFlashdata('error', 'Password Incorrecta');
                return redirect()->to('login');
            }
        }

        $session->set([
            'id'         => $cliente['id_cliente'],
            'nombre'     => $cliente['nombre'],
            'email'      => $cliente['email'] ?? '',
            'telefono'   => $cliente['telefono'],
            'perfil_id'  => 0, // 👈 CLIENTE
            'logged_in'  => true
        ]);

        return redirect()->to('turnos');
    }

        /* =========================
        3️⃣ NO EXISTE
        ========================== */
        $session->setFlashdata('error', 'Email Incorrecto');
        return redirect()->to('login');
    }

  
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
} 
