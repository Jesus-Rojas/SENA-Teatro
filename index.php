<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Desarrrollo Web PHP</title>
  <link rel="stylesheet" href="./assets/css/toast.min.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
  <div class="text-center">
    <h1 class="text-white pt-4">Teatro</h1>
    <div class="text-center" id="respuesta"></div>
    <div class="form">
      <div class="pb-custom">
        <input id="fila" type="number" placeholder="Fila">
      </div>
      <div class="pb-custom">
        <input id="puesto" type="number" placeholder="Puesto">
      </div>
      <div class="pb-custom">
        <select id="accion">
          <option value="" selected disabled>Seleccione</option>
          <option value="comprar">Comprar</option>
          <option value="liberar">Liberar</option>
          <option value="reservar">Reservar</option>
        </select>
      </div>
      <div>
        <button onclick="enviarDatos()">Enviar</button>
        <button onclick="resetForm()">Borrar</button>
      </div>
    </div>
  </div>
  <script src="./assets/js/toast.min.js"></script>
  <script src="./assets/js/main.js"></script>
</body>
</html>