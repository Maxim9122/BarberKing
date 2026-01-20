<br>
 <?php $cart = \Config\Services::cart(); ?>
 <?php $session = session();
          $nombre= $session->get('nombre');
          $apellido = $session->get('apellido');
          $perfil=$session->get('perfil_id');
          $email=$session->get('email');
          $telefono=$session->get('telefono');
          $direccion=$session->get('direccion');
          ?>
 <?php 
 //print_r($clientes);
 //exit;
    $gran_total = 0;

    // Calcula gran total si el carrito tiene elementos
    if ($cart):
        foreach ($cart->contents() as $item):
            $gran_total = $gran_total + $item['subtotal'];
        endforeach;
    endif;
 ?>

<style>
.tableResponsive{
    width: 50%;
    text-align: center;
}
@media screen and (max-width: 768px) {
.tableResponsive{
    width: 100%;
}
}

/*Estilos para los selectores de fecha, cliente y tipo compra*/
.selector {
    width: 85%;
    padding: 8px;
    border: 2px solid #50fa7b;
    background-color: #282a36;
    color: #f8f8f2;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
}

.selector:focus {
    outline: none;
    border-color: #8be9fd;
    box-shadow: 0 0 5px #8be9fd;
}

/*Estilos para los botones de confirmar, cancelar modif o volver*/
.botones-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center; /* Centra los botones horizontalmente */
    padding: 15px;
}

.btn {
    padding: 10px 20px;
    background-color: #50fa7b;
    color: #282a36;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
    transition: background 0.3s;
    text-align: center;
    display: inline-block;
}

.btn:hover {
    background-color: #8be9fd;
}

.danger {
    background-color: #ff5555;
    color: white;
}

.danger:hover {
    background-color: #ff4444;
}

/* Responsive */
@media (max-width: 600px) {
    .botones-container {
        flex-direction: column;
        align-items: center;
    }

    .btn {
        width: 100%;
        text-align: center;
    }
}

</style>

<div class="comprados" style="width:50%;">
    <div id="">

    <?php // Crea formulario para guardar los datos de la venta
echo form_open("confirma_compra", ['class' => 'form-signin', 'role' => 'form']);
?>
<div align="center">
    <u><i><h2 align="center">Resumen de la Compra</h2></i></u>
    <br>
    <table>
        <tr>
            <td style="color:black; font-weight:bold;font-size: 17px;">
                Total de la Compra:
            </td>
            <td>
                <strong>$<?php echo number_format($gran_total, 2); ?></strong>
            </td>
        </tr>
        <tr>
            <td style="color:black; font-weight:bold;">
                Cajero/a:
            </td>
            <td style="color:black; font-weight:bold;">
                <?php echo($nombre) ?>
            </td>
        </tr>
        <!-- 
        <tr>
            <td style="color:black; font-weight:bold;font-size: 17px;">
                Cliente Registrado:
            </td>
            <td>
                <?php if ($clientes): ?>
                    <select name="cliente_id" class="selector">
                        <option value="Anonimo">Seleccione un cliente</option>
                        <?php foreach ($clientes as $cl): ?>
                            <option value="<?php echo $cl['id_cliente']; ?>">
                                <?php echo $cl['nombre'] . ' - ' . $cl['id_cliente']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <span>No hay clientes disponibles</span>
                <?php endif; ?>
            </td>
        </tr> -->

        <tr>
            <td style="color:black; font-weight:bold; font-size: 17px;"><strong>Nombre del Cliente:</strong></td>
            <td>
                <input class="selector" type="text" name="nombre_prov" placeholder="Ingrese nombre cliente" maxlength="20" required>
            </td>
        </tr>

        <tr>
            <td style="color:black; font-weight:bold;font-size: 17px;"><strong>Monto en Efectivo:</strong></td>
            <td>
                <input class="selector" type="text" id="pagoEfectivo" name="pagoEfectivo" 
                       placeholder="Monto en $" maxlength="15" 
                       oninput="calcularMontos();">
            </td>
        </tr>
        <tr>
            <td style="color:black; font-weight:bold; font-size: 17px;"><strong>Monto en Transferencia:</strong></td>
            <td>
                <input class="selector" type="text" id="pagoTransferencia" name="pagoTransferencia" 
                       placeholder="Monto en $" maxlength="15" readonly>
            </td>
        </tr>        

        <!-- Campo oculto con el total de la venta -->
        <?php echo form_hidden('total_venta', $gran_total); ?>
        <input type="hidden" id="total_venta" value="<?= $gran_total; ?>">

    </table>
    <br> <br>
    <a class='btn' href="<?php echo base_url('CarritoList') ?>">Volver</a>
    <input type="submit" name="confirmarPerfil2" value="Confirmar" class="btn">
    <br> <br>
    </div>
    </div>
    <?php echo form_close(); ?>

    </div>
    <br>

