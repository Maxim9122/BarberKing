<?php
namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\Productos_model;
Use App\Models\Cabecera_model;
Use App\Models\VentaDetalle_model;
//use Dompdf\Dompdf;

class Carrito_controller extends Controller{

	public function __construct(){
           helper(['form', 'url']);
	}

	//Rescato las ventas cabeceras y muestro.
	public function ListVentasCabecera(){
		//Me conecto a la base de datos
		$db = db_connect();
		//Me ubico en la tabla ventas_cabecera y genero un alias "u" y guardo su contenido en $bluider
		$builder = $db->table('ventas_cabecera u');
		//Selecciono de ambas tablas (Cabecera y Detalle) los campos que necesito mostrar en la vista
		$builder->select('u.id , c.nombre , c.telefono , u.total_venta , u.fecha , u.hora , u.tipo_pago');
		//Con un Join relaciono los "id" de ambas tablas para generar una sola con todos los datos
		$builder->join('cliente c','u.id_cliente = c.id_cliente');
		//Guardo el contenido de la relacion de ambas tablas en la variable $ventas
		$ventas= $builder->get();
		//Vuelvo a guardar toda la info pero en la forma de un array para mejor manejo.
		$datos['ventas']=$ventas->getResultArray();
		//print_r($datos);
		//exit;
        
        $data['titulo']='Listado de Compras';
		echo view('navbar/navbar'); 
        echo view('header/header',$data);        
        echo view('comprasXcliente/ListaVentas_view',$datos);
        echo view('footer/footer');
    }

	//Rescato las ventas cabeceras de este cliente y muestro.
	public function ListaComprasCabeceraCliente($id){
		$fechaHoy = date('d-m-Y');
		//Me conecto a la base de datos
		$db = db_connect();
		//Me ubico en la tabla ventas_cabecera y genero un alias "u" y guardo su contenido en $bluider
		$builder = $db->table('ventas_cabecera u');
		//Filtro las ventas para que solo rescate las ventas de este Cliente mediante su id.
		$builder->where('id',$id);
		//Trae las ventas del dia.
		$builder->where('fecha',$fechaHoy);
		//Selecciono de ambas tablas (Cabecera y Detalle) los campos que necesito mostrar en la vista
		$builder->select('u.id , d.nombre , d.apellido, d.telefono , d.direccion , u.total_venta , u.fecha , u.hora , u.tipo_pago');
		//Con un Join relaciono los "id" de ambas tablas para generar una sola con todos los datos
		$builder->join('usuarios d','u.id = d.id');
		//Guardo el contenido de la relacion de ambas tablas en la variable $ventas
		$ventas= $builder->get();
		//Vuelvo a guardar toda la info pero en la forma de un array para mejor manejo.
		$datos['ventas']=$ventas->getResultArray();
		//print_r($datos);
		//exit;
        
        $data['titulo']='Listado de Compras';
		echo view('navbar/navbar'); 
        echo view('header/header',$data);        
        echo view('comprasXcliente/ListaTurnos_view',$datos);
        echo view('footer/footer');
    }

	public function ListCompraDetalle($id){
		
		$db = db_connect();
		$TotalVenta = $db->table('ventas_cabecera vc');
		$TotalVenta->where('id',$id);
		$TotalVenta->select('vc.total_venta');
		$Total= $TotalVenta->get();
		$VC_total['Totalcv']= $Total->getResultArray();

		$builder = $db->table('ventas_detalle u');
		$builder->where('venta_id',$id);
		$builder->select('d.id , d.nombre , u.cantidad , u.precio , u.total');
		$builder->join('productos d','u.producto_id = d.id');
		$ventas= $builder->get();
		$datos['ventas']=$ventas->getResultArray();

		//print_r($datos);
		//exit;
        
        $data['titulo']='Listado de Compras'; 
		echo view('navbar/navbar');
        echo view('header/header',$data);        
        echo view('comprasXcliente/CompraDetalle_view',$datos+$VC_total);
        echo view('footer/footer');
    }

    public function productosAgregados(){
        $cart = \Config\Services::cart();
		$carrito['carrito']=$cart->contents();
        $data['titulo']='Productos en el Carrito'; 
		echo view('navbar/navbar');
        echo view('header/header',$data);        
        echo view('carrito/ProductosEnCarrito',$carrito);
        echo view('footer/footer');
    }

