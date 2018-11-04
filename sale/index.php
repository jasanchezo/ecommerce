<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'sale.entidad.php';
require_once 'sale.model.php';
require_once '../productsList/productsList.entidad.php';
require_once '../productsList/productsList.model.php';
require_once '../people/people.entidad.php';
require_once '../people/people.model.php';

// Logica
$sale = new Sale();
$sale_model = new SaleModel();
$peop = new People();
$peop_model = new PeopleModel();
$prli = new ProductsList();
$prli_model = new ProductsListModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$sale->__SET('sale_id',              $_REQUEST['sale_id']);
			$sale->__SET('sale_prli_ts_session',          $_REQUEST['sale_prli_ts_session']);
			$sale->__SET('sale_status',        $_REQUEST['sale_status']);
                        $sale->__SET('sale_people_id',        $_REQUEST['sale_people_id']);

			$sale_model->Actualizar($sale);
			header('Location: index.php');
			break;

		case 'registrar':
			$sale->__SET('sale_prli_ts_session',          $_REQUEST['sale_prli_ts_session']);
			$sale->__SET('sale_status',        $_REQUEST['sale_status']);
                        $sale->__SET('sale_people_id',        $_REQUEST['sale_people_id']);

			$sale_model->Registrar($sale);
			header('Location: index.php');
			break;

		case 'eliminar':
			$sale_model->Eliminar($_REQUEST['sale_id']);
			header('Location: index.php');
			break;

		case 'editar':
			$sale = $sale_model->Obtener($_REQUEST['sale_id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ventas</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	</head>
    <body>
        <nav class="navbar navbar-default" rol="navegation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle collapsed" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="index.php">Tienda en Línea</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/ecommerce/index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="/ecommerce/category/index.php">Categorias</a>
                    </li>
                    <li>
                        <a href="/ecommerce/product/index.php">Productos</a>
                    </li>
                    <li>
                        <a href="/ecommerce/productsList/index.php">Lista de Productos</a>
                    </li>
                    <li>
                        <a href="/ecommerce/people/index.php">Usuarios</a>
                    </li>
                    <li class="active">
                        <a href="/ecommerce/sale/index.php">Ventas</a>
                    </li>
                    
                    <li>
                        <a href="/ecommerce/carrito.php">Carrito</a>
                    </li>
                    
                    <li>
                        <a href="/ecommerce/registro.php">Registro</a>
                    </li>
                    <?php
                        if (isset($_SESSION['email'])) {
                    ?>
                    <li>
                        <a href="logout.php">Cerrar sesión</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
        
        <h2>Ventas</h2>

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">TS de Sesion de Lista de Productos</th>
                            <th style="text-align:left;">Estatus</th>
                            <th style="text-align:left;">Correo del Usaurio</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($sale_model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('sale_prli_ts_session'); ?></td>
                            <td><?php echo $r->__GET('sale_status'); ?></td>
                            <td><?php echo $peop_model->Obtener($r->__GET('sale_people_id'))->__GET('peop_email'); ?></td>
                            
                            <td>
                                <a href="?action=editar&sale_id=<?php echo $r->sale_id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&sale_id=<?php echo $r->sale_id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
                <h2>Estatus de la venta</h2>
                <form action="?action=<?php echo $sale->sale_id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="sale_id" value="<?php echo $sale->__GET('sale_id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">TS de Sesion de Lista de Productos</th>
                            <!-- td><input type="text" name="sale_prli_ts_session" value="<?php echo $sale->__GET('sale_prli_ts_session'); ?>" style="width:100%;" /></td -->
                            <td>
                                <select name="sale_prli_ts_session">
                                    <?php foreach ($prli_model->ListarTS() as $r):  ?> 
                                        <option value="<?php echo $r->__GET('prli_ts_session'); ?>" <?php if ($r->__GET('prli_ts_session') == $sale->__GET('sale_prli_ts_session')) echo 'selected'; ?> ><?php echo $r->__GET('prli_ts_session'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Estatus</th>
                            <td><input type="text" name="sale_status" value="<?php echo $sale->__GET('sale_status'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Correo del Usuario</th>
                            <!-- td><input type="text" name="sale_people_id" value="<?php echo $sale->__GET('sale_people_id'); ?>" style="width:100%;" /></td -->
                            <td>
                                <select name="sale_people_id">
                                    <?php foreach ($peop_model->Listar() as $r):  ?>
                                        <option value="<?php echo $r->__GET('people_id'); ?>" <?php if ($r->__GET('people_id') == $sale->__GET('sale_people_id')) echo 'selected'; ?> ><?php echo $r->__GET('peop_email'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                
              
            </div>
        </div>

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> 
    </body>
</html>