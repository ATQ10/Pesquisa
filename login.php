<?php
    session_start();
    $_SESSION['localizacion']="Iniciar sesión";
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
  <!-- ======= Cuerpo index ======= -->
  <div class="login">
    <img src="img/desconocido.png" class="logo" alt="logo">
    <h1>Iniciar sesión</h1>
    <form method="POST" action="verificar.php">
      <!-- Email INPUT -->
      <span>Email</span>
      <input class="text" type="text" placeholder="Email" name="email" required>
      <!-- Contraseña INPUT -->
      <span>Contraseña</span>
      <input class="password" type="password" placeholder="Contraseña" name="password"  required>
      <!-- Submit INPUT -->
      <input class="submit" type="submit" value="Acceder">
      <a href="registro.php">*Crear nueva cuenta*</a>
    </form>
  </div>
  <!-- ======= Fin cuerpo index ======= -->


  <!-- JS -->
  <?php
  include ("js.php");
  ?>

</body>

</html>