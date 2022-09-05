<?php

    include("conexion.php");

    $ID=$_GET["ID"];

    $base->query("DELETE FROM pruebas.datos_usuarios WHERE ID='$ID'");

    header("Location:index.php");


?>