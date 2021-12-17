<?php
    include("liga.php");
    include("consumidor.php");
    $new = new CurlRequest();
    $data = $_POST;
    //echo var_dump($data);
    //Elimine la liga, por que no estoy en otro directorio
    $resultado = $new->sendPost(liga().'/personas.php', $data);
 
    $resp = json_decode($resultado, true);
    $resp = str_replace("\"","",$resp);
    if(is_numeric($resp)){
        echo "<script type=\"text/javascript\">alert(\"Registro exitoso\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"index.php\";</script>";
    }else{
        echo "<script type=\"text/javascript\">alert(\"Intente más tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
?>