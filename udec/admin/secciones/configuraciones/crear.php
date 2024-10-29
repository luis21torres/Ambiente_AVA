
<?php
include ("../../bd.php");
if($_POST){
    // recepcionamos los valores del formulario 
    
    $nombreconfiguracion=(isset($_POST["nombreconfiguracion"]))?$_POST["nombreconfiguracion"]:"";
    $valor=(isset($_POST["valor"]))?$_POST["valor"]:"";
    
       $sentencia=$conexion->prepare("INSERT INTO `tbl_configuraciones` (`id`, `nombreconfiguracion`, `valor`)
        VALUES (NULL,:nombreconfiguracion,:valor);");
       
       // esta diciendo que cuando encuentre 2 puntos envia cada valor
       
       $sentencia->bindparam(":nombreconfiguracion",$nombreconfiguracion);
       $sentencia->bindparam(":valor",$valor);
       $sentencia->execute();
       
       $mensaje ="registro creado con exito...";
       header("location:index.php?mensaje=".$mensaje);
       // hace que los datos se envien n veces 
      
       
    
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
      <label for="nombreconfiguracion" class="form-label">Nombre de la configuracion:</label>
      <input type="text"
        class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="nombreconfiguracion">
    </div>
    <div class="mb-3">
      <label for="valor" class="form-label">Valor:</label>
      <input type="text"
        class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="valor">
    </div>
   
    <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    </div>

</div>
</form>


<?php
include ("../../template/footer.php");
?>

