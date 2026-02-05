<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Usuarios_model;
use App\Models\ConfigHorariosModel;
  
class Horarios_controller extends Controller
{
    public function index()
    {
        $model = new ConfigHorariosModel();
        $data['horarios'] = $model->findAll();
        echo view('navbar/navbar');
		echo view('header/header',$data);	
        echo view('admin/horarios_view', $data);
        echo view('footer/footer');
    }

    public function guardar()
    {
        $model = new ConfigHorariosModel();

        foreach ($this->request->getPost('dia') as $i => $dia) {
            $model->where('dia', $dia)->set([
                'hora_inicio' => $this->request->getPost('hora_inicio')[$i] ?: null,
                'hora_fin'    => $this->request->getPost('hora_fin')[$i] ?: null,
                'habilitado'  => isset($this->request->getPost('habilitado')[$i]) ? 1 : 0
            ])->update();
        }

        return redirect()->back()->with('success', 'Horarios actualizados');
    }
} 
