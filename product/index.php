<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'product.entidad.php';
require_once 'product.model.php';
require_once '../category/category.entidad.php';
require_once '../category/category.model.php';

// Logica
$prod = new Product();
$prod_model = new ProductModel();
$cate = new Category();
$cate_model = new CategoryModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$prod->__SET('product_id',              $_REQUEST['product_id']);
			$prod->__SET('prod_name',          $_REQUEST['prod_name']);
			$prod->__SET('prod_description',        $_REQUEST['prod_description']);
                        $prod->__SET('prod_size',        $_REQUEST['prod_size']);
                        $prod->__SET('prod_price',        $_REQUEST['prod_price']);
                        $prod->__SET('prod_offerPrice',        $_REQUEST['prod_offerPrice']);
                        $prod->__SET('prod_stock',        $_REQUEST['prod_stock']);
                        $prod->__SET('prod_imgName',        $_REQUEST['prod_imgName']);
                        $prod->__SET('prod_category_id',        $_REQUEST['prod_category_id']);

			$prod_model->Actualizar($prod);
			header('Location: index.php');
			break;

		case 'registrar':
			$prod->__SET('prod_name',          $_REQUEST['prod_name']);
			$prod->__SET('prod_description',        $_REQUEST['prod_description']);
                        $prod->__SET('prod_size',        $_REQUEST['prod_size']);
                        $prod->__SET('prod_price',        $_REQUEST['prod_price']);
                        $prod->__SET('prod_offerPrice',        $_REQUEST['prod_offerPrice']);
                        $prod->__SET('prod_stock',          $_REQUEST['prod_stock']);
                        $prod->__SET('prod_imgName',          $_REQUEST['prod_imgName']);
                        $prod->__SET('prod_category_id',          $_REQUEST['prod_category_id']);

			$prod_model->Registrar($prod);
			header('Location: index.php');
			break;

		case 'eliminar':
			$prod_model->Eliminar($_REQUEST['product_id']);
			header('Location: index.php');
			break;

		case 'editar':
			$prod = $prod_model->Obtener($_REQUEST['product_id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Productos</title>
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
                    <li class="active">
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
        
        <h2>Productos registrados</h2>    
         

        <div class="pure-g">
            <div class="pure-u-1-12">
                
               

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Producto</th>
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Talla</th>
                            <th style="text-align:left;">Precio</th>
                            <th style="text-align:left;">Precio de Oferta</th>
                            <th style="text-align:left;">Stock</th>
                            <th style="text-align:left;">Imagen</th>
                            <th style="text-align:left;">Categoría de Producto</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($prod_model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('prod_name'); ?></td>
                            <td><?php echo $r->__GET('prod_description'); ?></td>
                            <td><?php echo $r->__GET('prod_size'); ?></td>
                            <td><?php echo $r->__GET('prod_price'); ?></td>
                            <td><?php echo $r->__GET('prod_offerPrice'); ?></td>
                            <td><?php echo $r->__GET('prod_stock'); ?></td>
                            <td><?php echo $r->__GET('prod_imgName'); ?></td>
                            <td><?php echo $cate_model->Obtener($r->__GET('prod_category_id'))->__GET('cate_name');  ?> </td>
                            
                            <td>
                                <a href="?action=editar&product_id=<?php echo $r->product_id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&product_id=<?php echo $r->product_id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?> 
                </table>     
                <p> </p>
              <h2>Registro de productos</h2>
               <form action="?action=<?php echo $prod->product_id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="product_id" value="<?php echo $prod->__GET('product_id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Producto</th>
                            <td><input type="text" name="prod_name" value="<?php echo $prod->__GET('prod_name'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="prod_description" value="<?php echo $prod->__GET('prod_description'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Talla</th>
                            <td><input type="text" name="prod_size" value="<?php echo $prod->__GET('prod_size'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Precio</th>
                            <td><input type="text" name="prod_price" value="<?php echo $prod->__GET('prod_price'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Precio de Oferta</th>
                            <td><input type="text" name="prod_offerPrice" value="<?php echo $prod->__GET('prod_offerPrice'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Stock</th>
                            <td><input type="text" name="prod_stock" value="<?php echo $prod->__GET('prod_stock'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Imagen</th>
                            <td><input type="text" name="prod_imgName" value="<?php echo $prod->__GET('prod_imgName'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Categoría de Producto</th>
                            <td>
                                <select name="prod_category_id">
                                    <?php foreach($cate_model->Listar() as $r): ?>
                                        <option value="<?php echo $r->__GET('category_id'); ?>" <?php if ($prod->__GET('prod_category_id') == $r->__GET('category_id')) echo "selected"; ?>><?php echo $r->__GET('cate_name'); ?></option>
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