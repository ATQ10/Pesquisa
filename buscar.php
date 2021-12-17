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
  //echo $resultado;
  ?>
  <div class="container ">

    <div class="d-flex justify-content-between flex-wrap">
      <div class="formbuilder-text form-group p-3">
        <label for="nom" class="formbuilder-text-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" access="false" id="nombre">
      </div>
      <div class="formbuilder-select form-group field-estado p-3">
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
      <div class="formbuilder-select form-group field-municipio p-3" id="muni">
        <label for="municipio" class="formbuilder-select-label">Municipio:</label>
        <select class="form-control" name="municipio" id="municipio">
          <option value="NA">--Seleccionar Municipio--</option>
        </select>

      </div>
      <div class="btnchido p-4">
        <button onclick="search()" class="btn btn-secondary btn-lg">Buscar</button>
      </div>
    </div>
          <br><hr><br>
    <div class="container">

      <div class="d-flex justify-content-between flex-wrap" id="contsearch">
       
      </div>
    </div>
  </div>
 

  <script>
    async function EstadoSel(estado) {
      if (estado != "NA") {
        const response = await fetch('desaparecidos/personas.php?estados&entidad=' + estado);
        const municipios = await response.json();
        var options = document.getElementById("municipio");
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

    async function search() {
      var nom = document.getElementById("nombre").value;
      var est = document.getElementById("estado").value;
      var mun = document.getElementById("municipio").value;
      
      var byname = null
      var items = document.getElementById("contsearch");
      var concatprofiles = "";

      if(nom == "" && est == "NA" && mun == "NA") {
        concatprofiles = ' <span class="text-center"> <h1>Necesitas Ingresar Criterios De Busqueda</h1> </span>';
      }else if(nom != "" && est == "NA") {
        //solo nombre
        const response1 = await fetch('desaparecidos/personas.php?nombre=' + nom + '');
         byname = await response1.json();
      }else if(nom != "" && est != "NA" && mun == "NA"){
        //nombre y estado
        const response2 = await fetch('desaparecidos/personas.php?nombre=' + nom + '&entidad=' + est);
         byname = await response2.json();
      }else if(nom == "" && est != "NA" && mun == "NA"){
        //estado
        const response3 = await fetch('desaparecidos/personas.php?nombre=' + nom + '&entidad=' + est);
         byname = await response3.json();
      }else if(nom == "" && est != "NA" && mun != "NA"){
        //nombre y municipio
        const response4 = await fetch('desaparecidos/personas.php?nombre=' + nom + '&entidad=' + est);
         byname = await response4.json();
      } else{
        //nombre, estado y municipio
        const response5 = await fetch('desaparecidos/personas.php?nombre=' + nom + '&entidad=' + est);
         byname = await response5.json();
      }

      if(byname != null){
        for (var i = 0; i < byname.length; i++) {
          //console.log(byname[i]);

          concatprofiles += '<div id="' + byname[i]["id"] + '" class="card" style="width: 18rem; margin-left:  10px; margin-bottom:  10px;">';

          if (byname[i]['sexo'] == "HOMBRE")
            concatprofiles += '<img class="card-img-top" src="img/hombre.jpg" height="100px"  width="100px" alt="Imagen de hombre">';
          else
            concatprofiles += '<img class="card-img-top" src="img/mujer.jpg" height="100px"  width="100px" alt="Imagen de mujer">';

            concatprofiles += '<div class="card-body"> <h5 class = "card-title" > Visto Por Ultima Vez </h5> <p class = "card-text" > En ' + byname[i]["ultimoLugar"] + ', municipio de: ' + byname[i]["ultimoMunicipio"] + ', Estado de: ' + byname[i]["ultimaEntidad"] + ', <br> ' + byname[i]["ultimaFecha"] + ' </p> </div> <ul class = "list-group list-group-flush" >   <li class = "list-group-item" > Nombre: ' + byname[i]["nombre"] + ' ' + byname[i]["ape_pat"] + ' ' +  byname[i]["ape_mat"] + ' </li> <li class = "list-group-item" > Sexo: ' + byname[i]["sexo"] + '  Edad: ' + byname[i]["edad"] + ' </li> <li class = "list-group-item" > ID: ' + byname[i]["id"] + ' </li> </ul> <div class = "card-body" ><a href = "persona.php?id=' + byname[i]["id"] + '" class = "card-link" > Ver Persona </a> </div> </div>';
        }
      }

        items.innerHTML = concatprofiles;
    }//end search
  </script>






  <!-- ======= Fin cuerpo index ======= -->


  <!-- JS -->
  <?php
  include("js.php");
  ?>



</body>

</html>