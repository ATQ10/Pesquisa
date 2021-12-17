<?php
session_start();
$_SESSION['localizacion'] = "Persona";
$id = @$_GET['id'];
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
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<body>
  <!-- ======= Header ======= -->
  <?php
  include("header.php");

  $new = new CurlRequest();
  $resultado = $new->sendGet(liga() . '/personas.php?id='.$id, null);
  $personas = json_decode($resultado, true);
  //echo var_dump($personas);
  $persona = $personas[0];
    //Esto se debe a que algunas versiones PHP no soportan dicha función
    if (!function_exists('str_contains')) {
        function str_contains(string $haystack, string $needle): bool
        {
            return '' === $needle || false !== strpos($haystack, $needle);
        }
    }
  
  try{
    if(str_contains($persona['ultimaFecha'], '/'))
            $persona['ultimaFecha'] = DateTime::createFromFormat('d/m/y', $persona['ultimaFecha'])->format('Y-m-d');
    if(str_contains($persona['denunciaFecha'], '/'))
        $persona['denunciaFecha'] = DateTime::createFromFormat('d/m/y', $persona['denunciaFecha'])->format('Y-m-d');
      $ubicacion = $persona['ultimoMunicipio'].", ".$persona['ultimaEntidad'].", ".$persona['ultimoPais'];
}catch(Exception $e){

}
  
  ?>
  <!-- ======= Cuerpo nuevo ======= -->
  <br><br><br><br>

  <div class="container">
  <div class="row">
  <div class="col-lg-6">
    <h1>Información detallada</h1>
    <form action="" method="">
      <div>
        <div>
          <label for="ultimaFecha">Ultima Fecha</label>
          <input type="date" class="form-control" value="<?=$persona['ultimaFecha'];?>" name="ultimaFecha" id="ultimaFecha" readonly>
        </div>
        <div>
          <label for="nombre">Nombre(s):</label>
          <input type="text" class="form-control" value="<?=$persona['nombre'];?>"  name="nombre" id="nombre" readonly>
        </div>
        <div>
          <label for="ape_pat">Apellido Paterno:&nbsp;</label>
          <input type="text" class="form-control" value="<?=$persona['ape_pat'];?>"  name="ape_mat" id="ape_pat" readonly>
        </div>
        <div>
          <label for="ape_mat">Apellido Materno:&nbsp;</label>
          <input type="text" class="form-control" value="<?=$persona['ape_mat'];?>"  name="ape_mat" id="ape_mat" readonly>
        </div>
        <div>
          <label for="ultimoPais">Ultimo Pais:</label>
          <select class="form-control" name="ultimoPais" id="ultimoPais" readonly>
            <option value="<?=$persona['ape_mat'];?>"><?=$persona['ultimoPais'];?></option>
          </select>
        </div>
        <div>
          <label for="ultimaEntidad">Ultima Entidad:</label>
          <select class="form-control" name="ultimaEntidad" id="ultimaEntidad" readonly>
            <option value="<?=$persona['ultimaEntidad'];?>"><?=$persona['ultimaEntidad'];?></option>
          </select>
        </div>
        </div>
        <div>
          <label for="claveEntidad">Clave Entidad</label>
          <input type="text" class="form-control" value="<?=$persona['claveEntidad'];?>"  name="claveEntidad" id="claveEntidad" readonly>
        </div>
        <div>
          <label for="ultimoMunicipio">Ultimo Municipio</label>
          <input type="text" class="form-control" value="<?=$persona['ultimoMunicipio'];?>"  name="ultimoMunicipio" id="ultimoMunicipio" readonly>
        </div>
        <div>
          <label for="origen">Origen:</label>
          <input type="text" class="form-control" value="<?=$persona['origen'];?>"  name="origen" id="origen" readonly>
        </div>
        <div>
          <label for="nacionalidad">Nacionalidad:</label>
          <input type="text" class="form-control" value="<?=$persona['nacionalidad'];?>"  name="nacionalidad" id="nacionalidad" readonly>
        </div>
        <div>
          <label for="sexo">Sexo:</label>
          <input type="text" class="form-control" value="<?=$persona['sexo'];?>"  name="sexo" id="sexo" readonly>
        </div>
        <div>
          <label for="edad">Edad:</label>
          <input type="number" class="form-control" value="<?=$persona['edad'];?>"  name="edad" id="edad" readonly>
        </div>
        <div>
          <label for="ultimoLugar">Ultimo Lugar Visto:&nbsp;</label>
          <input type="text" class="form-control" value="<?=$persona['ultimoLugar'];?>" name="ultimoLugar" id="ultimoLugar" readonly>
        </div>
        <div>
          <label for="autoridadDenuncia">Autoridad Denuncia:</label>
          <input type="text" class="form-control" value="<?=$persona['autoridadDenuncia'];?>" name="autoridadDenuncia" id="autoridadDenuncia" readonly>
        </div>
        <div>
          <label for="denunciaFecha">Fecha Denuncia</label>
          <input type="text" class="form-control" value="<?=$persona['denunciaFecha'];?>" name="denunciaFecha" id="denunciaFecha" readonly>
        </div>
        <div>
          <label for="entidadDenuncia">Entidad De Denuncia</label>
          <input type="text" class="form-control" value="<?=$persona['entidadDenuncia'];?>" name="entidadDenuncia" id="entidadDenuncia" readonly>

        </div>

    </form>
</div>

<div class="col-lg-6">
<h1>Última ubicación</h1>
<iframe id="inlineFrameExample"
    title="Inline Frame Example"
    width="100%"
    height="500"
    src="mapa.php?ubicacion=<?php echo $ubicacion;?>">
</iframe>
</div>
    </div>
  </div>


  <!-- ======= Fin nuevo ======= -->
  <!-- JS -->
  <?php
  include("js.php");
  ?>

</body>

</html>