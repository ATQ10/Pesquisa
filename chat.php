<?php
    session_start();
    $_SESSION['localizacion']="Chat Dinámico";
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
  <br><br><br><br>

  <div class="container">
    <div class="row">
      <center>
        <div class="col-lg-8">
          <iframe id="inlineFrameExample"
            title="Inline Frame Example"
            width="100%"
            height="500"
            src="https://chat-dinamico-sockets.herokuapp.com/?usuario=<?php echo $_SESSION['nombre'];?>">
          </iframe>
        </div>
      </center>
    </div>
  </div>

  <!-- ======= Fin nuevo ======= -->
  <!-- JS -->
  <?php
  include ("js.php");
  ?>
</body>

</html>