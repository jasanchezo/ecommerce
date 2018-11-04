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

// var_dump($_SESSION['cart']);

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
        
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        
        <title>Carrito</title>
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
                    <li>
                        <a href="/ecommerce/sale/index.php">Ventas</a>
                    </li>
                    
                    <li class="active">
                        <a href="carrito.php">Carrito</a>
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
        
        <p>
        <h2>Carrito de Compras</h2>
        <?php
            if (isset($_SESSION['email'])) {
                echo $_SESSION['email'];
                if (count($_SESSION['cart']) > 0)
                    echo " | <a href='confirma.php'>CONFIRMAR COMPRA</a>";
            } else echo "<a href='registro.php'>Registro de Usuario</a>";
            
        ?>
        
        </p>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align:left;">Nombre</th>
                    <th style="text-align:left;">Descripcion</th>
                    <th style="text-align:left;">Talla</th>
                    <th style="text-align:left;">Precio</th>
                    <!-- th style="text-align:left;">Stock</th -->
                    <th style="text-align:left;">Imagen</th>
                    <!-- th style="text-align:left;">Categoría de Producto</th -->
                    <th style="text-align:left;">Cantidad</th>
                    <th></th>
                    <!-- th></th -->
                </tr>
            </thead>
            <?php 
                $index = 0;
                foreach($_SESSION['cart'] as $k => $r): 
                    //$index++;
            ?>
                <tr>
                    <td><?php echo $prod_model->Obtener($r[0])->__GET('prod_name'); ?></td>
                    <td><?php echo $prod_model->Obtener($r[0])->__GET('prod_description'); ?></td>
                    <td><?php echo $prod_model->Obtener($r[0])->__GET('prod_size'); ?></td>                    
                    <?php
                        if ($prod_model->Obtener($r[0])->__GET('prod_offerPrice') > 0 && $prod_model->Obtener($r[0])->__GET('prod_offerPrice') < $prod_model->Obtener($r[0])->__GET('prod_price')) {
                    ?>
                    <td>Oferta <?php echo $prod_model->Obtener($r[0])->__GET('prod_offerPrice'); ?></td>
                        <?php } else { ?>
                    <td><?php echo $prod_model->Obtener($r[0])->__GET('prod_price'); ?></td>
                        <?php } ?>
                    <td><?php echo $prod_model->Obtener($r[0])->__GET('prod_imgName'); ?></td>
                    <td><?php echo $r[1]; ?></td>

                    <td>
                        <a href="quitarCarrito.php?action=quitar&cart_id=<?php echo $k; ?>">Quitar</a>
                    </td>
                    <!--td>
                        <a href="?action=eliminar&product_id=<?php echo $r->product_id; ?>">Eliminar</a>
                    </td -->
                </tr>
            <?php 
            endforeach; ?> 
        </table>     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        
    </body>
</html>
