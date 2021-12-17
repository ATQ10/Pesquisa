<?php
    session_start();
    $_SESSION['localizacion']="Chat global";
    if(@$_SESSION['autentificado']!=TRUE)
        header('Location: login.php');
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



  <!-- ======= Fin nuevo ======= -->
  <!-- JS -->
  <?php
  include ("js.php");
  ?>

</body>

</html>