<?php
    session_start();
    $_SESSION['localizacion']="Registrarse";
    if(@$_SESSION['autentificado']==TRUE)
        header('Location: index.php');
?>
<!-- ======= HTML5 ======= -->
<!DOCTYPE html>
<html lang="en">
<!-- ======= head ======= -->
<?php
include ("head.php");
?>
<body>
  <!-- ======= Header ======= -->
  <?php
  include ("header.php");
  ?>
  <!-- ======= Cuerpo nuevo ======= -->

  <div class="registro">
      <img src="img/desconocido.png" class="logo" alt="logo">
      <h1>Registro</h1>
      <form method="POST" action="registrar.php">
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba su nombre" name="nombre" required>
        <!-- Ape Pat INPUT -->
        <span>Apellido Paterno</span>
        <input class="text" type="text" placeholder="Escriba su apellido paterno" name="ape_pat" required>
        <!-- Ape Mat INPUT -->
        <span>Apellido Materno</span>
        <input class="text" type="text" placeholder="Escriba su apellido materno" name="ape_mat" required>
        <span>Email</span>
        <input class="text" type="text" placeholder="Escriba su email" name="email" required>
        <!-- Contraseña INPUT -->
        <span>Contraseña</span>
        <input class="password" type="password" placeholder="Escriba su contraseña" name="password" required>
        <!-- Contraseña INPUT -->
        <span>Confirmar contraseña</span>
        <input class="password" type="password" placeholder="Confirme su contraseña" name="cpassword" required>
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Registrar">
        <a href="login.php">¿Ya tienes una cuenta?</a>
      </form>
    </div>

  <!-- ======= Fin nuevo ======= -->
  <!-- JS -->
  <?php
  include ("js.php");
  ?>

</body>

</html>