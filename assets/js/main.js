async function obtenerDatos() {
  const datos = new FormData()
  datos.append('auth', 'loggin');
  
  const peticion = await fetch('./controller/readController.php', {
    'Content-Type': 'application/json',
    method: 'POST',
    body: datos
  })
  const respuesta = await peticion.json();
  // armar(respuesta)
  mapa(armar(respuesta))
}

function mapa(res) {
  let html = 
  `<div>
    <div class="d-inline-block casilla border-none"></div>
    <div class="d-inline-block casilla">1</div>
    <div class="d-inline-block casilla">2</div>
    <div class="d-inline-block casilla">3</div>
    <div class="d-inline-block casilla">4</div>
    <div class="d-inline-block casilla">5</div>
  </div>`;

  for (const iterator of object) {
    
  }
  

  console.log(html)
  document.getElementById('respuesta').innerHTML = html
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
  return arreglo;
}

function toggleButaca(id) {
  
}

// obtenerDatos();