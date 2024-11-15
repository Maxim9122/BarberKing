<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');

        //renderiza la vista de los productos
       

     
        
        // Combina las vistas en una sola variable
        $output = $navbar . $header . $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }

    public function quienes_somos()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');

        // Renderiza la vista del about
        $header = view('quienes_somos/quienes_somos.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');
        
        // Combina las vistas en una sola variable
        $output = $navbar . $header . $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }

    public function contacto()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');

        $contacto = view('contacto/contacto.php');
        
        // Combina las vistas en una sola variable
        $output = $navbar . $contacto . $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }

        public function comercializacion()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        // Renderiza la vista del comercializacion
        $header = view('comercializacion/comercializacion.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');
        
        // Combina las vistas en una sola variable
        $output = $navbar . $header . $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    } 

    public function terminos_y_condiciones()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');

        //Renderiza la vista de los terminos y condiciones
        $tyc = view('terminos_y_condiciones/terminos_y_condiciones.php');
        
        // Combina las vistas en una sola variable
        $output = $navbar . $header . $tyc . $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }
    public function login()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');

        //renderiza la vista del formulario de login
        $login = view('login/login.php');
        
        // Combina las vistas en una sola variable
        $output = $navbar . $login .  $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }
    public function signUp()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');

        //renderiza la vista del formulario de login
        $signUp = view('signUp/signUp.php');
        
        // Combina las vistas en una sola variable
        $output = $navbar . $signUp .  $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }
    public function productos()
    {
        // Renderiza la vista del encabezado
        $header = view('header/header.php');
        
        // Renderiza la vista de la barra de navegación
        $navbar = view('navbar/navbar.php');

        //Renderiza la vista de la barra de navegación
        $footer = view('footer/footer.php');

        //renderiza la vista de los productos
        $productos = view('productos/listar.php');

        
        // Combina las vistas en una sola variable
        $output = $navbar . $header . $productos . $footer;
        
        // Retorna la combinación de las vistas
        return $output;
    }

   

}