    //Agrega elemento al carrito
	function add()
	{
        $cart = \Config\Services::cart();
        // Genera array para insertar en el carrito
		$cart->insert(array(
            'id'      => $_POST['id'],
            'qty'     => 1,
            'price'   => $_POST['precio_vta'],
            'name'    => $_POST['nombre'],
            
         ));
		 session()->setFlashdata('msg','Producto Agregado!');
        // Redirige a la misma página que se encuentra
		return redirect()->to(base_url('catalogo'));
	}

	//Agrega elemento al carrito desde confirmar
	function agregar()
	{
        $cart = \Config\Services::cart();
        // Genera array para insertar en el carrito
		$id_producto = uniqid('prod_') . random_int(100000, 999900);
		$cart->insert(array(
            'id'      => $id_producto,
            'qty'     => 1,
            'price'   => $_POST['precio_vta'],
            'name'    => $_POST['nombre'],
            
         ));
		 session()->setFlashdata('msg','Producto Agregado!');
        // Redirige a la misma página que se encuentra
		return redirect()->to(base_url('CarritoList'));
	}

	//Agrega elemento al carrito desde confirmar
	function agregarDesdeListaProd()
	{
        $cart = \Config\Services::cart();
        // Genera array para insertar en el carrito
		$id_producto = uniqid('prod_') . random_int(100000, 999900);
		$cart->insert(array(
            'id'      => $id_producto,
            'qty'     => 1,
            'price'   => $_POST['precio_vta'],
            'name'    => $_POST['nombre'],
            
         ));
		 session()->setFlashdata('msg','Producto Agregado!');
        // Redirige a la misma página que se encuentra
		return redirect()->to(base_url('catalogo'));
	}

    //Elimina elemento del carrito o el carrito entero
	function remove($rowid){
        $cart = \Config\Services::cart();
        //Si $rowid es "all" destruye el carrito
		if ($rowid==="all")
		{
			$cart->destroy();
		}
		else //Sino destruye sola fila seleccionada
		{
			session()->setFlashdata('msg','Producto Eliminado');
            // Actualiza los datos
			$cart->remove($rowid);
		}
		
        // Redirige a la misma página que se encuentra
		return redirect()->to(base_url('CarritoList'));
	}

    //Actualiza el carrito que se muestra
	function actualiza_carrito()
    {
        $cart = \Config\Services::cart();
	    // Recibe los datos del carrito, calcula y actualiza
       	$cart_info =  $_POST['cart'];
		
		foreach( $cart_info as $id => $carrito)
		{   
			$prod = new Productos_model();
			$idprod = $prod->getProducto($carrito['id']);
			if($carrito['id'] < 100000){
			$stock = $idprod['stock'];
			}
 		    $rowid = $carrito['rowid'];
	    	$price = $carrito['price'];
	    	$amount = $price * $carrito['qty'];
	    	$qty = $carrito['qty'];

			if($carrito['id'] < 100000){
			if($qty <= $stock && $qty >= 1){ 
            $cart->update(array(
                'rowid'   => $rowid,
                'price'   => $price,
                'amount' =>  $amount,
                'qty'     => $qty
                ));	    	
			}else{
				session()->setFlashdata('msgEr','La Cantidad Solicitada de algunos productos no estan disponibles o SELECCIONASTE 0!');
			}
			}
		    
	    }

		session()->setFlashdata('msg','Carrito Actualizado!');
		// Redirige a la misma página que se encuentra
		return redirect()->to(base_url('CarritoList'));
	}

    //Muestra los detalles de la venta y confirma(función guarda_compra())
	function muestra_compra()
	{
		$data['titulo'] = 'Confirmar compra';
		echo view('navbar/navbar');
		echo view('header/header',$data);		
		echo view('carrito/confirmarCompra');
		echo view('footer/footer');
    }

