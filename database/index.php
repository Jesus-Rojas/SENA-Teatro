<?php

class Datos {
  public static function obtenerSillas()
  {
    $sillas = [];
    $increment = 1;
    for ($row=0; $row < 5; $row++) { 
      for ($col=0; $col < 5; $col++) { 
        array_push($sillas, [
          'row' => $row + 1,
          'col' => $col + 1,
          'text' => 'L',
        ]);
        $increment++;
      }
    }
    return json_encode($sillas);
  }
}

?>