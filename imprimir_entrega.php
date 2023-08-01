<!DOCTYPE html>
<html>
<head>
  <title>Ver Envíos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Envíos Realizados</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>
        <td>3333</td>

          <td>3333</td>
          <td>3333</td>

          <td>3333</td>

        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
function imprimirEntrega(nombre, cantidad) {
  // Aquí puedes agregar tu código para la impresión
  // Puedes llamar a una función o biblioteca específica para la impresión
  // Por ejemplo, puedes utilizar la función window.print() para imprimir la página actual

  // Ejemplo de uso de la función window.print():
  window.print();
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
