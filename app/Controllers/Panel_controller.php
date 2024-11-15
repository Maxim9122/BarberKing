<?php 
namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class Panel_controller extends Controller
{
    public function index()
    {
        
        
         $dato['titulo']='Panel del Usuario'; 
         echo view('navbar/navbar');
         echo view('header/header',$dato);
         echo view('footer/footer');
     
    }
}