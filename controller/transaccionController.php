<?php
  
  if (isset($_POST['fila']) && isset($_POST['columna']) && isset($_POST['accion'])) {
    /* Validar Request, mensaje de error */
    $condicion = true;
    switch ($_POST['accion']) {
      case 'reservar':
        $condicion = false;
        break;
      case 'comprar':
        $condicion = false;
        break;
      case 'liberar':
        $condicion = false;
        break;
    }
    if ($condicion) {
      echo json_encode([
        'status' => false,
        'mensaje' => 'La accion debe ser (reservar | comprar | liberar)',
      ]);
      return;
    }
    /* Casting, consultando datos de session */
    $row = (int) $_POST['fila'];
    $col = (int) $_POST['columna'];
    $datos = json_decode(verificarSession(), true);
    /* Consultar si existe el registro en bd */
    $registro = null;
    foreach ($datos as $value) {
      if ($value['row'] == $row && $value['col'] == $col) {
        $registro = $value;
        break;
      }
    }
    /* Mensaje de error si no existe */
    if (!$registro) {
      echo json_encode([
        'status' => false,
        'mensaje' => 'No existe el registro, verifica !!'
      ]);
      return;
    }
    /* Validar accion */
    switch ($registro['text']) {
      case 'L':
        if ($_POST['accion'] == 'reservar' || $_POST['accion'] == 'comprar') {
          if ($_POST['accion'] == 'reservar') {
            $registro = transaccion($registro, 'R', $datos);
            $mensaje = 'reservo';
          } else {
            $registro = transaccion($registro, 'V', $datos);
            $mensaje = 'vendio';
          }
          echo json_encode([
            'status' => true,
            'mensaje' => "La silla se $mensaje con exito",
            'data' => $registro
          ]);
        } else {
          echo json_encode([
            'status' => false,
            'mensaje' => 'No se puede liberar, verifica !!',
          ]);
        }
        return;      
      default:
        if ($_POST['accion'] == 'liberar') {
          $registro = transaccion($registro, 'L', $datos);
          echo json_encode([
            'status' => true,
            'mensaje' => "La silla se libero con exito",
            'data' => $registro
          ]);
        } else {
          echo json_encode([
            'status' => false,
            'mensaje' => 'No se puede '.$_POST['accion'].', verifica !!',
          ]);
        }
        return;
    }

    echo json_encode([
      'status' => true,
      'mensaje' => 'Todo bien',
      'data' => $registro
    ]);
    return;
  }
  echo json_encode([
    'status' => false,
    'mensaje' => 'Faltan algunos campos verifica!!',
  ]);

  function verificarSession() {
    session_start();
    if (!$_SESSION['databaseTmp']) {
      include_once('../database/index.php');
      $_SESSION['databaseTmp'] = Datos::obtenerSillas();
    }
    return $_SESSION['databaseTmp'];
  }

  function transaccion($registro, $accion, $datosOld) {
    $datosNew = [];
    $registro['text'] = $accion;
    foreach ($datosOld as $value) {
      if (!($value['row'] == $registro['row'] && $value['col'] == $registro['col'])) {
        array_push($datosNew, $value);
      }
    }
    array_push($datosNew, $registro);
    $_SESSION['databaseTmp'] = json_encode($datosNew);
    return $registro;
  }
?>