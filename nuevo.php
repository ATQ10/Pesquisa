<?php
session_start();
$_SESSION['localizacion'] = "Nuevo reporte";
if(@$_SESSION['autentificado']!=TRUE)
header('Location: login.php');
?>
<!-- ======= HTML5 ======= -->
<!DOCTYPE html>
<html lang="en">
<!-- ======= head ======= -->
<?php
include("head.php");
include("liga.php");
include("consumidor.php");
?>

<body>
  <!-- ======= Header ======= -->
  <?php
  include("header.php");

  $new = new CurlRequest();
  $resultado = $new->sendGet(liga() . '/personas.php?estados', null);
  $estados = json_decode($resultado, true);
  ?>
  <!-- ======= Cuerpo nuevo ======= -->
  <br><br><br><br>

  <div class="container">
    <form action="">


      <div>
        <div>
          <label>Ultima Fecha</label>
          <input type="date" class="form-control" name="date-1639683650582" access="false" id="date-1639683650582">
        </div>
        <div>
          <label for="text-1639683659065">Nombre(s):</label>
          <input type="text" class="form-control" name="text-1639683659065" access="false" id="text-1639683659065">
        </div>
        <div>
          <label for="text-1639683659472">Apellido Paterno:&nbsp;</label>
          <input type="text" class="form-control" name="text-1639683659472" access="false" id="text-1639683659472">
        </div>
        <div>
          <label for="text-1639683661728">Apellido Materno:&nbsp;</label>
          <input type="text" class="form-control" name="text-1639683661728" access="false" id="text-1639683661728">
        </div>
        <div>
          <label for="autocomplete-1639683664472">Ultimo Pais:</label>
          <select class="form-control" name="estado" id="estado" onchange="EstadoSel(this.value)">
            <option value="MEXICO">MEXICO</option>
            
          </select>

        </div>
        <div class="formbuilder-select form-group field-estado">
          <label for="estado" class="formbuilder-select-label">Estado:</label>
          <select class="form-control" name="estado" id="estado" onchange="EstadoSel(this.value)">
            <option value="NA">--Seleccionar Estado--</option>
            <?php
            foreach ($estados as $i) {
              echo  '<option value="' . $i['ultimaEntidad'] . '" id="' . $i['ultimaEntidad'] . '">' .  $i['ultimaEntidad'] . '</option>';
            }
            ?>
          </select>
        </div>
        <div>
          <label for="text-1639683669581">Clave Entidad</label>
          <input type="text" class="form-control" name="text-1639683669581" access="false" id="text-1639683669581">
        </div>
        <div>
          <label for="autocomplete-1639683683793">Ultimo Municipio</label>
        </div>
        <div>
          <label for="autocomplete-1639684484462" class="formbuilder-autocomplete-label">Origen:</label>
        </div>
        <div>
          <label for="autocomplete-1639684487136" class="formbuilder-autocomplete-label">Nacionalidad:</label>
        </div>
        <div>
          <label for="select-1639684497175" class="formbuilder-select-label">Sexo</label>
        </div>
        <div>
          <label for="text-1639684504491" class="formbuilder-text-label">Edad</label>
          <input type="tel" class="form-control" name="text-1639684504491" access="false" maxlength="2" id="text-1639684504491">
        </div>
        <div>
          <label for="text-1639684510578" class="formbuilder-text-label">Autoridad Denuncia:</label>
          <input type="text" class="form-control" name="text-1639684510578" access="false" id="text-1639684510578">
        </div>
        <div>
          <label for="text-1639684925273" class="formbuilder-text-label">Ultimo Lugar Visto:&nbsp;</label>
          <input type="text" class="form-control" name="text-1639684925273" access="false" id="text-1639684925273">
        </div>
        <div>
          <label for="date-1639684513993" class="formbuilder-date-label">Fecha Denuncia</label>
          <input type="date" class="form-control" name="date-1639684513993" access="false" id="date-1639684513993">
        </div>
        <div>
          <label for="autocomplete-1639684521466" class="formbuilder-autocomplete-label">Entidad De Denuncia</label>

        </div>

    </form>


  </div>


  <!-- ======= Fin nuevo ======= -->
  <script>
    function EstadoSel(estado) {
      if (estado != "NA") {
        document.getElementById("muni").innerHTML = estado;
      }
    }
  </script>
  <!-- JS -->
  <?php
  include("js.php");
  ?>

</body>

</html>