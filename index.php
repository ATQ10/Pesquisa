<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$_SESSION['localizacion'] = "Inicio";
?>
<!-- ======= head ======= -->
<?php
include("head.php");
//modifique el archivo de liga por mis problemas  
include("liga.php");
?>

<body>
  <!-- ======= Header ======= -->
  <?php include("header.php");

  include("consumidor.php"); ?>
  <!-- ======= Cuerpo index ======= -->
  <br><br><br><br><br>

  <div class="container d-flex flex-wrap">
    <?php

    $new = new CurlRequest();
    //Elimine la liga, por que no estoy en otro directorio
    $resultado = $new->sendGet(liga().'/personas.php?all', null);

    $resp = json_decode($resultado, true);

    foreach ($resp as $i) {
      echo  '<div class="card" style="width: 18rem; margin-left:  10px; margin-bottom:  10px;">';
      if($i['sexo']=="HOMBRE")
        echo '<img class="card-img-top" src="img/hombre.jpg" height="100px"  width="100px" alt="Imagen de hombre">';
      else
        echo '<img class="card-img-top" src="img/mujer.jpg" height="100px"  width="100px" alt="Imagen de mujer">';
      echo '<div class="card-body">
        <h5 class="card-title">Visto Por Ultima Vez</h5>
        <p class="card-text">En '. $i['ultimoLugar'] . ', municipio de : '. $i['ultimoMunicipio'] . ', Estado de: '. $i['ultimaEntidad'] . ', <br>  ' . $i['ultimaFecha'] . '</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Nombre: ' . $i['nombre'] .' '. $i['ape_pat'] .' '. $i['ape_mat'] . '</li>
        <li class="list-group-item">Sexo: ' . $i['sexo'] . ' Edad: ' . $i['edad'] . '</li>
        <li class="list-group-item">ID:' . $i['id'] . '</li>
      </ul>
      <div class="card-body">
        <a href="persona.php?id='.$i['id'].'" class="card-link">Ver Persona</a>
      </div>
    </div>';
    }


    ?>
  </div>

  


  <!-- ======= Fin cuerpo index ======= -->


  <!-- JS -->
  <?php
  include("js.php");
  ?>

 <!--
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  -->
</body>

</html>