<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Averías Solucionadas</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</head>

<body>

  <main class="container">
    <h4>Averías Solucionadas</h4>
    <table class="table table-sm table-striped table-bordered" id="tabla-solucionados">
      <colgroup>
        <col style="width: 10%;">
        <col style="width: 25%;">
        <col style="width: 35%;">
        <col style="width: 20%;">
        <col style="width: 10%;">
      </colgroup>
      <thead>
        <tr>
          <th>#</th>
          <th>Cliente</th>
          <th>Problema</th>
          <th>Fecha</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      let conn = null;
      const cuerpoTabla = document.querySelector('#tabla-solucionados tbody')

      function connet() {
        //1. Objeto conexión
        conn = new WebSocket('ws://localhost:8080')

        //2. Apertura de conexión
        conn.onopen = function (e) {
          console.log("Conexión establecida")
        }

        //3. Envío de mensaje
        conn.onmessage = function (e) {
          const data = JSON.parse(e.data)
          console.log(data)
          if (data.message === "averiaAtendida"){
            obtenerDatos()
          }
        }

        //4. Cierre de comunicación
        conn.onclose = function (e) {
          console.log("Conexión finalizada")
          setTimeout(connect, 3000)
        }

        //5. Manejo de errores
        conn.onerror = function (e) {
          console.error("Problemas en la conexión")
        }
      }

      async function obtenerDatos() {
        const response = await fetch(`<?= base_url() ?>public/api/averias/solucionados`, { method: 'get' })
        const averias = await response.json()

        cuerpoTabla.innerHTML = ''

        if (averias.length > 0) {
          averias.forEach(averia => {
            const row = cuerpoTabla.insertRow()

            row.insertCell().textContent = averia.id
            row.insertCell().textContent = averia.cliente
            row.insertCell().textContent = averia.problema
            row.insertCell().textContent = averia.fechahora

            const cellEstado = row.insertCell()
            const badge = document.createElement('span')
            badge.textContent = 'Solucionado'
            badge.className = 'badge bg-success'
            cellEstado.appendChild(badge)

          });
        }

      }

      obtenerDatos()
      connet()
    })
  </script>

</body>

</html>
