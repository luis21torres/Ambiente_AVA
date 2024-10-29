
<?php
include ("../../bd.php");
if($_POST){
   
$usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
   $password=(isset($_POST["password"]))?$_POST["password"]:"";
   $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";


   $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios`
    (`id`,`usuario`,`password`,`correo`) VALUES 
     (NULL,:usuario,:password,:correo);");
   
   
   $sentencia->bindparam(":usuario",$usuario);
   $sentencia->bindparam(":password",$password);
   $sentencia->bindparam(":correo",$correo); 

   $sentencia->execute();
   
   $mensaje ="registro creado con exito...";
      header("location:index.php?mensaje=".$mensaje);
      
}

include ("../../template/header.php");
?>



<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
     
    <form action=""enctype="multipart/form-data" method="post">
   

    <div class="mb-3">
      <label for="usuario" class="form-label">Usuario:</label>
      <input type="text"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" 
        placeholder="usuario"> 
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="text"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
    </div>
   
    <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    </div>

</div>
</form>

<?php
include ("../../template/footer.php");
?>



