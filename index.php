<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    
<?php

    require_once("conexion.php");

    $conexion=$base->query("SELECT * FROM pruebas.datos_usuarios");

    // $base=$base->query("SELECT * FROM ");

    // $registro=$base->fetchAll(PDO::FETCH_OBJ);

    //----------------------paginación-----------------

        $tamaño_pagina = 3;

        if(isset($_GET["pagina"])) {

            if($_GET["pagina"]==1){

                header("Location:index.php");

            }else {

                $pagina=$_GET["pagina.php"];

            }
        }else {
            $pagina = 1;
        }

        $empezar_desde = ($pagina-1)*$tamaño_pagina;

        $sql_total = "SELECT * FROM datos_usuarios";

        $resultado = $base->prepare($sql_total);

        $resultado->execute(array());

        $num_filas=$resultado->rowCount();

        $total_paginas = ceil($num_filas/$tamaño_pagina);

    //----------------------------------------------------------------

    $registro=$base->query("SELECT * FROM datos_usuarios LIMIT $empezar_desde, $tamaño_pagina")->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST["cr"])) {

        $nombre = $_POST["Nom"];

        $apellido = $_POST["Ape"];

        $direccion = $_POST["Dir"];

        $sql="INSERT INTO datos_usuarios (NOMBRE, APELLIDO, DIRECCION) VALUES (:nom, :ape, :dir)";

        $resultado=$base->prepare($sql);

        $resultado->execute(array(":nom"=>$nombre, ":ape"=>$apellido, ":dir"=>$direccion));

        header("Location:index.php");
    }

?>

<h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<table width="50%" border="0" align="center">
    <tr>
    <td class="primera_fila">ID</td>
    <td class="primera_fila">Nombre</td>
    <td class="primera_fila">Apellido</td>
    <td class="primera_fila">Direccion</td>
    <td class="sin">&nbsp;</td>
    <td class="sin">&nbsp;</td>
    <td class="sin">&nbsp;</td>
    </tr>

    <?php

    foreach($registro as $persona): 
    //sustituir '{}' por ':' para el foreach y endforeach al final del bucle php;
    ?>
    

    <tr>
    <td><?php echo $persona->ID?> </td>
    <td><?php echo $persona->Nombre?> </td>
    <td><?php echo $persona->Apellido?></td>
    <td><?php echo $persona->Direccion?></td>

    <td class="bot"><a href="borrar.php?ID=<?php echo $persona->ID?>"><input type="button" name="del" id="del" value="Borrar"></a></td>
    <td class="bot"><input type="button" name="up" id="up" value="Actualizar"></td>

    </tr>

    <?php
    endforeach;

    ?>

    <tr>
        <td></td>
        <td><input type="text" name="Nom" size="10" class="centrado"></td>
        <td><input type="text" name="Ape" size="10" class="centrado"></td>
        <td><input type="text" name="Dir" size="10" class="centrado"></td>
        <td class="bot"><input type="submit" name="cr" id="cr" value="Insertar"></td></tr>
        <tr><td>
            <?php

        //------------PAGINACIÓN-------------------

        for($i=0; $i<=$total_paginas; $i++){

            echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";
        }

            ?>
        </td></tr>

</table>
</form>

</body>
</html>