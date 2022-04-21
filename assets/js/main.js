let accion = document.getElementById('accion')
let fila = document.getElementById('fila')
let puesto = document.getElementById('puesto')

function mapa(res) {
  let html = 
  `<div class="d-flex justify-content-center">
    <div class="d-inline-block text-white casilla"></div>
    <div class="d-inline-block text-white casilla">1</div>
    <div class="d-inline-block text-white casilla">2</div>
    <div class="d-inline-block text-white casilla">3</div>
    <div class="d-inline-block text-white casilla">4</div>
    <div class="d-inline-block text-white casilla">5</div>
  </div>`;
  res.forEach((iterator, index) => {
    html += '<div class="d-flex justify-content-center">';
    html += `<div class="d-inline-block text-white casilla">${index+1}</div>`;
    for (const iterar of iterator) {
      html += `<div class="d-inline-block text-white casilla">${iterar.text}</div>`;
    }
    html += '</div>';
  });
  document.getElementById('respuesta').innerHTML = html;
}

function armar(res) {
  let arreglo = [], row = 0;
  for (const iterator of res) {
    if(row < iterator.row) {
      row = iterator.row
    }
  }
  for (let i = 0; i < row; i++) {
    const filtro = res.filter(data => data.row == i+1)
    arreglo.push([...filtro])
  }
  for (const iterator of arreglo) {
    iterator.sort((a,b) => {
      if (a.col > b.col) {
        return 1
      }
      if (a.col < b.col) {
        return -1
      }
      return 0
    })
  }
  return arreglo;
}

function resetForm() {
  accion.value = ''
  fila.value = ''
  puesto.value = ''
}

async function obtenerDatos() {
  const peticion = await fetch('./controller/readController.php')
  const respuesta = await peticion.json();
  mapa(armar(respuesta))
}

async function enviarDatos(){
  if ([accion.value, fila.value, puesto.value].includes('')) {
    new Toast({
      message: 'Algunos campos se encuentran vacios verifica !!!',
      type: 'danger'
    });
    return
  }
  if (!fila.value || fila.value < 0) {
    new Toast({
      message: 'La fila debe ser un numero valido',
      type: 'danger'
    });
    return
  }
  if (!puesto.value || puesto.value < 0) {
    new Toast({
      message: 'El puesto debe ser un numero valido',
      type: 'danger'
    });
    return
  }
  const formData = new FormData();
  formData.append('accion', accion.value)
  formData.append('fila', fila.value)
  formData.append('columna', puesto.value)
  const peticion = await fetch('./controller/transaccionController.php', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: formData
  })
  const { status, mensaje } = await peticion.json()
  if (status) {
    new Toast({
      message: mensaje,
      type: 'success'
    });
    resetForm();
    obtenerDatos();
  } else {
    new Toast({
      message: mensaje,
      type: 'warning'
    });
  }
}

obtenerDatos();