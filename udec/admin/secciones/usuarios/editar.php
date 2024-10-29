<?php
include ("../../bd.php");
if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    
    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];

    }
    
    if($_POST){
    
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";
    
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios
      set 
      usuario=:usuario,
      password=:password,
      correo=:correo
      WHERE id=:id");
    
    $sentencia->bindparam(":usuario",$usuario);
    $sentencia->bindparam(":password",$password);
    $sentencia->bindparam(":correo",$correo);
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
     
    $mensaje ="registro modificado con exito...";
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
       <label for="id" class="form-label">ID:</label>
       <input type="text"
         class="form-control" readonly value="<?php echo $txtID?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
       
     </div>

    <div class="mb-3">
      <label for="usuario" class="form-label">Usuario:</label>
      <input type="text"
        class="form-control"value="<?php echo $usuario?>"name="usuario" id="usuario" aria-describedby="helpId" 
        placeholder="usuario"> 
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password"
        class="form-control"value="<?php echo $password?>" name="password" id="password" aria-describedby="helpId" placeholder="password">
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="text"
        class="form-control"value="<?php echo $correo?>" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
    </div>
   
    <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    </div>

</div>
</form>

<?php
include ("../../template/footer.php");
?>