<!-- Script para calcular montos -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let totalVenta = parseFloat(document.getElementById("total_venta").value) || 0;
    document.getElementById("pagoTransferencia").value = totalVenta; // Asignar total a transferencia por defecto
});

function calcularMontos() {
    let totalVenta = parseFloat(document.getElementById("total_venta").value) || 0;
    let inputEfectivo = document.getElementById("pagoEfectivo");
    let inputTransferencia = document.getElementById("pagoTransferencia");

    let montoEfectivo = parseFloat(inputEfectivo.value.replace(/[^0-9]/g, '')) || 0;

    if (montoEfectivo > totalVenta) {
        alert("El monto en efectivo no puede ser mayor al total de la compra.");
        inputEfectivo.value = totalVenta; // Ajustar al máximo permitido
        montoEfectivo = totalVenta;
    }

    let montoTransferencia = totalVenta - montoEfectivo;
    inputTransferencia.value = montoTransferencia.toFixed(2);
}
</script>


    <!-- Modal para Perfil 2 (Registrar Compra) -->
<div id="confirmationModalPerfil2" class="modal">
    <div class="modal-content">
        <span class="close" id="closePerfil2">&times;</span>
        <p>¿Registrar Compra.?</p>
        <button id="confirmarRegistro" class="btn">Sí, Registrar</button>
    </div>
</div>
        <!-- Script Modal perfil 2 -->
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const modalConfirmacionPerfil2 = document.getElementById("confirmationModalPerfil2");
    const btnConfirmarPerfil2 = document.querySelector("input[name='confirmarPerfil2']");
    const spanClosePerfil2 = document.getElementById("closePerfil2"); // Cambiado a ID
    const btnConfirmarRegistro = document.getElementById("confirmarRegistro");

    function abrirModal(modal) {
        modal.style.display = "block";
        setTimeout(() => modal.classList.add("show"), 10);
    }

    function cerrarModal(modal) {
        modal.classList.remove("show");
        setTimeout(() => modal.style.display = "none", 300);
    }

    // Abrir modal al hacer clic en "Confirmar"
    btnConfirmarPerfil2.addEventListener("click", function (event) {
        event.preventDefault();
        abrirModal(modalConfirmacionPerfil2);
    });

    // Cerrar modal al hacer clic en "Sí, Registrar"
    btnConfirmarRegistro.addEventListener("click", function () {
        document.querySelector("form").submit();
    });

    // Cerrar modal al hacer clic en la "X"
    spanClosePerfil2.addEventListener("click", function () {
        cerrarModal(modalConfirmacionPerfil2);
    });

    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener("click", function (event) {
        if (event.target == modalConfirmacionPerfil2) {
            cerrarModal(modalConfirmacionPerfil2);
        }
    });

    // Cerrar modal al presionar la tecla Escape
    window.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            cerrarModal(modalConfirmacionPerfil2);
        }
    });
});
</script>

<style>

   /* Estilos para el modal */

.modal {
    display: none; /* Oculto por defecto */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;

    background-color: rgba(0, 0, 0, 0.4);

    padding-top: 60px;
}

/* Agregamos animación de zoom */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 7px solid #888;
    width: 70%;
    max-width: 400px;
    text-align: center;
    transform: scale(0.5); /* Estado inicial pequeño */
    transition: transform 0.3s ease-in-out;
}

.modal-content p {
    font-weight: 750;
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 7px solid #888;
    width: 70%;
    max-width: 400px;
    text-align: center;
}

/* Cuando el modal se muestra, aplicamos el efecto de zoom */
.modal.show .modal-content {
    transform: scale(1); /* Escala normal al abrir */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    font-weight: 700;
    color: red;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
}
</style>

    