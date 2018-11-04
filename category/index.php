<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'category.entidad.php';
require_once 'category.model.php';

// Logica
$prod = new Category();
$model = new CategoryModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$prod->__SET('category_id',              $_REQUEST['category_id']);
			$prod->__SET('cate_name',          $_REQUEST['cate_name']);
			$prod->__SET('cate_description',        $_REQUEST['cate_description']);

			$model->Actualizar($prod);
			header('Location: index.php');
			break;

		case 'registrar':
			$prod->__SET('cate_name',          $_REQUEST['cate_name']);
			$prod->__SET('cate_description',        $_REQUEST['cate_description']);

			$model->Registrar($prod);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['category_id']);
			header('Location: index.php');
			break;

		case 'editar':
			$prod = $model->Obtener($_REQUEST['category_id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="UTF-8">
	    <title>Categoria</title>
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
                    <li class="active">
                        <a href="category/">Categorias</a>
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
           <h2>Nuestras categorias de productos</h2>  
         <div class="pure-g">
            <div class="pure-u-1-12">
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Descripcion</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('cate_name'); ?></td>
                            <td><?php echo $r->__GET('cate_description'); ?></td>
                            
                            <td>
                                <a href="?action=editar&category_id=<?php echo $r->category_id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&category_id=<?php echo $r->category_id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>    
                <p></p> 
                <h2>Registro de una categoria</h2> 
                <form action="?action=<?php echo $prod->category_id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="category_id" value="<?php echo $prod->__GET('category_id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="cate_name" value="<?php echo $prod->__GET('cate_name'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="cate_description" value="<?php echo $prod->__GET('cate_description'); ?>" style="width:100%;" /></td>
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