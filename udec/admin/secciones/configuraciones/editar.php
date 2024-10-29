<?php
include ("../../bd.php");
if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    
    $nombreconfiguracion=$registro["nombreconfiguracion"];
    $valor=$registro["valor"];

    }
    
    if($_POST){
    
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $nombreconfiguracion=(isset($_POST["nombreconfiguracion"]))?$_POST["nombreconfiguracion"]:"";
    $valor=(isset($_POST["valor"]))?$_POST["valor"]:"";

    $sentencia=$conexion->prepare("UPDATE tbl_configuraciones
      set 
      nombreconfiguracion=:nombreconfiguracion,
      valor=:valor
      WHERE id=:id");
    
    $sentencia->bindparam(":nombreconfiguracion",$nombreconfiguracion);
    $sentencia->bindparam(":valor",$valor);
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    
   
    $mensaje ="registro modificado con exito...";
      header("location:index.php?mensaje=".$mensaje);
      
    
    
    }

include ("../../template/header.php");
?>

<div class="card">
    <div class="card-header">
        configuracion
    </div>
    <div class="card-body">
     
    <form action=""enctype="multipart/form-data" method="post">

    <div class="mb-3">
       <label for="id" class="form-label">ID:</label>
       <input type="text"
         class="form-control" readonly value="<?php echo $txtID?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
       
     </div>
    
    <div class="mb-3">
      <label for="nombreconfiguracion" class="form-label">Nombre de la configuracion:</label>
      <input type="text"
        class="form-control"value="<?php echo $nombreconfiguracion?>"name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" 
        placeholder="nombreconfiguracion"> 
    </div>
    <div class="mb-3">
      <label for="valor" class="form-label">Valor:</label>
      <input type="text"
        class="form-control"value="<?php echo $valor?>" name="valor" id="valor" aria-describedby="helpId" placeholder="valor">
    </div>
    

    |<button type="submit" class="btn btn-success">Agregar</button>
     
    <a 
    name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar
  </a> 

    </div>

</div>
</form>

<?php
include ("../../template/footer.php");
?>