    //Guarda los datos de la venta en la base de datos
    public function guarda_compra()
	{
        $cart = \Config\Services::cart();
		$session = session();
        $usuario_id= $session->get('id');
		$tipo_Pago= $_POST['tipo_pago'];
		$total = $_POST['total_venta'];
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$hora = date('H:i:s');
		$fecha = date('d-m-Y');
		//print_r($hora);
		//exit;

        $cabecera_model = new Cabecera_model();
		$ventas_id = $cabecera_model->save([
            'fecha' 		=> $fecha,
			'hora'			=> $hora,
			'usuario_id' 	=> $usuario_id,
			'total_venta'	=> $total,
			'tipo_pago'		=> $tipo_Pago

        ]);
		//Rescato el ID de la cabecera que se guardo para asignarle al venta_id del detalle.
		$id_cabecera = $cabecera_model->getInsertID();
		
		//Si el carrito no esta vacio guarda cada una de las ventas detalle.
		//Uso el numero que trae $id_cabecera para relacionar esta venta cabecera con cada venta detalle y guardar en venta_id.
		if ($cart):
		//print_r($cart);
		//exit;	
			foreach ($cart->contents() as $item):
                $VentaDetalle_model = new VentaDetalle_model();
            	$cust_id = $VentaDetalle_model->save([
                    'venta_id' 		=> $id_cabecera,
					'producto_id' 	=> $item['id'],
					'cantidad' 		=> $item['qty'],
					'precio' 		=> $item['price'],
					'total' 		=> $item['subtotal']
        
                ]);

            	//Descuenta del stock y lo guarda en la base de datos
                $Producto_model = new Productos_model();
            	$producto = $Producto_model->getProducto($item['id']);
            	
				if($item['id'] < 100000){
					$stock = $producto['stock'];
                }
				if($item['id'] < 100000){
            	$stock_edit = $stock - 	$item['qty'];
				$datos=[
				'stock'  => $stock_edit,
				];
				
            	$producto = $Producto_model->update($item['id'],$datos);
				}
            	

			endforeach;
		endif;

		$cart->destroy();
		session()->setFlashdata('msg','Compra Guardada con Éxito!');
		return redirect()->to(base_url('/catalogo'));

	}

	//Muestra los detalles de la venta y confirma(función guarda_compra())
	function GraciasPorSuCompra()
	{
		$data['titulo'] ='Confirmar Realizada';
		echo view('navbar/navbar');
		echo view('header/header',$data);		
		echo view('carrito/GraciasCompra_view');
		echo view('footer/footer');
    }

	function FacturaAdmin($id)
	{
		//$dompdf = new Dompdf();

		$db = db_connect();
		$builder2 = $db->table('ventas_cabecera a');
		$builder2->where('a.id',$id);
		$builder2->select('a.id , c.nombre , c.apellido, c.telefono , c.direccion , a.total_venta , a.fecha , a.tipo_pago');
		$builder2->join('usuarios c','a.usuario_id = c.id');
		$ventas2= $builder2->get();
		$datos2['datos']=$ventas2->getResultArray();
		//print_r($datos2);
		//exit;

		$builder = $db->table('ventas_detalle u');
		$builder->where('venta_id',$id);
		$builder->select('d.id , d.nombre , u.cantidad , u.precio , u.total ,');
		$builder->join('productos d','u.producto_id = d.id');
		$ventas= $builder->get();
		$datos['ventas']=$ventas->getResultArray();
		//print_r($datos);
		//exit;
		
		$data['titulo'] ='Factura';
		echo view('navbar/navbar');
		echo view('header/header',$data);		
		echo view('comprasXcliente/facturacion_view',$datos2+$datos);
		echo view('footer/footer');

		//$html = view('back/Admin/facturacion_view',$datos2+$datos);
		//$dompdf->loadHtml('Hola loco');
		//$dompdf->setPaper('A4', 'landscape');
		//$dompdf->render();
		//$dompdf->stream('demoFactura.pdf',['attachment' => false]);
	}

	function FacturaCliente($id)
	{
		//$dompdf = new Dompdf();

		$db = db_connect();
		$builder2 = $db->table('ventas_cabecera a');
		$builder2->where('a.id',$id);
		$builder2->select('a.id , c.nombre , c.apellido, c.telefono , c.direccion , a.total_venta , a.fecha , a.tipo_pago');
		$builder2->join('usuarios c','a.usuario_id = c.id');
		$ventas2= $builder2->get();
		$datos2['datos']=$ventas2->getResultArray();
		//print_r($datos2);
		//exit;

		$builder = $db->table('ventas_detalle u');
		$builder->where('venta_id',$id);
		$builder->select('d.id , d.nombre , u.cantidad , u.precio , u.total ,');
		$builder->join('productos d','u.producto_id = d.id');
		$ventas= $builder->get();
		$datos['ventas']=$ventas->getResultArray();
		//print_r($datos);
		//exit;
		
		$data['titulo'] ='Factura';
		echo view('navbar/navbar');
		echo view('header/header',$data);		
		echo view('comprasXcliente/facturacion_view',$datos2+$datos);
		echo view('footer/footer');

		//$html = view('back/Admin/facturacion_view',$datos2+$datos);
		//$dompdf->loadHtml('Hola loco');
		//$dompdf->setPaper('A4', 'landscape');
		//$dompdf->render();
		//$dompdf->stream('demoFactura.pdf',['attachment' => false]);
	}
}