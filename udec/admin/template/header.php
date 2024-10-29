<?php
session_start();
$url_base = "http://localhost/udec/admin/";
if(!isset($_SESSION['usuario'])) {
    header("location:".$url_base."login.php");
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Administrador_udec</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

   <!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables library -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>

<!-- SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <header>
    
    <!-- place navbar here -->
<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios/">Servicios</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/Portafolio/">Portafolio</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/Entradas/">Entradas</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/Equipo/">Equipo</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/Configuraciones/">Configuraciones</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/Usuarios/">Usuarios</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">cerrar sesion</a>
    </div>
</nav>

<!doctype html>
<html lang="en">

<head>
  <title>Administrador_udec</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

   <!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables library -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>

<!-- SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    


    <script>
      <?php if(isset($_GET["mensaje"])){?>
    swal.fire({icon:"success",title:"<?php echo $_GET ["mensaje"];?>"});
    <?php } ?>
    </script>

<script>
$(document).ready(function(){
  // Agregar efecto de brillo al pasar el mouse sobre el icono del curso
  $('.icono-curso').hover(function(){
    $(this).find('i').addClass('fa-spin');
  }, function(){
    $(this).find('i').removeClass('fa-spin');
  });

  // Agregar el nombre del curso a la ventana emergente de inscripción
  $('.icono-curso').click(function(){
    var curso = $(this).closest('.col-md-4').find('h4').text();
    $('#curso').val(curso);
  });

  // Procesar el formulario de inscripción
  $('#btn-inscribirse').click(function(){
    $('#formulario-inscripcion').submit();
  });
});
</script>
</head>