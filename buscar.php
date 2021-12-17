<?php
session_start();
$_SESSION['localizacion'] = "Búsqueda";
?>
<!-- ======= HTML5 ======= -->
<!DOCTYPE html>
<html lang="en">
<!-- ======= head ======= -->
<?php
include("head.php");
?>

<!-- ======= Script necesario, no se si meterlo a head ======= -->


<body>
  <!-- ======= Header ======= -->
  <?php
  include("header.php");
  include("liga.php");
  include("consumidor.php");
  ?>
  <!-- ======= Cuerpo index ======= -->
  <br>
  <br><br><br><br><br><br>
  <?php
  $new = new CurlRequest();
  //Elimine la liga, por que no estoy en otro directorio
  $resultado = $new->sendGet(liga() . '/personas.php?estados', null);

  $resp = json_decode($resultado, true);
  ?>
  <div class="container">

    <div class="rendered-form">
      <div class="formbuilder-select form-group field-estado">
        <label for="estado" class="formbuilder-select-label">Estado:</label>
        <select class="form-control" name="estado" id="estado" onchange="EstadoSel(this.value)">
          <option value="NA">--Seleccionar Estado--</option>
          <?php
          foreach ($resp as $i) {
            echo  '<option value="' . $i['ultimaEntidad'] . '" id="' . $i['ultimaEntidad'] . '">' .  $i['ultimaEntidad'] . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="formbuilder-select form-group field-estado" id="muni">
        <label for="municipio" class="formbuilder-select-label">Municipio:</label>
        
      </div>
    </div>



  </div>

  <script>
    function EstadoSel(estado) {
      if (estado != "NA") {
        document.getElementById("muni").innerHTML = estado;
      }
    }
  </script>






  <!-- ======= Fin cuerpo index ======= -->


  <!-- JS -->
  <?php
  include("js.php");
  ?>



</body>

</html>