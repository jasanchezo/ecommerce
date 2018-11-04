<?php

/* require_once './product/product.entidad.php';
require_once './product/product.model.php';
require_once './category/category.entidad.php';
require_once './category/category.model.php'; */
require_once './people/people.entidad.php';
require_once './people/people.model.php';

// Logica
/* $prod = new Product();
$prod_model = new ProductModel();
$cate = new Category();
$cate_model = new CategoryModel(); */
$peop = new People();
$peop_model = new PeopleModel();

session_start();

// var_dump($_SESSION['cart']);

if (isset($_POST['email']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
    $peop->__SET('peop_email', $_POST['email']);
    $peop->__SET('peop_firstName', $_POST['firstName']);
    $peop->__SET('peop_lastName', $_POST['lastName']);
    $peop_model->Registrar($peop);
    $_SESSION['email'] = $_POST['email'];
}

if (isset($_POST['email'])) {
    $peop_model->ObtenerPorEmail($_POST['email']);
    $_SESSION['email'] = $_POST['email'];
}

unset($_POST['email'], $_POST['firstName'], $_POST['lastName']);

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
        
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        
        <title>Registro</title>
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
                        <a href="/ecommerce/carrito.php">Carrito</a>
                    </li>
                    
                    <li class="active">
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
        
        <p>
        <h2>Registro de Usuario</h2>
       <?php
            if (isset($_SESSION['email'])) {
                echo "USUARIO REGISTRADO: " . $_SESSION['email'];
            } else {

            
        ?>
        
        </p>
        
       <!-- <div class="pure-g">
         <div class="pure-u-1-12">-->
       <!-- <p>*/-->
        <form action="registro.php" method="post">
            <!--Correo<input type="text" name="email"/><br/>
            Nombre(s)<input type="text" name="firstName" /><br/>
            Apellido(s)<input type="text" name="lastName"/><br/>
            <input type="submit" value="Registrar" />-->
            
            <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Correo</th>
                            <td><input type="text" name="email" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Nombre(s)</th>
                            <td><input type="text" name="firstName" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Apellido(s)</th>
                            <td><input type="text" name="lastName" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Registrar" class="pure-button pure-button-primary">
                            </td>
                        </tr>
                    </table>
        </form>
        <!--</p>-->
        
        
       
        <h2>Acceso de Usuario Registrado</h2>
        <form action="registro.php" method="post">
            <input type="hidden" name="login" value="1">
            email<input type="text" name="email"/><br/>
            <input type="submit" value="Acceder" class="pure-button pure-button-primary"/>
        </form>
            <?php
            
            } ?>
        <!--     </div>
        </div>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        
    </body>
</html>
