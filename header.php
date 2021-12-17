<header id="header" class="fixed-top d-flex align-items-center ">

    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">Pesquisa</a></h1>
      <?php
      if(isset($_SESSION['nombre']))
      echo'<span style="color: white;">  
        Bienvenid@ '.$_SESSION['nombre'].' 
      </span>';
      ?>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link <?php if($_SESSION['localizacion']=='Inicio') echo 'active';?>" href="index.php">Inicio</a></li>
          <li><a class="nav-link <?php if($_SESSION['localizacion']=='Búsqueda') echo 'active';?>" href="buscar.php">Búsqueda</a></li>
          <li><a class="nav-link <?php if($_SESSION['localizacion']=='Nuevo reporte') echo 'active';?>" href="nuevo.php">Nuevo reporte</a></li>
          <li><a class="nav-link <?php if($_SESSION['localizacion']=='Chat global') echo 'active';?>" href="chat.php">Chat global</a></li>
          <?php
            if(@!$_SESSION['autentificado']){
          ?>
            <li><a class="nav-link <?php if($_SESSION['localizacion']=='Iniciar sesión') echo 'active';?>" href="login.php">Iniciar sesión</a></li>
            <li><a class="nav-link <?php if($_SESSION['localizacion']=='Registrarse') echo 'active';?>" href="registro.php">Registrarse</a></li>
          <?php
          }else{
          ?>
            <li><a class="nav-link" href="desconectar.php">Cerrar sesión</a></li>
          <?php
            }
          ?>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->