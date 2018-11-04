<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   <?php
    
        $conexion = mysqli_connect("localhost","root","","ecommerce");
    
    if (!$conexion){
        
        echo 'Error al conectar';
    }else
    {
        echo 'Conectado a la base datos';
    }
    
    ?>
    
</body>
</html>