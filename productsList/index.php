<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../product/product.entidad.php';
require_once '../product/product.model.php';
require_once '../category/category.entidad.php';
require_once '../category/category.model.php';
require_once 'productsList.entidad.php';
require_once 'productsList.model.php';

// Logica
$prod = new Product();
$prod_model = new ProductModel();
$cate = new Category();
$cate_model = new CategoryModel();
$prli = new ProductsList();
$prli_model = new ProductsListModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$prli->__SET('productsList_id',              $_REQUEST['productsList_id']);
                        $prli->__SET('prli_ts_session',              $_REQUEST['prli_ts_session']);
			$prli->__SET('prli_product_id',          $_REQUEST['prli_product_id']);
			$prli->__SET('prli_quantity',        $_REQUEST['prli_quantity']);

			$prli_model->Actualizar($prli);
			header('Location: index.php');
			break;

		case 'registrar':
			$prli->__SET('prli_ts_session',          $_REQUEST['prli_ts_session']);
                        $prli->__SET('prli_product_id',          $_REQUEST['prli_product_id']);
			$prli->__SET('prli_quantity',        $_REQUEST['prli_quantity']);

			$prli_model->Registrar($prli);
			header('Location: index.php');
			break;

		case 'eliminar':
			$prli_model->Eliminar($_REQUEST['productsList_id']);
			header('Location: index.php');
			break;

		case 'editar':
			$prli = $prli_model->Obtener($_REQUEST['productsList_id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Lista de productos</title>
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
                    <li >
                        <a href="/ecommerce/index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="/ecommerce/category/index.php">Categorias</a>
                    </li>
                    <li>
                        <a href="/ecommerce/product/index.php">Productos</a>
                    </li>
                    <li class="active">
                        <a href="index.php">Lista de Productos</a>
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

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $prli->productsList_id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="productsList_id" value="<?php echo $prli->__GET('productsList_id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">prli_ts_session</th>
                            <td><input type="text" name="prli_ts_session" value="<?php echo $prli->__GET('prli_ts_session'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">prli_product_id</th>
                            <td><input type="text" name="prli_product_id" value="<?php echo $prli->__GET('prli_product_id'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">prli_quantity</th>
                            <td><input type="text" name="prli_quantity" value="<?php echo $prli->__GET('prli_quantity'); ?>" style="width:100%;" /></td>
                        </tr>

                        
                        <!-- tr>
                            <th style="text-align:left;">Categoría de Producto</th>
                            <td>
                                <select name="prod_category_id">
                                    <?php foreach($cate_model->Listar() as $r): ?>
                                        <option value="<?php echo $r->__GET('category_id'); ?>" <?php if ($prli->__GET('prod_category_id') == $r->__GET('category_id')) echo "selected"; ?>><?php echo $r->__GET('cate_name'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr -->
                        
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">prli_ts_session</th>
                            <th style="text-align:left;">prli_product_id</th>
                            <th style="text-align:left;">prli_quantity</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($prli_model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('prli_ts_session'); ?></td>
                            <td><?php echo $r->__GET('prli_product_id'); ?></td>
                            <td><?php echo $r->__GET('prli_quantity'); ?></td>

                            <!-- td><?php echo $cate_model->Obtener($r->__GET('prod_category_id'))->__GET('cate_name');  ?> </td -->
                            
                            <td>
                                <a href="?action=editar&productsList_id=<?php echo $r->productsList_id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&productsList_id=<?php echo $r->productsList_id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?> 
                </table>     
              
            </div>
        </div>

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> 
    </body>
</html>