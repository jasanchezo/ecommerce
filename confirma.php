<?php

require_once './product/product.entidad.php';
require_once './product/product.model.php';
/* require_once './category/category.entidad.php';
require_once './category/category.model.php'; */

require_once './productsList/productsList.entidad.php';
require_once './productsList/productsList.model.php';
require_once './sale/sale.entidad.php';
require_once './sale/sale.model.php';

require_once './people/people.entidad.php';
require_once './people/people.model.php';

// Logica
$prod = new Product();
$prod_model = new ProductModel();
/* $cate = new Category();
$cate_model = new CategoryModel(); */

$sale = new Sale();
$sale_model = new SaleModel();
$prli = new ProductsList();
$prli_model = new ProductsListModel();

$peop = new People();
$peop_model = new PeopleModel();

session_start();

// $tempCart = $_SESSION['cart'];
// array_push($tempCart, array($_GET['product_id'], $_GET['quantity']));
// $_SESSION['cart'] = $tempCart;
// unset($tempCart);
// var_dump($_SESSION['cart']);

$timeStamp = date('Y-m-d H:i:s');
foreach ($_SESSION['cart'] as $r) {
    $prli->__SET('prli_ts_session', $timeStamp);
    $prli->__SET('prli_product_id', $r[0]);
    $prli->__SET('prli_quantity', $r[1]);
    $prli_model->Registrar($prli);
    
    $prod = $prod_model->Obtener($r[0]);
    $prod->__SET('prod_stock', $prod->__GET('prod_stock')-$r[1]);
    
    $prod_model->Actualizar($prod);
    
}
$sale->__SET('sale_prli_ts_session', $timeStamp);
$sale->__SET('sale_status', 'P');
echo "<br>people_ID: " . var_dump($peop_model->Obtener(1)) . "<br>";
$sale->__SET('sale_people_id', $peop_model->ObtenerPorEmail($_SESSION['email'])->__GET('people_id'));

$sale_model->Registrar($sale);

$_SESSION['cart'] = array();



header('Location: index.php');

// unset($_SESSION['cart']);
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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        
        <title></title>
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
                        <a href="people/index.php">Gente</a>
                    </li>
                    <li>
                        <a href="sale/index.php">Ventas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        
        <p>
        <h2>Carrito de Compras</h2>
        <?php
            echo $_GET['product_id'] . " " . $_GET['quantity'];
            
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
                    <th style="text-align:left;">Categoría de Producto</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach($prod_model->Listar() as $r): 
                if ($r->__GET('prod_stock') > 0) {
            ?>
                <tr>
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

                    <td>
                        <a href="?action=agregar&product_id=<?php echo $r->product_id; ?>">Agregar</a>
                    </td>
                    <!-- td>
                        <a href="?action=eliminar&product_id=<?php echo $r->product_id; ?>">Eliminar</a>
                    </td -->
                </tr>
            <?php 
                }
            endforeach; ?> 
        </table>     
        
        
    </body>
</html>
