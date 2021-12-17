<?php
    //Sesión activa se redirecciona a index
    session_start();
    if(@$_SESSION['autentificado']==TRUE)
        header('Location: index.php');
    else{
        //Conectar al servidor Mysql y a la base de datos foro
        include ("conexion.php");
        $conexion = conectarDB();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM `usuario` WHERE `email`='".$_POST['email']."'";
        $result = $conexion->query($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                //verificamos contraseña encriptada en md5
                if($row["password"]== md5($_POST['password'])){
                    //Guardamos info en variables de sesión
                    $_SESSION['autentificado']=TRUE;
                    $_SESSION['idu']=$row["idu"];
                    $_SESSION['nombre']=$row["nombre"];
                    $_SESSION['ape_pat']=$row["ape_pat"];
                    $_SESSION['ape_mat']=$row["ape_mat"];
                    $_SESSION['email']=$row["email"];
                    $_SESSION['password']=$_POST['password'];
                    echo "<script type=\"text/javascript\">alert(\"Bienvenid@\");</script>";
                    echo "<script type=\"text/javascript\">window.location=\"index.php\";</script>";
                }else{
                    //Contraseña incorrecta
                    echo "<script type=\"text/javascript\">alert(\"Contraseña incorrecta\");</script>";
                    echo "<script type=\"text/javascript\">window.history.back();</script>";
                }
            }
        } else {
            //No existe usuario
            echo "<script type=\"text/javascript\">alert(\"No existe usuario\");</script>";
            echo "<script type=\"text/javascript\">window.history.back();</script>";
        }
        mysqli_close($conexion);
    }
?>