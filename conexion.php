<?php

    try{

        $base=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $base->exec("SET CHARACTER SET utf8");

    }catch(Exception $e){

        die ("Linea del error: " . $e->getLine());
        echo "El mensaje del error: " . $e->getMessage();

    }


?>