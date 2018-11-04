<?php

require_once './product/product.entidad.php';
require_once './product/product.model.php';
require_once './category/category.entidad.php';
require_once './category/category.model.php';

// Logica
$prod = new Product();
$prod_model = new ProductModel();
$cate = new Category();
$cate_model = new CategoryModel();

session_start();

if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}



?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda on line</title>
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
                    <li class="active">
                        <a href="index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="category/index.php">Categorias</a>
                    </li>
                    <li>
                        <a href="product/index.php">Productos</a>
                    </li>
                    <li>
                        <a href="productsList/index.php">Lista de Productos</a>
                    </li>
                    <li>
                        <a href="people/index.php">Usuarios</a>
                    </li>
                    <li>
                        <a href="sale/index.php">Ventas</a>
                    </li>
                    
                    <li>
                        <a href="carrito.php">Carrito</a>
                    </li>
                    
                    <li>
                        <a href="registro.php">Registro</a>
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
    <div class="jumbotron">
        <h1>Tienda Online</h1>
        <p class="lead"></p>
        <p><a href="registro.php" class="btn btn-primary btn-lg">Registrate &raquo;</a></p>
    </div>

        <p>
        <h2>Nuestros productos</h2>
        <!--<?php
            if (isset($_SESSION['email'])) {
                echo $_SESSION['email'];
            } else echo "<a href='registro.php'>Registro de Usuario</a>";
            
        ?>-->
        </p>
       
        <table class="table table-striped pure-table-horizontal">
            <thead>
                <tr>
                    <th style="text-align:left;">Nombre</th>
                    <th style="text-align:left;">Descripcion</th>
                    <th style="text-align:left;">Talla</th>
                    <th style="text-align:left;">Precio</th>
                    <!-- th style="text-align:left;">Stock</th -->
                    <th style="text-align:left;">Imagen</th>
                    <th style="text-align:left;">Categoría de Producto</th>
                    <th style="text-align:left;">Cantidad</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach($prod_model->Listar() as $r): 
                if ($r->__GET('prod_stock') > 0) {
            ?>
                <tr>
                    <form action="agregarCarrito.php" method="GET">
                        <input type="hidden" name="action" value="agregar">
                        <input type="hidden" name="product_id" value="<?php echo $r->__GET('product_id'); ?>">
                    <td><?php echo $r->__GET('prod_name'); ?></td>
                    <td><?php echo $r->__GET('prod_description'); ?></td>
                    <td><?php echo $r->__GET('prod_size'); ?></td>
                    <?php
                        if ($r->__GET('prod_offerPrice') > 0 && $r->__GET('prod_offerPrice') < $r->__GET('prod_price')) {
                    ?>
                    <td>Oferta <?php echo $r->__GET('prod_offerPrice'); ?></td>
                        <?php } else { ?>
                    <td><?php echo $r->__GET('prod_price'); ?></td>
                        <?php } ?>
                    <!-- td><?php echo $r->__GET('prod_stock'); ?></td -->
                    <td><?php echo $r->__GET('prod_imgName'); ?></td>
                    <td><?php echo $cate_model->Obtener($r->__GET('prod_category_id'))->__GET('cate_name');  ?> </td>
                
                    <td><input type="number" name="quantity"></td>

                    <!-- td>
                        <a href="?action=agregar&product_id=<?php echo $r->product_id; ?>">Agregar</a>
                    </td -->
                    <!-- td>
                        <a href="?action=eliminar&product_id=<?php echo $r->product_id; ?>">Eliminar</a>
                    </td -->
                    <td><input type="submit" value="Agregar" /></td>
                    </form>
                </tr>
            <?php 
                }
            endforeach; ?> 
        </table>     
        
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> 
    </body>
    
</html>
