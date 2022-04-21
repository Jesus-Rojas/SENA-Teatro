<?php

  session_start();
  if ($_SESSION['databaseTmp']) {
    echo $_SESSION['databaseTmp'];
  } else {
    include_once('../database/index.php');
    $datos = Datos::obtenerSillas();
    $_SESSION['databaseTmp'] = $datos;
    echo $datos;
  }

?>