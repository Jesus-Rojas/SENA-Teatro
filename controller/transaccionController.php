<?php

  // include_once('./bd.php');
  // echo Datos::obtenerSillas();

  if ($_POST['auth']) {
    include_once('./bd.php');
    echo Datos::obtenerSillas();
  } else {
    echo 'No tienes permiso para ingresar a esta ruta';
  }

?>