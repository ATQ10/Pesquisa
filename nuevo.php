<?php
session_start();
$_SESSION['localizacion'] = "Nuevo reporte";
if (@$_SESSION['autentificado'] != TRUE)
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
    <form name="myFormElement" id="myFormElement">
      <div>
        <div style="visibility: hidden;">
          <label for="number">Ultima Fecha</label>
          <input type="number" class="form-control" value="" name="id" id="id">
        </div>
        <div>
          <label for="ultimaFecha">Ultima Fecha</label>
          <input type="date" class="form-control" value="" name="ultimaFecha" id="ultimaFecha" required>
        </div>
        <div>
          <label for="nombre">Nombre(s):</label>
          <input type="text" class="form-control" value="" name="nombre" id="nombre" required>
        </div>
        <div>
          <label for="ape_pat">Apellido Paterno:&nbsp;</label>
          <input type="text" class="form-control" value="" name="ape_pat" id="ape_pat" required>
        </div>
        <div>
          <label for="ape_mat">Apellido Materno:&nbsp;</label>
          <input type="text" class="form-control" value="" name="ape_mat" id="ape_mat" required>
        </div>
        <div>
          <label for="ultimoPais">Ultimo Pais:</label>
          <select class="form-control" name="ultimoPais" id="ultimoPais" required>
            <option value="Mexico">Mexico</option>
          </select>
        </div>
        <div>
          <label for="ultimaEntidad">Ultima Entidad:</label>
          <select class="form-control" name="ultimaEntidad" id="ultimaEntidad" required onchange="EstadoSel(this.value)">
            <option value="">--Seleccionar Estado--</option>
            <?php
            foreach ($estados as $i) {
              echo  '<option value="' . $i['ultimaEntidad'] . '" id="' . $i['ultimaEntidad'] . '">' .  $i['ultimaEntidad'] . '</option>';
            }
            ?>
          </select>
        </div>
        <div>
          <label for="claveEntidad">Clave Entidad</label>
          <input type="text" class="form-control" value="" name="claveEntidad" id="claveEntidad" required>
        </div>
        <div>
          <label for="ultimoMunicipio">Ultimo Municipio</label>
          <select type="text" class="form-control" value="" name="ultimoMunicipio" id="ultimoMunicipio" required>
            <option value="">--Seleccionar Municipio--</option>
          </select>
        </div>
        <div>
          <label for="origen">Origen:</label>
          <input type="text" class="form-control" value="" name="origen" id="origen" required>
        </div>
        <div>
          <label for="nacionalidad">Nacionalidad:</label>
          <input type="text" class="form-control" value="" name="nacionalidad" id="nacionalidad" required>
        </div>
        <div>
          <label for="sexo">Sexo:</label>
          <select type="text" class="form-control" value="" name="sexo" id="sexo" required>
            <option value="">--Seleccionar --</option>
            <option value="MUJER">Mujer</option>
            <option value="HOMBRE">Hombre</option>
            <option value="N/A">Helicoperto apache o cualquier otra mamada...</option>
          </select>
        </div>
        <div>
          <label for="edad">Edad:</label>
          <input type="number" class="form-control" value="" name="edad" id="edad" required>
        </div>
        <div>
          <label for="ultimoLugar">Ultimo Lugar Visto:&nbsp;</label>
          <input type="text" class="form-control" value="" name="ultimoLugar" id="ultimoLugar" required>
        </div>
        <div>
          <label for="autoridadDenuncia">Autoridad Denuncia:</label>
          <input type="text" class="form-control" value="" name="autoridadDenuncia" id="autoridadDenuncia" required>
        </div>
        <div>
          <label for="denunciaFecha">Fecha Denuncia</label>
          <input type="date" class="form-control" value="" name="denunciaFecha" id="denunciaFecha" required>
        </div>
        <div>
          <label for="entidadDenuncia">Entidad De Denuncia</label>
          <input type="text" class="form-control" value="" name="entidadDenuncia" id="entidadDenuncia" required>
        </div>
      </div>

      <div class="btnchido p-4">
        <button onclick="register()" class="btn btn-secondary btn-lg">Ingresar nuevo Registro</button>
      </div>
    </form>
    <div id="output"></div>

  </div>


  <!-- ======= Fin nuevo ======= -->
  <script>
    function register() {

      
      var formElement = document.getElementById("myFormElement");
      var request = new XMLHttpRequest();

      request.open("POST", "desaparecidos/personas.php");
      

      request.send(new FormData(formElement));

    }

    async function EstadoSel(estado) {
      if (estado != "NA") {
        const response = await fetch('desaparecidos/personas.php?estados&entidad=' + estado);
        const municipios = await response.json();
        var options = document.getElementById("ultimoMunicipio");
        options.innerHTML = "";
        var concat = '<option value="NA">--Seleccionar Municipio--</option>';
        //console.log(municipios[0]['ultimoMunicipio']);
        // echo  '<option value="' . $i['ultimaEntidad'] . '" id="' . $i['ultimaEntidad'] . '">' .  $i['ultimaEntidad'] . '</option>';
        for (var i = 0; i < municipios.length; i++) {
          concat += '<option value="' + municipios[i]["ultimoMunicipio"] + '">' + municipios[i]['ultimoMunicipio'] + '</option>';
        }

        options.innerHTML = concat;

      } else {
        //eliminar busqueda anterior
        document.getElementById("municipio").innerHTML = '<option value="NA">--Seleccionar Municipio--</option>';
      }



    }
  </script>
  <!-- JS -->
  <?php
  include("js.php");
  ?>

</body>

</html>