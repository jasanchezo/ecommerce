<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'people.entidad.php';
require_once 'people.model.php';

// Logica
$peop = new People();
$peop_model = new PeopleModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$peop->__SET('people_id',              $_REQUEST['people_id']);
			$peop->__SET('peop_email',          $_REQUEST['peop_email']);
			$peop->__SET('peop_firstName',        $_REQUEST['peop_firstName']);
                        $peop->__SET('peop_lastName',        $_REQUEST['peop_lastName']);

			$peop_model->Actualizar($peop);
			header('Location: index.php');
			break;

		case 'registrar':
			$peop->__SET('peop_email',          $_REQUEST['peop_email']);
			$peop->__SET('peop_firstName',        $_REQUEST['peop_firstName']);
                        $peop->__SET('peop_lastName',        $_REQUEST['peop_lastName']);

			$peop_model->Registrar($peop);
			header('Location: index.php');
			break;

		case 'eliminar':
			$peop_model->Eliminar($_REQUEST['people_id']);
			header('Location: index.php');
			break;

		case 'editar':
			$peop = $peop_model->Obtener($_REQUEST['people_id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Clientes</title>
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
                    <li  class="active">
                        <a href="index.php">Usuarios</a>
                    </li>
                    <li>
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
    
        <h2>Usuarios registrados</h2>

        <div class="pure-g">
            <div class="pure-u-1-12">
                
               
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Correo</th>
                            <th style="text-align:left;">Nombre(s)</th>
                            <th style="text-align:left;">Apellido(s)</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($peop_model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('peop_email'); ?></td>
                            <td><?php echo $r->__GET('peop_firstName'); ?></td>
                            <td><?php echo $r->__GET('peop_lastName'); ?></td>
                            
                            <td>
                                <a href="?action=editar&people_id=<?php echo $r->people_id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&people_id=<?php echo $r->people_id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>    
                <p></p> 
              <h2>Registro de usuarios</h2>
               <form action="?action=<?php echo $peop->people_id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="people_id" value="<?php echo $peop->__GET('people_id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Correo</th>
                            <td><input type="text" name="peop_email" value="<?php echo $peop->__GET('peop_email'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Nombre(s)</th>
                            <td><input type="text" name="peop_firstName" value="<?php echo $peop->__GET('peop_firstName'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Apellido(s)</th>
                            <td><input type="text" name="peop_lastName" value="<?php echo $peop->__GET('peop_lastName'); ?>" style="width:100%;" /></td>
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